<?php

namespace App\Http\Controllers;

use App\Models\Concern;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($concern_id)
    {
        $concern = Concern::with('responsible:id,name')->findOrFail($concern_id);
        $attachment = $concern->attachments()->first()->file_path ?? null;
        
        return view('v2.pages.concerns.comments', compact('concern', 'attachment'));
    }

    public function isCommentsLoad($concern_id)
    {
        $concern = Concern::findOrFail($concern_id);
        $comments = $concern->commentList()->with('user:id,name')->get();

        $admin = Auth::user()->role === 'admin' ? true : false;
        $me = Auth::user()->id;

        return response()->json([
            'success' => true,
            'data' => $comments,
            'roles' => [
                'admin' => $admin,
                'me' => $me
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'write_comm' => 'required|string|max:1255'
        ]);

        $concern = Concern::findOrFail($request->concern_id);
        $concern->commentList()->create([
            'user_id' => auth()->user()->id,
            'content' => $request->write_comm
        ]);

        return response()->json([
            'success' => true,
            'message' => 'New comment added'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $comment = Comment::findOrFail($id);

        if(!$comment)
        {
            return response()->json([
                'success' => true,
                'message' => 'This comment is not available. Failed to find comment'
            ]);
        }

        return response()->json([
            'success' => true,
            'comment' => $comment
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'edited_comment' => 'required|string'
        ]);

        $comment = Comment::findOrFail($id);

        if(!$comment)
        {
            return response()->json([
                'success' => false,
                'message' => 'Cannot find comment. Data match failed'
            ]);
        }

        $verify = $comment->update([
            'content' => $request->edited_comment
        ]);

        if(!$verify)
        {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update comment'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Comment successfully updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comment = Comment::findOrFail($id);
        $isDeleted = $comment->delete();

        if(!$isDeleted)
        {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Comment deleted'
        ]);
    }
}
