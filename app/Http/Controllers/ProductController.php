<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    function __construct()
    {
//        $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index','show']]);
//        $this->middleware('permission:product-create', ['only' => ['create','store']]);
//        $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
//        $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::all();
            return Datatables::of($data)
                ->addIndexColumn()
//                ->addColumn('image', function ($product) {
//                    $url = asset($product->image);
//                    return '<img src="' . $url . '" border="0" width="100" align="center" class="rounded" />';
//                })
                ->addColumn('active', function ($product) {
                    if ($product->active == '1') {
                        return '<a class="text-success" href="'. route('productDeActive', $product->id)
                            .'" title="Active"><i class="fas fa-arrow-up"></i></a>';
                    } else {
                        return '<a class="text-danger" href="'. route('productActive', $product->id)
                            .'" title="Inactive"><i class="fas fa-arrow-down"></i></a>';
                   }
                })
                ->addColumn('category_name', function ($product) {
                    return $product->category->getTranslation('name', Session::get("locale") != null ? Session::get("locale") : "en");
                })
                ->addColumn('action', function ($product) {
                    $btn = '<a href="' . route('products.show', $product->id) . '" href="javascript:void(0)" class="btn btn-success btn-sm"><i class="fas fa-eye"></i></a>';
                    $btn .= '<a href="' . route('products.edit', $product->id) . '" href="javascript:void(0)" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>';
                    $btn .= '
                    <form style="display:inline" action="' . route('products.destroy', $product->id) . '" method="POST">
                    ' . csrf_field() . '
                    ' . method_field("DELETE") . '
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Are You Sure Want to Delete?\')">
                      <i class="fas fa-trash-alt"></i>
                       </button>
                   </form>
                ';
                    return $btn;
                })
                ->rawColumns(['category_name','active','action'])
                ->make(true);
        }
        return view('Layouts.Product.index');
    }


    public function create()
    {
        $category = Category::all();
        return view('Layouts.Product.create', compact('category'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'name_ar' => 'required|String',
                'name_en' => 'required|String',
                'file' => 'required|mimes:png,jpg,jpeg,gif',
                'description_en' => 'required|string',
                'description_ar' => 'required|string',
                'price' => 'required|numeric',
                'quantity' => 'required|numeric',
                'category_id' => 'required|numeric|exists:categories,id',
                'active' => 'required|boolean',

            ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        $path = "";
        if ($request->hasFile('file')) {
            $fileName = time() . '.' . $request->file->getClientOriginalName();
            $path = $request->file->storeAs('product_image', $fileName, 'public');

        }

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
        return view('Layouts.Product.show', compact('product'));

    }

    public function edit(Product $product)
    {
        $category = Category::all();

        return view('Layouts.Product.edit', compact('product', 'category'));

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),
            [
                'name_ar' => 'required|String',
                'name_en' => 'required|String',
                'file' => 'mimes:png,jpg,jpeg,gif',
                'description_en' => 'required|string',
                'description_ar' => 'required|string',
                'price' => 'required|numeric',
                'quantity' => 'required|numeric',
                'category_id' => 'required|numeric|exists:categories,id',
                'active' => 'required|boolean',

            ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }
        $product = Product::find($id);
        if ($product) {
            $path = "";
            if ($request->hasFile('file')) {
                $fileName = time() . '.' . $request->file->getClientOriginalName();
                $path = $request->file->storeAs('product_image', $fileName, 'public');

            } else {
                $product['image'] = $product->image;
            }

            $product->update(array_merge(
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
        return back();
    }


    public function destroy($id)
    {
        Product::destroy($id);
        return back()->with('message', 'Product deleted.');
    }

    public function active($id){
    $product = Product::find($id);
    $product->active = 1;
    $product->save();
    return back()->with('msg' , 'Product Active');

    }
    public function deActive($id){
        $product = Product::find($id);
        $product->active = 0;
        $product->save();
        return back()->with('msg' , 'Product De-Active');
    }
}
