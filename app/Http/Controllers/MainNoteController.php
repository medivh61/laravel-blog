<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class MainNoteController extends Controller
{
    public function __invoke()
    {
        $data = Note::paginate(10);
        $notePosts = $data->getCollection();

        return inertia('Note/Index', [
            'notePosts' => $notePosts,
            'paginationLinks' => $data
        ]);
    }
}


