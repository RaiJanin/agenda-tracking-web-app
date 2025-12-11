<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class AgendaController extends Controller
{
    public function index()
    {
        $agendas = Agenda::orderBy('date', 'desc')->get();
        return view('agendas.index', compact('agendas'));
    }

    public function loadAgendas()
    {
        $agendas = Agenda::orderBy('date', 'desc')
            ->withCount('concerns')
            ->paginate(8);

        return response()->json([
            'success' => true,
            'agendas' => $agendas
        ]);
    }

    public function clickedAgenda(Request $request)
    {
        $agenda_id = $request->route('agenda_id');
        $agenda = Agenda::find($agenda_id);
        $attachment = $agenda->attachments->first()->file_path ?? null;
        
        return view('v2.pages.agenda.view-all', compact('agenda', 'attachment'));
    }

    public function previewEditAgenda(Request $request)
    {
        $agenda_id = $request->route('agenda_id');
        $agenda = Agenda::find($agenda_id);
        return view('v2.pages.agenda.edit', compact('agenda'));
    }

    public function show(Agenda $agenda)
    {
        return view('agendas.show', compact('agenda'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }
        return view('agendas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(auth()->user()->role !== 'admin')
        {
            return redirect()
                ->back()
                ->withErrors(["You don't have permission to perform this action"]);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'file_path' => 'nullable|file|max:5120',
        ]);
    
        $agenda = Agenda::create([
            'title' => $request->title,
            'date' => now()->toDateString(),
            'created_by' => auth()->id(),
            'notes' => $request->notes,
            'status' => 'pending',
        ]);
    
        // Handle attachment
        if ($request->hasFile('file_path')) {
            $path = $request->file('file_path')->store('uploads/agendas', 'public');
            $agenda->attachments()->create(['file_path' => $path]);
        }
    
        return redirect()->back()->with('success', 'Agenda saved successfully!');
    }
    
    public function update(Request $request, $id)
    {
        $agenda = Agenda::findOrFail($id);
        $user = auth()->user();
    
        $isAdmin = $user->role === 'admin';
    
        if (!$isAdmin) {
            return redirect()
                ->back()
                ->withErrors(["You don't have permission to perform this action"]);
        }
    
        $rules = [ 
            'notes' => 'required|string',
            'file_path' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,txt,jpg,png|max:5120',
            'status' => 'required|in:pending,ongoing,resolved,closed'
        ];

        $validated['title'] = $request->title;
        $validated['date'] = $request->date;
        $validated = $request->validate($rules);
        
        // Remove file_path from agenda update
        $validated = $request->except('file_path');

        if ($request->hasFile('file_path')) {
            // Delete old attachment if exists
            $oldAttachment = $agenda->attachments()->first();
            if ($oldAttachment) {
                Storage::disk('public')->delete($oldAttachment->file_path);
                $oldAttachment->delete();
            }
    
            $path = $request->file('file_path')->store('uploads/agendas', 'public');
            $agenda->attachments()->create(['file_path' => $path]);
        }
    
        $agenda->update($validated);
    
        return redirect()->back()->with('success', 'Agenda updated successfully!');
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $agenda = Agenda::findOrFail($id);
        $user = auth()->user();

        // Only admins or the agenda creator can view the edit form
        if ($user->role !== 'admin' && $user->id !== $agenda->created_by) {
            abort(403, 'Unauthorized access.');
        }

        return view('agendas.edit', compact('agenda', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function checkRole(Request $request) {
        dd($request->user()->role);
    }

    public function destroy($id, Request $request)
    {
        $allowedRoles = $request->user()->role;

        if(!in_array($allowedRoles, ['admin', 'IT'])) {
            return response()->json([
                'success' => false,
                'message' => "You don't have permission to perform this action"
            ], 403);
        }

        $agenda = Agenda::findOrFail($id);
        $agenda->delete();

        return response()->json([
                'success' => true,
                'message' => 'Agenda moved to trash bin'
                ], 200);
    }

    public function trashed()
    {
        if(auth()->user()->role !== 'admin')
        {
            return response()->json([
                'success' => false,
                'message' => "You don't have permission to view this function"
            ], 403);
        }

        $agendas = Agenda::onlyTrashed()
            ->orderBy('deleted_at', 'desc')
            ->paginate(20);

        return response()->json($agendas);

        //return view('agendas.archived', compact('agendas'));
    }

    public function restore($id)
    {
        if(auth()->user()->role !== 'admin')
        {
            return response()->json([
                'success' => false,
                'message' => "You don't have permission to view this function"
            ], 403);
        }

        $agenda = Agenda::onlyTrashed()->find($id);
        $agenda->restore();

        return response()->json([
            'success' => true,
            'message' => 'Agenda restored succesfully'
        ]);

        //return redirect()->route('agendas.archived')->with('success', 'Agenda restored successfully!');
    }

    public function forceDelete($id)
    {
        if(auth()->user()->role !== 'admin')
        {
            return response()->json([
                'success' => false,
                'message' => "You don't have permission to view this function"
            ], 403);
        }
        
        $agenda = Agenda::onlyTrashed()->find($id);
        $agenda->forceDelete();

        return response()->json([
            'success' => true,
            'message' => 'Agenda deleted permanently'
        ]);
    }

}