<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::get();
        if(count($tags)){
            return $this->response(200, "", TagResource::collection($tags));   
        }
            return $this->response(404, "tags is empty", null);
    }


    public function store(TagRequest $request)
    {
        $tag = Tag::create([
            'name' => $request->name,
            'ad_id' => $request->ad_id,
            ]);
        return $this->response(200, "tag is saved", new TagResource($tag));     
    }


    public function show(Tag $tag)
    {
        return $this->response(200, "", new TagResource($tag));     
    }


    public function update(TagRequest $request, Tag $tag)
    {
        $tag->update([
            'name' => $request->name,
            'ad_id' => $request->ad_id,   
            ]);
        return $this->response(200, "tag is updated", new TagResource($tag));     
    }


    public function destroy(Tag $tag)
    {
        $tag->delete();
        return $this->response(200, "tag is deleted", new TagResource($tag));     
    }
}