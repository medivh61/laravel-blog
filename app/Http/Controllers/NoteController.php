<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Requests\NoteRequests\StoreNoteRequest;
use App\Http\Requests\NoteRequests\UpdateNoteRequest;
use App\Models\Comment;
use App\Models\LikeNote;
use App\Models\Note;
use App\Models\NoteComment;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index()
    {
        $data = Note::paginate(10);
        $notePosts = $data->getCollection();

        return inertia('Admin/Note/Index', [
            'notePosts' => $notePosts,
            'paginationLinks' => $data
        ]);

    }


    public function show($id)
    {
        $notePost = Note::findOrFail($id);

        $likeNote = LikeNote::where('user_id', auth()->id())->get('note_id')->pluck('note_id')->toArray();

        if(in_array($notePost->id, $likeNote)) {
            $notePost->is_liked = true;
        }
        $notePost->likes_count = LikeNote::where('note_id', $notePost->id)->count();

        return inertia('Note/Show', [
            'notePost' => $notePost
        ]);
    }

    public function create()
    {
        return inertia('Admin/Note/Create');
    }

    public function store(StoreNoteRequest $request)
    {
        $this->createOrUpdate(new Note, $request->prepareData());
        return redirect()->route('admin.panel');

    }

    public function edit(Note $note)
    {
        return inertia('Admin/Note/Edit', [
            'notePost' => $note
        ]);
    }

    public function update(UpdateNoteRequest $request, Note $note)
    {
        $this->createOrUpdate($note, $request->prepareData());

        return redirect()->route('admin.panel');
    }

    private function createOrUpdate(Note $note, $data)
    {
        $note->fill($data)->save();
        return $note;
    }


    public function destroy(Note $note)
    {
        $note->delete();
    }

    public function comment(Note $note, CommentRequest $request)
    {
        $user = auth()->user();
        $data = $request->validated();
        $data['note_id'] = $note->id;
        $data['user_id'] = auth()->id();
        $comment = NoteComment::create($data);
        $comment->user = $user;

        return $comment;
    }

    public function commentList(Note $note)
    {
        $comments = $note->comments()->with('user')->latest()->get()->map(function ($comment){
            $comment->formatted_created_at = $comment->created_at->diffForHumans();
            $comment->makeHidden(['created_at']);

            return $comment;
        });

        return $comments;
    }


    public function toggleLike(Note $note)
    {
        $res = auth()->user()->likeNotes()->toggle($note->id);

        $data['is_liked'] = count($res['attached']) > 0;
        $data['likes_count'] = $note->likeUsers()->count();
        return $data;
    }
}
