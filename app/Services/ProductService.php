<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    public function getProducts()
    {
        return app(TryService::class)(function (){
            return Product::where('is_active',1)->get();
        });
    }
}
