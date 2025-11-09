<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note; 

class NoteController extends Controller
{
    public function index() {
        return Note::all();
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'note' => 'required|string',
        ]);

        $note = Note::create([
            'title' => $request->title,
            'note' => $request->note,
        ]);
        return response()->json($note, 201);
    }
}
