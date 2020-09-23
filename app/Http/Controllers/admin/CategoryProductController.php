<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class CategoryProductController extends Controller
{
    protected $product, $category;


    public function __construct(Product $product, Category $category){
        $this->product = $product;
        $this->category = $category;
        $this->middleware(['can:Products']);
    }


    public function categories($idproduct){

        if(!$product = $this->product->find($idproduct)){
            return redirect()->back();
        }

        $categories = $product->categories()->paginate();

        return view('admin.pages.products.categories.categories', compact('product', 'categories'));
    }

    public function categoriesAvailable(Request $request, $idproduct){

        if(!$product = $this->product->find($idproduct)){
            return redirect()->back();
        }

        $filters = $request->except('_token');

        $categories = $product->categoriesAvailable($request->filter);

        return view('admin.pages.products.categories.available', compact('product', 'categories', 'filters'));

    }

    public function attachCategoriesProduct($idproduct, Request $request){

        if(!$product = $this->product->find($idproduct)){
            return redirect()->back();
        }

        if(!$request->categories || count($request->categories) == 0){
            return redirect()
                    ->back()
                    ->with('info', 'Precisa escolher pelo menos uma permissão');
        }

        $product->categories()->attach($request->categories);

        return redirect()->route('products.categories', $product->id);
    }

    public function detachcategoriesproduct($idproduct, $idcategory){
        $product = $this->product->find($idproduct);
        $category = $this->category->find($idcategory);

        if(!$product || !$category){
            return redirect()->back();
        }
        
        $product->categories()->detach($category);

        return redirect()->route('products.categories', $product->id);
    }

    public function products($idcategory){
        if(!$category = $this->category->find($idcategory)){
            return redirect()->back();
        }

        $products = $category->products()->paginate();

        return view('admin.pages.categories.products.products', compact('products', 'category'));
    
    }
}
