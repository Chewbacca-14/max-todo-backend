<?php

namespace App\GraphQL\Mutations;

use App\Models\Note;
use Illuminate\Support\Facades\Auth;
use Nuwave\Lighthouse\Exceptions\AuthenticationException;

class NoteMutation
{
    public function create($_, array $args)
    {
        $user = Auth::user();

        if (!$user) {
            throw new AuthenticationException('Unauthenticated');
        }

        return Note::create([
            'title' => $args['title'],
            'note' => $args['note'],
            'user_id' => $user->id,
        ]);
    }

    public function update($_, array $args)
    {
        $user = Auth::user();

        if (!$user) {
            throw new AuthenticationException('Unauthenticated');
        }

        $note = Note::where('id', $args['id'])->where('user_id', $user->id)->firstOrFail();

        if (isset($args['title'])) {
            $note->title = $args['title'];
        }

        if (isset($args['note'])) {
            $note->note = $args['note'];
        }

        $note->save();
        return $note;
    }

    public function delete($_, array $args)
    {
        $user = Auth::user();

        if (!$user) {
            throw new AuthenticationException('Unauthenticated');
        }

        $note = Note::where('id', $args['id'])->where('user_id', $user->id)->firstOrFail();
        $note->delete();
        return $note;
    }
}
