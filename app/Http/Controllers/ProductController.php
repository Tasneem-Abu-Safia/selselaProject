<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        //ajax
        $data = Product::paginate(8);
        return view('Product.index', compact('data'));
    }


    public function create()
    {
        return view('Product.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make(json_decode($request, true),
            [
                'name_ar' => 'required|String',
                'name_en' => 'required|String',
                'image' => 'required|mimes:png,jpg,jpeg,gif',
                'description_en' => 'required|string',
                'description_ar' => 'required|string',
                'price' => 'required|numeric',
                'quantity' => 'required|numeric',
                'category_id' => 'required|numeric|exists:categories,id',

            ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }
        $path = "";
        if ($request->hasFile('image')) {
            $image = $request->image;
            $fileName = date('Y-m-d') . $request->name . $image->getClientOriginalName();

            $path = $request->image->storeAs('product_image', $fileName, 'public');

        }
//        Product::create(
//            [
//                'name'=>['ar'=>$request->name_ar ,'en'=>$request->name_en],
//            ]
//        );
        // spatie translatable
        $product = Product::create(array_merge(
            $validator->validated(),
            [
                'image' => 'storage/' . $path,
                'name' => [
                    'en' => $request->name_en,
                    'ar' => $request->name_ar
                ],
                'description' => [
                    'en' => $request->description_en,
                    'ar' => $request->description_ar
                ],
            ]
        ));
        return redirect()->route('products.index');
    }

    public function show(Product $product)
    {
        return view('Product.show', compact('product'));

    }

    public function edit(Product $product)
    {
        return view('Product.edit', compact('product'));

    }

    public function update(Request $request, $id)
    {

    }


    public function destroy($id)
    {
        Product::destroy($id);
        return back()->with('message', 'Product deleted.');
    }
}
