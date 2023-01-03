<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        if(count($categories)){
            return $this->response(200, "", CategoryResource::collection($categories));   
        }
            return $this->response(404, "categories is empty", null);
    }


    public function store(CategoryRequest $request)
    {
        $category = Category::create(['name' => $request->name]);
        return $this->response(200, "category is saved", new CategoryResource($category));     
    }


    public function show(Category $category)
    {
        return $this->response(200, "", new CategoryResource($category));     
    }


    public function update(CategoryRequest $request, Category $category)
    {
        $category->update(['name' => $request->name]);
        return $this->response(200, "category is updated", new CategoryResource($category));     
    }


    public function destroy(Category $category)
    {
        $category->delete();
        return $this->response(200, "category is deleted", new CategoryResource($category));     
    }
}