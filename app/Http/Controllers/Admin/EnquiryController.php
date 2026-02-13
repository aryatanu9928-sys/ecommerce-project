<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enquiry;

class EnquiryController extends Controller
{
    public function index()
    {
        $enquiries = Enquiry::all();
        return view('admin.enquiry.index', compact('enquiries'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string',
        ]);

        Enquiry::create($request->all());
        return redirect()->route('admin.enquiry.index')->with('success', 'Enquiry submitted successfully.');
    }

    public function markRead($id)
    {
        $enquiry = Enquiry::findOrFail($id);
        $enquiry->update(['is_read' => true]);
        return redirect()->back();
    }

    public function destroy($id)
    {
        Enquiry::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Enquiry deleted successfully.');
    }
}
