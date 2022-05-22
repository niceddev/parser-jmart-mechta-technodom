<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\BrandRequest;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class BrandController
{
    public function index(BrandRequest $request)
    {
        $brands = DB::table('products')
            ->where('category_id', ($request->input('category_id')))
            ->where('brand', '!=', '')
            ->groupBy('category_id', 'brand')
            ->select('brand')
            ->get();
//
//        $brandAnalys = [];
//        foreach ($brands as $brand){
//            $brandAnalys[] = [
//                'name' => $brand,
//                'boughtSum' => 'sadasd'
//            ];
//        }

        return response()->json($brands);
    }

}
