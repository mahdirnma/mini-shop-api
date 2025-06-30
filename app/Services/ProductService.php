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

    public function setProduct($request)
    {
        return app(TryService::class)(function () use ($request){
            return Product::create($request);
        });
    }

    public function getProduct($user)
    {
        return app(TryService::class)(function () use ($user){
            return $user;
        });
    }
}
