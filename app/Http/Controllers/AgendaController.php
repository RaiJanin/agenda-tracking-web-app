<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $agendas = Agenda::orderBy('date', 'desc')->get();
        return response()->json([
            'success' => true,
            'agendas' => $agendas]
        );
    }

    public function clickedAgenda(Request $request)
    {
        $agenda_id = $request->route('agenda_id');
        $agenda = Agenda::find($agenda_id);
        return view('v2.pages.agenda.view-all', compact('agenda'));
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
     */public function create()
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
    
        $isCreator = $agenda->created_by === $user->id;
        $isAdmin = $user->role === 'admin';
    
        if (!$isAdmin && !$isCreator) {
            abort(403, 'Unauthorized action.');
        }
    
        $rules = [
            'notes' => 'nullable|string',
            'file_path' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,txt,jpg,png|max:5120',
        ];
    
        if ($isCreator) {
            $rules['title'] = 'required|string|max:255';
        }
    
        if ($isAdmin) {
            $rules['status'] = 'required|in:pending,ongoing,resolved,closed';
        }
    
        $validated = $request->validate($rules);
    
        // Remove file_path from agenda update
        $validated = $request->except('file_path');
    
        // Handle attachments (creator only)
        if ($isCreator && $request->hasFile('file_path')) {
            // Delete old attachment if exists
            $oldAttachment = $agenda->attachments()->first();
            if ($oldAttachment) {
                Storage::disk('public')->delete($oldAttachment->file_path);
                $oldAttachment->delete();
            }
    
            $path = $request->file('file_path')->store('uploads/agendas', 'public');
            $agenda->attachments()->create(['file_path' => $path]);
        }
    
        // Admin-only update
        if ($isAdmin && !$isCreator) {
            $validated = ['status' => $validated['status']];
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




// 🗑️ DESTROY (ARCHIVE) AGENDA
public function destroy($id)
{
    $agenda = Agenda::findOrFail($id);

    // Instead of deleting, mark as archived
    $agenda->update(['status' => 'archived']);
if (auth()->id() !== $agenda->user_id && auth()->user()->role !== 'IT') {
    abort(403, 'Unauthorized action.');
}

    return redirect()
        ->route('agendas.index')
        ->with('success', 'Agenda archived successfully!');

//----------Logic sugestion-----------
//          For more organized data archiving
//------Keywords:
//        -Before the data deletion, insert into archives table
//        -Send response via json:  example
//        -     return response()->json([
//                'success' => true,
//                'message' => 'Agenda archived successfully'
//                ], 200); //200 as http "okay" response
}


// 📦 SHOW ARCHIVED AGENDAS
public function archived()
{
    $agendas = Agenda::where('status', 'archived')
        ->orderBy('updated_at', 'desc')
        ->get();

    return view('agendas.archived', compact('agendas'));
}

// ♻️ RESTORE ARCHIVED AGENDA (optional)
public function restore($id)
{
    $agenda = Agenda::findOrFail($id);
    $agenda->update(['status' => 'active']);

    return redirect()
        ->route('agendas.archived')
        ->with('success', 'Agenda restored successfully!');
}

}