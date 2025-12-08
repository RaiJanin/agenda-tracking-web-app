<?php

namespace App\Http\Controllers;

use App\Models\Concern;
use App\Models\Agenda;
use App\Models\User;
use Illuminate\Http\Request;
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
                    ->with('responsible')
                    ->paginate(8);

        $admin = auth()->user()->role === 'admin' ? true : false;
        $me = auth()->user()->id;

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
        $request->validate([
            'agenda_id' => 'required',
            'description' => 'required|string',
            'status' => 'required|string',
            'due_date' => 'nullable|date',
            'comments' => 'nullable|string',
            'file' => 'nullable|file|max:2048',
        ]);

        $newConcern = Concern::create([
            'agenda_id' => $request->agenda_id,
            'description' => $request->description,
            'responsible_person_id' => auth()->id(), // ✅ link user via ID
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

        $comments = null;
        if ($request->filled('comments')) {
            $comments = $request->comments;
            $newConcern->commentList()->create([
                'user_id' => auth()->id(),
                'content' => $comments
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

        $request->validate([
            'description' => 'required|string',
            'responsible_person_id' => 'required|exists:users,id',
            'status' => 'required|in:pending,ongoing,completed',
            'due_date' => 'nullable|date',
            'comments' => 'nullable|string',
        ]);

        $concern->update($request->only([
            'description',
            'responsible_person_id',
            'status',
            'due_date',
            'comments'
        ]));

        return redirect()->back()->with('success', 'Concern updated successfully.');
    }

    public function destroy($id)
    {
        $concern = Concern::findOrFail($id);
        $concern->delete();

        return back()->with('success', 'Concern deleted successfully.');
    }
    public function show($id)
{
    $concern = Concern::findOrFail($id);

    // Optional: check role permissions (admins & members can view all, user/auditor only view)
    if (auth()->user()->role === 'user' && $concern->agenda->restricted) {
        abort(403, 'You are not authorized to view this concern.');
    }

    return view('concerns.show', compact('concern'));
}
public function allConcerns()
{
    // $user = auth()->user();

    // if ($user->role !== 'admin') {
    //     return response()->json([
    //         'success' => false,
    //         'message' => 'Unauthorized access.'
    //     ], 403);
    // }

    $concerns = Concern::with(['agenda', 'responsible'])
        ->withCount('commentList')
        ->latest()
        ->paginate(8);

    return response()->json([
        'success' => true,
        'concerns' => $concerns
    ]);
}

public function yourConcerns()
{
    $user = auth()->user();

    $concerns = Concern::with(['agenda', 'responsible'])
        ->withCount('commentList')
        ->where('responsible_person_id', $user->id)
        ->latest()
        ->paginate(8);

    return response()->json([
        'success' => true,
        'concerns' => $concerns
    ]);
}


}
