<?php

namespace App\Http\Controllers\Api;

use App\Enums\ServiceEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Product\IndexRequest;
use App\Http\Requests\Api\Product\SearchRequest;
use App\Http\Resources\Api\ProductResource;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(IndexRequest $request)
    {
        $products = Product::filter($request->all())
            ->paginate($request->input('limit'));

        return ProductResource::collection($products);
    }

    public function search(SearchRequest $request)
    {
        $text = $request->input('text');
        $products = Product::where('name', 'ILIKE', "%$text%")
            ->paginate($request->input('limit'));

        return ProductResource::collection($products);
    }

    public function show(Product $product)
    {
        if (is_null($product->description)) {
            $parseService = app(ServiceEnum::from($product->service)->services()[$product->service]);
            $product->update([
                'description' => $parseService->parseDescription($product->original_id)
            ]);
        }

        return ProductResource::make($product);
    }
}
