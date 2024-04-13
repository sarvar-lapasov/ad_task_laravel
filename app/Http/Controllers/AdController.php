<?php

namespace App\Http\Controllers;


use App\Models\Ad;
use App\Services\AdService;
use Illuminate\Http\Request;
use App\Http\Resources\AdResource;
use App\Http\Requests\StoreAdRequest;
use App\Http\Requests\UpdateAdRequest;

class AdController extends Controller
{
    public function __construct(private AdService $adService)
    {
    
    }
   
    public function index(Request $request)
    {
        $ads = $this->adService->getAds($request)->paginate(10);
        return AdResource::collection($ads);
    }

    public function store(StoreAdRequest $request)
    {
        $ad = Ad::create($request->toArray());
        return $this->success(data:new AdResource($ad));
    }

    public function show(Ad $ad)
    {
        return new AdResource($ad);
    }

  
    public function update(UpdateAdRequest $request, Ad $ad)
    {
        $ad->update($request->toArray());
        return $this->success(data: new AdResource($ad));
    }

    public function destroy(Ad $ad)
    {
        $this->adService->deleteAd($ad);

        return $this->success('ad deleted');
    }
}
