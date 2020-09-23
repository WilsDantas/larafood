<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use App\Tenant\Traits\TenantTrait;


class Product extends Model
{

    use TenantTrait;

    
    protected $fillable = ['title', 'flag', 'description', 'price', 'image'];

    public function search($filter = null){
        $results = $this
                    ->where('description', 'LIKE', "%{$filter}%")
                    ->orWhere('title', "$filter")
                    ->latest()
                    ->paginate();
        return $results;
    }
    
    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function categoriesAvailable($filter = null){

        $categories = Category::whereNotIn('categories.id', function($query){
            $query->select('category_product.category_id');
            $query->from('category_product');
            $query->whereRaw("category_product.product_id={$this->id}");
        })
        ->where(function ($queryFilter) use ($filter){
            if($filter){
                $queryFilter->where('categories.name', 'LIKE', "%{$filter}%");
            }
        })
        ->paginate();


        return $categories;
    }
}
