<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Http\Resources\CategoryResource;
use App\Http\Requests\Api\TenantFormRequest;


class CategoryApiController extends Controller
{
    protected $categorytService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    
    public function categoriesByTenant(TenantFormRequest $request)
    {
        // if(!$request->token_company)
        // {
        //     return response()->json(['message' => 'Token Not Found'], 404);
        // }

        $categories = $this->categoryService->getCategoriesByUuId($request->token_company);
        return CategoryResource::collection($categories);
    }

    public function show(TenantFormRequest $request, $identify)
    {
        if(!$category = $this->categoryService->getCategoryByUuId($identify))
        {
            return response()->json(['message' => 'Category Not Found'], 404); 
        }
        return new CategoryResource($category);
    }
}
