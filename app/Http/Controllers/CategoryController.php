<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Repositories\CategoryRepository;

class CategoryController extends Controller
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepository->all();
        return CategoryResource::collection($categories);
    }

    public function store(CategoryRequest $request)
    {
        $category = $this->categoryRepository->create($request->validated());
        return new CategoryResource($category);
    }

    public function show($id)
    {
        $category = $this->categoryRepository->find($id);
        return new CategoryResource($category);
    }

    public function update(CategoryRequest $request, $id)
    {
        $category = $this->categoryRepository->update($id, $request->validated());
        return new CategoryResource($category);
    }

    public function destroy($id)
    {
        $this->categoryRepository->delete($id);
        return response()->json(['message' => 'Category deleted successfully.']);
    }
}
