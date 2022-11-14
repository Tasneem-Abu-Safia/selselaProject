<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Traits\apiTrait;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{

    use apiTrait;

    public function index(Request $request)
    {
        $data = ProductResource::collection(Product::orderBy('created_at')->paginate($request->pagesize));
        return $this->apiResponse($data, 'Done', 200);
    }

    public function show($id)
    {
        $product = Product::find($id);
        if ($product) {
            return $this->apiResponse(new ProductResource($product), 'Result successfully send', 200);
        } else {
            return $this->apiResponse(null, 'Product Not Found', 401);

        }
    }

    public function filter(Request $request)
    {
        $products_query = Product::with(['category']);
        /*
         * search by product name
         */
        if ($request->name) {
            $products_query->where('name->ar','like', $request->name)
                     ->orWhere('name->en','like',$request->name);
        }
        /*
         * search category
         */
        if($request->category_id){
            $products_query->where('category_id',$request->category_id);
        }
        //range
        if ($request->priceMax && $request->priceMin) {
            $products_query->whereBetween('price', [$request->priceMin, $request->priceMax]);
        }
        /*
           if ($request->priceMax) {
                    $products_query->orderby('price','DESC')->limit(7);
                }

           if ($request->priceMin) {
                    $products_query->orderby('price','ASC')->limit(7);
                }
        */
        $products = $products_query->paginate($request->pagesize);

        return $this->apiResponse($products, 'Result successfully send', 200);


    }
}
