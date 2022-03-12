<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        $page = 'Feedbacks Manager';

        $feedbacks = Feedback::filterByDate()->paginate(4);

        return view('backend.feedbacks.index', compact('feedbacks', 'page'));
    }

    public function updateStatus($id, Request $request)
    {
        $status = $request->status;

        $feedback = Feedback::find($id);

        if ($status < 0 || $status > 1) {
            return response()->json(['message' => "Status is not valid!"]);
        } else {
            $feedback->status = $status;

            $result = $feedback->save();

            if ($result) {
                // Class status
                $class = statusClass($status);

                // Response data
                return response()->json(['status' => 'success', 'result' => $feedback->status, 'message' => "Update status user number success !", 'class' => $class]);
            }
        }
    }
}
