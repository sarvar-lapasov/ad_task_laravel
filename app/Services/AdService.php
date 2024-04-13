<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdService extends Service
{
  

    public function getAds(Request $request)
    {
        $sortBy = $request->get('sort_by');
        $sortOrder = $request->get('sort_order', 'asc');

        $adsQuery = Ad::query();

        if ($sortBy === 'price') {
            $adsQuery->orderBy('price', $sortOrder);
        } elseif ($sortBy === 'creation_date') {
            $adsQuery->orderBy('created_at', $sortOrder);
        }

        return $adsQuery;
    }

    public function deleteAd(Ad $ad)
    {
        $photoPaths = $ad->photos()->pluck('path');

        foreach ($photoPaths as $path) {
            Storage::disk('public')->delete($path);
        }

        $directory = dirname($path);
        Storage::disk('public')->deleteDirectory($directory);

        $ad->photos()->delete();
        $ad->delete();
    }
}
