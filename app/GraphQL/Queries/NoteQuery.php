<?php

namespace App\GraphQL\Queries;

use App\Models\Note;
use Illuminate\Support\Facades\Auth;
use Nuwave\Lighthouse\Exceptions\AuthenticationException;

class NoteQuery
{
    public function notes()
    {
        return Note::where('user_id', Auth::id())->get();
    }
}
