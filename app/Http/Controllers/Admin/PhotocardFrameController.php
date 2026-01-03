<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PhotocardFrame;
use Illuminate\Http\Request;
use Validator;

class PhotocardFrameController extends Controller
{
    // List all frames
    public function index()
    {
        $frames = PhotocardFrame::all();
        return view('admin.photocard.index', compact('frames'));
    }

    // Store a new frame
    public function store(Request $request)
    {
        $request->validate([
            'frame' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('frame')) {
            $image = $request->file('frame');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images/frames'), $imageName);

            PhotocardFrame::create(['image' => $imageName]);

            return response()->json(['success' => 'Frame uploaded successfully!']);
        }

        return response()->json(['errors' => 'No file uploaded']);
    }

    // Delete a frame
    public function delete($id)
    {
        $frame = PhotocardFrame::findOrFail($id);
        if (file_exists(public_path('assets/images/frames/' . $frame->image))) {
            @unlink(public_path('assets/images/frames/' . $frame->image));
        }
        $frame->delete();
        return redirect()->back()->with('success', 'Frame Deleted Successfully');
    }
}