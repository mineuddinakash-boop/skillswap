<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SkillRequest;
use Illuminate\Support\Facades\Auth;

class SkillRequestController extends Controller
{
    public function send($toUserId)
    {
        $exists = SkillRequest::where('from_user_id', Auth::id())
            ->where('to_user_id', $toUserId)->first();

        if (!$exists) {
            SkillRequest::create([
                'from_user_id' => Auth::id(),
                'to_user_id' => $toUserId,
                'status' => 'pending',
            ]);
        }

        return redirect()->back()->with('success', 'Request sent!');
    }

    public function respond($requestId, $action)
    {
        $request = SkillRequest::findOrFail($requestId);

        if ($request->to_user_id == Auth::id()) {
            $request->status = $action;
            $request->save();
        }

        return redirect()->back();
    }

    public function unsend($requestId)
    {
        $request = SkillRequest::findOrFail($requestId);

        if ($request->from_user_id == Auth::id()) {
            $request->delete();
        }

        return redirect()->back();
    }
}