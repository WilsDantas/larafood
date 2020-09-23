<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUpdateCategory;

class CategoryController extends Controller
{
    private $repository;

    public function __construct(Category $category){
        $this->repository = $category;
        $this->middleware(['can:Categories']);
    }

    public function index()
    {
        $categories = $this->repository->latest()->paginate();

        return view('admin.pages.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.pages.categories.create');
    }

    public function store(StoreUpdateCategory $request)
    {
        $this->repository->create($request->all());
        
        return redirect()->route('categories.index');
    }

    public function show($id)
    {
        if(!$category = $this->repository->find($id)){
            return redirect()->back();
        }
        return view('admin.pages.categories.show', compact('category'));
    }

    public function edit($id)
    {
        if(!$category = $this->repository->find($id)){
            return redirect()->back();
        }

        return view('admin.pages.categories.edit', compact('category'));

    }

    public function update(StoreUpdateCategory $request, $id)
    {
        if(!$category = $this->repository->find($id)){
            return redirect()->back();
        }

        $category->update($request->all());

        return redirect()->route('categories.index');
    }

    public function destroy($id)
    {
        if(!$category = $this->repository->find($id)){
            return redirect()->back();
        }

        $category->delete();

        return redirect()->route('categories.index');
    }

    public function search(Request $request){
        $filters = $request->except('_token');
        $categories = $this->repository->search($request->filter);

        return view('admin.pages.categories.index', compact('categories', 'filters'));
    }
}
