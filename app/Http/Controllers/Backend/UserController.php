<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show()
    {
        $page = 'User Manager';

        $users = User::paginate(5);

        return view('backend.users.index', compact('users', 'page'));
    }

    public function updateStatus($id, Request $request)
    {
        $status = $request->status;

        $user_update = User::find($id);

        if ($status < 0 || $status > 1) {
            return response()->json(['message' => "Status is not valid!"]);
        } else {
            $user_update->status = $status;

            $result = $user_update->save();
        }

        if ($result) {
            // Class status
            $class = statusClass($status);

            // Response data
            return response()->json(['status' => true, 'message' => "Update status user number $user_update->name success !", 'class' => $class]);
        }
    }
}
