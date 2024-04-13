<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Photo;
use App\Services\FileService;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreAdPhotoRequest;

class AdPhotoController extends Controller
{
    public function __construct(
        protected FileService $fileService,
    )
    {
    }
    
    public function store(StoreAdPhotoRequest $request, Ad $ad)
    {
        $this->fileService->saveAdPhotos($request, $ad);
        return $this->success('Photo added successfully.');
    }
}
