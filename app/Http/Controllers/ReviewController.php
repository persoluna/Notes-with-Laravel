<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Rules\ReviewRule;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'message' => ['required', 'string', 'max:500', new ReviewRule],
            'name' => ['required', 'string', 'max:255', new ReviewRule],
            'email' => ['required', 'email', 'max:255', new ReviewRule],
            'phone_no' => ['required', 'string', 'max:20', new ReviewRule],
        ]);

        $data['user_id'] = $request->user()->id;

        Review::create($data);

        return back()->with('message', 'Review submitted successfully!');
    }
}
