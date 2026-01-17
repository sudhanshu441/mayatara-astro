<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CommunityJoinRequest;
use App\Models\Community;

class ProfileController extends Controller
{
    public function show()
    {
        $userId = session('user_id');

        $user = User::findOrFail($userId);

        $communities = Community::where('user_id', $userId)
            ->orderBy('id', 'desc')
            ->get();

       

$joinRequests = CommunityJoinRequest::whereHas('community', function ($q) {
    $q->where('user_id', session('user_id'));
})
->with(['user', 'community'])
->latest()
->get();

return view('profile.show', compact('user', 'communities', 'joinRequests'));
    }

    public function update(Request $request)
    {
        $user = User::findOrFail(session('user_id'));

        $request->validate([
            'name' => 'required',
            'phone' => 'nullable',
            'bio'   => 'nullable',
        ]);

        $user->update($request->only('name', 'phone', 'bio'));

        return back()->with('success', 'Profile updated successfully');
    }

    public function deleteCommunity($id)
    {
        $community = Community::where('id', $id)
            ->where('user_id', session('user_id'))
            ->firstOrFail();

        $community->delete();

        return back()->with('success', 'Community deleted');
    }
}
