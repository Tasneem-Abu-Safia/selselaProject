<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{

    public function index(Request $request)
    {
        //ajax
        if ($request->ajax()) {
            $data = Category::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($category) {
                    $btn = '<a href="' . route('categories.show', $category) . '" href="javascript:void(0)" class="btn btn-success btn-sm"><i class="fas fa-eye"></i></a>';
                    $btn .= '<a href="' . route('categories.edit', $category) . '" href="javascript:void(0)" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>';
                    $btn .= '
                    <form style="display:inline" action="' . route('categories.destroy', $category->id) . '" method="POST">
                    ' . csrf_field() . '
                    ' . method_field("DELETE") . '
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Are You Sure Want to Delete?\')">
                      <i class="fas fa-trash-alt"></i>
                       </button>
                   </form>
                ';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('Category.index');

//        $data = Category::all();
//        return view('Category.index', compact('data'));
    }


    public function create()
    {
        return view('Category.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'name_ar' => 'required|string',
                'name_en' => 'required|string',
                'icon' => 'required|mimes:png,jpg,jpeg,gif',
            ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }
        $path = "";
        if ($request->hasFile('icon')) {
            $icon = $request->icon;
            $fileName = date('Y-m-d') . $request->name . $icon->getClientOriginalName();

            $path = $request->icon->storeAs('category_image', $fileName, 'public');

        }
        $category = Category::create(array_merge(
            $validator->validated(),
            ['image' => 'storage/' . $path,
                'name' => [
                    'en' => $request->name_en,
                    'ar' => $request->name_ar
                ],]
        ));
        return redirect()->route('categories.index');
    }

    public function show(Category $category)
    {
        return view('Category.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('Category.edit', compact('category'));

    }

    public function update(Request $request, $id)
    {

    }


    public function destroy($id)
    {
        Category::destroy($id);
        return back()->with('message', 'Category deleted.');
    }
}
