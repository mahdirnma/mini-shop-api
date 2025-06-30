<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ApiResponseBuilder;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(public ProductService $service)
    {
    }

    public function index()
    {
        $result=$this->service->getProducts();
        return (new ApiResponseBuilder())->message('products show successfully')->data(ProductResource::collection($result->data))->response();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $result=$this->service->setProduct($request->validated());
        $apiResponse=$result->success?
            (new ApiResponseBuilder())->message('product created successfully')->data(new ProductResource($result->data)):
            (new ApiResponseBuilder())->message('product not created successfully')->data($result->data);
        return $apiResponse->response();
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $result=$this->service->getProduct($product);
        $apiResponse=$result->success?
            (new ApiResponseBuilder())->message('product showed successfully')->data(new ProductResource($result->data)):
            (new ApiResponseBuilder())->message('product not showed successfully')->data($result->data);
        return $apiResponse->response();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
