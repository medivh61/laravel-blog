<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Requests\VideoRequests\StoreVideoRequest;
use App\Http\Requests\VideoRequests\UpdateVideoRequest;
use App\Models\LikeVideo;
use App\Models\Video;
use App\Models\VideoComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function index()
    {
        $data = Video::paginate(6);
        $videos = $data->getCollection();

        return inertia('Admin/Video/Index', [
            'videos' => $videos,
            'paginationLinks' => $data
        ]);
    }

    public function show($id)
    {
        $video = Video::findOrFail($id);

        $likeVideo = LikeVideo::where('user_id', auth()->id())->get('video_id')->pluck('video_id')->toArray();

        if(in_array($video->id, $likeVideo)) {
            $video->is_liked = true;
        }
        $video->likes_count = LikeVideo::where('video_id', $video->id)->count();

        return inertia('Video/Show', [
            'video' => $video
        ]);
    }

    public function edit(Video $video)
    {
        return inertia('Admin/Video/Edit', [
            'video' => $video
        ]);
    }

    public function create()
    {
        return inertia('Admin/Video/Create');
    }

    public function store(StoreVideoRequest $request)
    {
        $this->createOrUpdate(new Video, $request->prepareData());
        return redirect()->route('admin.panel');

    }

    public function update(UpdateVideoRequest $request, Video $video)
    {
        $validate = $request->prepareData();
        if($request->file('file_video')) {
            $path = Storage::disk('public')->put('videos', $validate['file_video']);
            $fullPath = Storage::disk('public')->url($path);
            $validate['file_video'] = $fullPath;
        }
        $video->update($validate);

        return redirect()->route('admin.panel');
    }
    private function createOrUpdate(Video $video, $data)
    {
        $video->fill($data);
        $path = Storage::disk('public')->put('videos', $video['file_video']);
        $fullPath = Storage::disk('public')->url($path);
        $video['file_video'] = $fullPath;
        $video->save();

        return $video;
    }

    public function destroy(Video $video)
    {
        $video->delete();
    }


    public function comment(Video $video, CommentRequest $request)
    {
        $user = auth()->user();
        $data = $request->validated();
        $data['video_id'] = $video->id;
        $data['user_id'] = auth()->id();
        $comment = VideoComment::create($data);
        $comment->user = $user;

        return $comment;
    }

    public function commentList(Video $video)
    {
        $comments = $video->comments()->with('user')->latest()->get()->map(function ($comment){
            $comment->formatted_created_at = $comment->created_at->diffForHumans();
            $comment->makeHidden(['created_at']);

            return $comment;
        });

        return $comments;
    }

    public function toggleLike(Video $video)
    {
        $res = auth()->user()->likeVideos()->toggle($video->id);

        $data['is_liked'] = count($res['attached']) > 0;
        $data['likes_count'] = $video->likeUsers()->count();
        return $data;
    }
}
