<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdRequest;
use App\Http\Resources\AdResource;
use App\Models\Ad;
use Illuminate\Http\Request;

class AdController extends Controller
{
    public function index()
    {
        $ads = Ad::get();
        if(count($ads)){
            return $this->response(200, "", AdResource::collection($ads));
        }
            return $this->response(404, "ads is empty", null);
    }


    public function store(AdRequest $request)
    {
        $ad = Ad::create([
            'type' => $request->type,
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'category_id' => $request->category_id,
            'advertiser_id' => $request->advertiser_id,
            ]);
        return $this->response(200, "ad is saved", new AdResource($ad));
    }


    public function show(Ad $ad)
    {
        return $this->response(200, "", new AdResource($ad));
    }


    public function update(AdRequest $request, Ad $ad)
    {
        $ad->update([
            'type' => $request->type,
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'category_id' => $request->category_id,
                    ]);
        return $this->response(200, "ad is updated", new AdResource($ad));
    }


    public function destroy(Ad $ad)
    {
        $ad->delete();
        return $this->response(200, "ad is deleted", new AdResource($ad));
    }


    public function filter(Request $request)
    {
        $query = Ad::query();

    if(!empty($request->categories) && empty($request->tags)){
        $query->whereIn('category_id',explode(',',$request->get('categories')));
    }
    if(empty($request->categories) && !empty($request->tags)){
        $query->whereHas('tags',function($q) use($request){
            $q->whereIn('id',explode(',',$request->get('tags')));
        });
    }
    if(!empty($request->categories) && !empty($request->tags)){
        $query->whereIn('category_id',explode(',',$request->get('categories')))
        ->whereHas('tags',function($q) use($request){
            $q->whereIn('id',explode(',',$request->get('tags')));
        });
    }

        return $query->get();
    }

}
