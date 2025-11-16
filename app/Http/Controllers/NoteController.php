<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;

class NoteController extends Controller
{
    public function index(Request $request)
    {
        return $request->user()->notes;
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'note' => 'required|string',
        ]);

        $note = Note::create([
            'title' => $request->title,
            'note' => $request->note,
            'user_id' => $request->user()->id,
        ]);

        return response()->json($note, 201);
    }

    public function update(Request $request, $id)
    {
        $note = $request->user()->notes()->findOrFail($id);

        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'note' => 'sometimes|required|string',
        ]);

        $note->update($request->only(['title', 'note']));

        return response()->json($note, 200);
    }

    public function destroy(Request $request, $id)
    {
        $note = $request->user()->notes()->findOrFail($id);
        $note->delete();

        return response()->json(['message' => 'Note deleted successfully'], 200);
    }
}
