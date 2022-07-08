<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::where('user_id', Auth::user()->id)->get();

        return ResponseFormatter::success([
            'notes' => $notes
        ], 'Category successfully deleted');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'type' => 'required',
            'amount' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);
        
        Note::create([
            'user_id' => $request->user_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'type' => $request->type,
            'amount' => $request->amount,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return ResponseFormatter::success(null, 'Note successfully created');
    }

    public function update(Request $request, Note $note)
    {
        $request->validate([
            'user_id' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'type' => 'required',
            'amount' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);

        $note->update([
            'user_id' => $request->user_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'type' => $request->type,
            'amount' => $request->amount,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return ResponseFormatter::success($note, 'Note successfully updated');
    }
    
    public function destroy(Note $note)
    {
        $note->delete();

        return ResponseFormatter::success(null, 'Note successfully deleted');
    }
}
