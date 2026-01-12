<?php

namespace App\Http\Controllers;

use App\Models\Concern;
use App\Models\Agenda;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ConcernController extends Controller
{
    public function index($agenda_id)
    {
        $agenda = Agenda::findOrFail($agenda_id);
        $concerns = Concern::where('agenda_id', $agenda_id)
                    ->with('responsible')
                    ->get();
        return view('concerns.index', compact('agenda', 'concerns'));
    }

    public function loadConcernAg($agenda_id)
    {
        $concerns = Concern::where('agenda_id', $agenda_id)
                    ->withCount('commentList')
                    ->with('responsible:id,name')
                    ->paginate(20);

        $admin = Auth::user()->role === 'admin' ? true : false;
        $me = Auth::user()->id;

        return response()->json([
            'success' => true,
            'concerns' => $concerns,
            'roles' => [
                'admin' => $admin,
                'me' => $me
            ],
        ]);
    }

    public function create($agenda_id)
    {
        $agenda = Agenda::findOrFail($agenda_id);
        return view('concerns.create', compact('agenda'));
    }

    public function raiseConcern($agenda_id)
    {
        $agenda = Agenda::findOrFail($agenda_id);
        $res_pers = User::whereIn('role', ['admin', 'member'])->pluck('name', 'id');
        return view('v2.pages.concerns.create', compact('agenda', 'res_pers'));
    }

    public function store(Request $request)
    {
        if(!in_array(auth()->user()->role, ['admin', 'member']))
        {
            return redirect()
                ->back()
                ->withErrors(["You don't have permission to perform this action"]);
        }

        $request->validate([
            'agenda_id' => 'required',
            'description' => 'required|string',
            'responsible_person_id' => 'required|exists:users,id',
            'status' => 'required|string',
            'due_date' => 'nullable|date',
            'file' => 'nullable|file|max:2048',
        ]);

        $newConcern = Concern::create([
            'agenda_id' => $request->agenda_id,
            'description' => $request->description,
            'responsible_person_id' => $request->responsible_person_id, // ✅ link user via ID
            'status' => $request->status,
            'due_date' => $request->due_date
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('uploads/concerns', 'public');
            $newConcern->attachments()->create([
                'file_path' => $filePath
            ]);
        }

        return redirect()
            ->back()
            ->with('success', 'Concern added successfully.');
    }

    public function edit($id)
    {
        $concern = Concern::findOrFail($id);
        return view('concerns.edit', compact('concern'));
    }

    public function editPreview($id)
    {
        $concern = Concern::findOrFail($id);
        $agenda = $concern->agenda->only(['agenda_id', 'title']);
        $res_pers = User::whereIn('role', ['admin', 'member'])->pluck('name', 'id');
        return view('v2.pages.concerns.edit-preview', compact('concern', 'agenda', 'res_pers'));
    }

    public function update(Request $request, $id)
    {

        $concern = Concern::findOrFail($id);
        if($request->user()->role !== "admin" && $request->user()->id !== $concern->responsible_person_id)
        {
            return redirect()
                ->back()
                ->withErrors(["You don't have permission to perform this action"]);
        }

        $request->validate([
            'description' => 'required|string',
            'responsible_person_id' => 'required|exists:users,id',
            'status' => 'required|in:pending,ongoing,completed',
            'due_date' => 'required|date',
            'file_path' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,txt,jpg,png|max:5120',
        ]);

        if ($request->hasFile('file_path')) {
            $oldAttachment = $concern->attachments()->first();
        
            if ($oldAttachment) {
                Storage::disk('public')->delete($oldAttachment->file_path);
                $oldAttachment->delete();
            }
    
            $path = $request->file('file_path')->store('uploads/concerns', 'public');
            $concern->attachments()->create(['file_path' => $path]);
        }

        $concern->update($request->only([
            'description',
            'responsible_person_id',
            'status',
            'due_date',
        ]));

        return redirect()->back()->with('success', 'Concern updated successfully.');
    }

    public function show($id)
    {
        $concern = Concern::findOrFail($id);

        // Optional: check role permissions (admins & members can view all, user/auditor only view)
        if (!in_array(auth()->user()->role, ['admin', 'member'])) {
            abort(403, 'You are not authorized to view this page.');
        }

        return view('concerns.show', compact('concern'));
    }

    public function allConcerns()
    {
        $concerns = Concern::with(['agenda:agenda_id,title', 'responsible:id,name'])
            ->withCount('commentList')
            ->latest()
            ->paginate(20);

        return response()->json([
            'success' => true,
            'concerns' => $concerns
        ]);
    }

    public function yourConcerns()
    {
        $user = auth()->user();

        $concerns = Concern::with(['agenda:agenda_id,title', 'responsible:id,name'])
            ->withCount('commentList')
            ->where('responsible_person_id', $user->id)
            ->latest()
            ->paginate(20);

        return response()->json([
            'success' => true,
            'concerns' => $concerns
        ]);
    }

    public function destroy($id)
    {
        if(!in_array(auth()->user()->role, ['admin', 'member']))
        {
            return redirect()
                ->back()
                ->withErrors(["You don't have permission to perform this action"]);
        }

        $concern = Concern::findOrFail($id);
        $concern->delete();

        return response()->json([
            'success' => true,
            'message'=> 'Concern Deleted Successfully'
        ]);
    }

    public function deletedConcerns()
    {
        if(!in_array(auth()->user()->role, ['admin', 'member']))
        {
            // return redirect()
            //     ->back()
            //     ->withErrors(["You don't have permission to perform this action"]);

            return response()->json([
                'success' => false,
                'message' => "You don't have permission to perform this action"
            ]);
        }
        
        $concerns = '';
        $concernsCount = '';

        if(auth()->user()->role === 'admin')
        {
            $concerns = Concern::onlyTrashed()
                    ->with('responsible:id,name')
                    ->orderBy('deleted_at', 'desc')
                    ->get();
            $concernsCount = Concern::onlyTrashed()->count();
        }
        if(auth()->user()->role === 'member')
        {
            $concerns = Concern::onlyTrashed()
                    ->where('responsible_person_id', auth()->user()->id)
                    ->with('responsible:id,name')
                    ->orderBy('deleted_at', 'desc')
                    ->get();
            $concernsCount = Concern::onlyTrashed()->where('responsible_person_id', auth()->user()->id)->count();
        }

        $myRole = auth()->user()->role === 'member';
        $adminAccess = auth()->user()->role === 'admin';
        
        return response()->json([
            'success' => true,
            'contents' => $concerns,
            'member_role' => $myRole,
            'admin_access' => $adminAccess,
            'concerns_count' => $concernsCount
        ]);

        //return view('v2.pages.trash.concerns-arc', compact('concerns'));
    }

    public function restore($concern_id)
    {
        if(!in_array(auth()->user()->role, ['admin', 'member']))
        {
            return response()->json([
                'success' => false,
                'message' => "You don't have permission to proceed this action"
            ]);        
        }

        $concern = Concern::onlyTrashed()->find($concern_id);
        $concern->restore();

        return response()->json([
                'success' => true,
                'message' => 'Concern restored'
        ], 200);    
    }

    public function forceDelete($concern_id)
    {
        if(!in_array(auth()->user()->role, ['admin', 'member']))
        {
            return response()->json([
                'success' => false,
                'message' => "You don't have permission to proceed this action"
            ]);        
        }

        $concern = Concern::onlyTrashed()->find($concern_id);
        $concern->forceDelete();

        return response()->json([
                'success' => true,
                'message' => 'Concern deleted permanently'
        ], 200);    
    }

}
