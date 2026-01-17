<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommunityJoinRequest;
use App\Models\CommunityMember;


class CommunityJoinController extends Controller
{
    public function sendRequest($id)
    {
        CommunityJoinRequest::firstOrCreate([
            'community_id' => $id,
            'user_id' => session('user_id')
        ]);

        return back();
    }

    public function approve($id)
    {
        $request = CommunityJoinRequest::findOrFail($id);

        // only owner can approve
        if ($request->community->user_id != session('user_id')) {
            abort(403);
        }

        $request->update(['status' => 'approved']);

        CommunityMember::firstOrCreate([
            'community_id' => $request->community_id,
            'user_id' => $request->user_id
        ]);

        return back();
    }

    public function reject($id)
    {
        $request = CommunityJoinRequest::findOrFail($id);

        if ($request->community->user_id != session('user_id')) {
            abort(403);
        }

        $request->update(['status' => 'rejected']);

        return back();
    }
}

