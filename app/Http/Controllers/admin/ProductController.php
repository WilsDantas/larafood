<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUpdateProduct;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    private $repository;

    public function __construct(Product $product){
        $this->repository = $product;
        $this->middleware(['can:Products']);
    }

    public function index()
    {
        $products = $this->repository->latest()->paginate();

        return view('admin.pages.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.pages.products.create');
    }

    public function store(StoreUpdateProduct $request)
    {
        $data = $request->all();

        $tenant = auth()->user()->tenant;

        if($request->hasFile('image') && $request->image->isValid()){
            $data['image'] = $request->image->store("tenants/{$tenant->uuid}/products");
        }


        $this->repository->create($data);
        
        return redirect()->route('products.index');
    }

    public function show($id)
    {
        if(!$product = $this->repository->find($id)){
            return redirect()->back();
        }
        return view('admin.pages.products.show', compact('product'));
    }

    public function edit($id)
    {
        if(!$product = $this->repository->find($id)){
            return redirect()->back();
        }

        return view('admin.pages.products.edit', compact('product'));

    }

    public function update(StoreUpdateProduct $request, $id)
    {
        if(!$product = $this->repository->find($id)){
            return redirect()->back();
        }

        $data = $request->all();

        $tenant = auth()->user()->tenant;

        if($request->hasFile('image') && $request->image->isValid()){

            if(Storage::exists($product->image)) {
                Storage::delete($product->image);
            }

            $data['image'] = $request->image->store("tenants/{$tenant->uuid}/products");
        }

        $product->update($data);

        return redirect()->route('products.index');
    }

    public function destroy($id)
    {
        if(!$product = $this->repository->find($id)){
            return redirect()->back();
        }

        if(Storage::exists($product->image)) {
            Storage::delete($product->image);
        }

        $product->delete();

        return redirect()->route('products.index');
    }

    public function search(Request $request){
        $filters = $request->except('_token');
        $products = $this->repository->search($request->filter);

        return view('admin.pages.products.index', compact('products', 'filters'));
    }
}
