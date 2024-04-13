<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Ad;
use App\Http\Requests\StoreAdPhotoRequest;

class FileService extends Service
{
  

    public function saveAdPhotos(StoreAdPhotoRequest $request, Ad $ad): void
    {
        foreach ($request->photos as $photo) {
            $path = $photo->store('ad/' . $ad->id, 'public');
            $fullName = $photo->getClientOriginalName();

            $ad->photos()->create([
                'full_name' => $fullName,
                'path' => $path
            ]);
        }
    }

}
