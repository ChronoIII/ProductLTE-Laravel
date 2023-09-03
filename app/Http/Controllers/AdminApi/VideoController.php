<?php

namespace App\Http\Controllers\AdminApi;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function __construct() {

    }

    public function index() {
        return response()->json([
            'video_links'   => Storage::disk('root_public')->files('videos'),
            'thumbnails'    => Storage::disk('root_public')->files('videos/thumbnails'),
        ]);
    }
}
