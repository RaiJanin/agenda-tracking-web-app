<?php

namespace App\Http\Controllers;

use App\Models\MemberRequest;
use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showAllMemberRequests()
    {
        if(!auth()->user()->role === 'admin')
        {
            return response()->json([
                'message' => 'Unauthorized access'
            ]);
        }
        $member_requests = MemberRequest::latest()->get();

        return response()->json($member_requests);
    }

    public function showPartialMemberRequests()
    {
        if(!auth()->user()->role === 'admin')
        {
            return response()->json([
                'message' => 'Unauthorized access'
            ]);
        }
        $member_requests = MemberRequest::latest()
                ->take(7)
                ->get();

        return response()->json($member_requests);
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
    public function storeRequest(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            's_role' => 'required|string|max:255'
        ]);

        $existed = MemberRequest::where('user_id', $request->user_id)->exists();
        if($existed)
        {
            return back()->withErrors('Membership request already submitted');
        }

        $statusIsOkay = MemberRequest::create([
            'name' => $request->name,
            'user_id' => $request->user_id,
            'member_role' => $request->s_role
        ]);

        if($statusIsOkay)
        {
            return back()->with('success', 'Membership request submitted successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('profile.show', compact('user'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
