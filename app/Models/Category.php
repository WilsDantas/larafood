<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Tenant\Traits\TenantTrait;


class Category extends Model
{

    use TenantTrait;
    
    protected $fillable = ['name', 'url', 'description'];

    public function search($filter = null){
        $results = $this
                    ->where('description', 'LIKE', "%{$filter}%")
                    ->orWhere('name', "$filter")
                    ->latest()
                    ->paginate();
        return $results;
    }

    public function products(){
        return belongsToMany(Product::class);
    }

}
