<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    function __construct()
    {
//        $this->middleware('permission:category-list|category-create|category-edit|category-delete', ['only' => ['index','show']]);
//        $this->middleware('permission:category-create', ['only' => ['create','store']]);
//        $this->middleware('permission:category-edit', ['only' => ['edit','update']]);
//        $this->middleware('permission:category-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        //ajax
        if ($request->ajax()) {
            $data = Category::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('icon', function ($category) {
                    $url = asset($category->icon);
                    return '<img src="' . $url . '" border="0" width="100" align="center" class="rounded" />';
                })
                ->addColumn('parent_name', function ($cat) {
                    return $cat->parent;
                })
                ->addColumn('action', function ($category) {
                    $btn = '<a href="' . route('categories.show', $category->id) . '" href="javascript:void(0)" class="btn btn-success btn-sm"><i class="fas fa-eye"></i></a>';
                    $btn .= '<a href="' . route('categories.edit', $category->id) . '" href="javascript:void(0)" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>';
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
                ->rawColumns(['parent_name','icon', 'action'])
                ->make(true);
        }
        return view('Layouts.Category.index');

    }


    public function create()
    {
        $categories = Category::whereNull('parent_id')->get();
        return view('Layouts.Category.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'name_ar' => 'required|string',
                'name_en' => 'required|string',
                'parent_id' => 'numeric|exists:categories,id',
                'file' => 'required|mimes:png,jpg,jpeg,gif',
            ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        $path = "";
        if ($request->hasFile('file')) {
            $icon = $request->file;
            $fileName = time() . '.' . $request->file->getClientOriginalName();
            $path = $request->file->storeAs('category_image', $fileName, 'public');

        }
        $category = new Category();
        $category
            ->setTranslation('name', 'en', $request->name_en)
            ->setTranslation('name', 'ar', $request->name_ar);
        $category->icon = 'storage/' . $path;
        $category->parent_id = $request->parent_id;
        $category->save();

        return redirect()->route('categories.index');
    }

    public function show($id)
    {
        $category = Category::find($id);
        return view('Layouts.Category.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('Layouts.Category.edit', compact('category'));

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),
            [
                'name_ar' => 'required|string',
                'name_en' => 'required|string',
                'file' => 'mimes:png,jpg,jpeg,gif',
            ]);
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }
        $category = Category::find($id);
        if ($category) {
            $path = "";
            if ($request->hasFile('file')) {
                $fileName = time() . '.' . $request->file->getClientOriginalName();
                $path = $request->file->storeAs('category_image', $fileName, 'public');

            } else {
                $category['icon'] = $category->icon;
            }
            $category
                ->setTranslation('name', 'en', $request->name_en)
                ->setTranslation('name', 'ar', $request->name_ar);
            $category->icon = 'storage/' . $path;
            $category->save();

            return redirect()->route('categories.index');
        }
        return back();
    }


    public function destroy($id)
    {
        Category::destroy($id);
        return back()->with('message', 'Category deleted.');
    }
}
