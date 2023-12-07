<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MainVideoController extends Controller
{
    public function __invoke()
    {
        $data = Video::paginate(6);
        $videos = $data->getCollection();

        return inertia('Video/Index', [
            'videos' => $videos,
            'paginationLinks' => $data
        ]);
    }

}
