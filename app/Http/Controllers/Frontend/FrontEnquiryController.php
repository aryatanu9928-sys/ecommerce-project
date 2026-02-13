<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use Illuminate\Http\Request;

class FrontEnquiryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email',
            'phone'   => 'nullable|string|max:15',
            'message' => 'required|string',
        ]);

        Enquiry::create($request->only([
            'name',
            'email',
            'phone',
            'message'
        ]));

        return back()->with('success', 'Enquiry submitted successfully');
    }
}
