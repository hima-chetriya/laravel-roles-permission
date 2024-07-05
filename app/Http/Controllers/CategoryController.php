<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\RequestCategory;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class CategoryController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:categories-list', only: ['index']),
            new Middleware('permission:categories-create', only: ['create', 'store']),
            new Middleware('permission:categories-edit', only: ['edit', 'update']),
            new Middleware('permission:categories-delete', only: ['destroy']),

        ];
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $products = Category::orderBy('id', 'desc')->get();
            return DataTables::of($products)

                ->addColumn('action', function ($row) {
                    $actionBtn = '<div class="dropdown action-dropdown">
                        <a href="javascript:void(0);" class="link-dot" id="income_dropdown"data-bs-toggle="dropdown" aria-expanded="false"><i class="icon-more-alt"></i></a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="income_dropdown">
                       ';

                    if (Gate::check('product-edit', $row)) {
                        $actionBtn .= ' <a id="EditcategoryModal" href="javascript:void(0)" class="nav-link"  style="color: #46b8da;  data-bs-toggle="tooltip" title="Edit" data-ajax-popup="false" data-url="' . route('categories.edit', $row->id) . '"><i class="icofont icofont-edit-alt"></i></a>';
                    }

                    if (Gate::check('categories-delete', $row)) {
                        $actionBtn .= '<a href="javascript:void(0)" class="delete nav-link" style="color: red;" data-bs-toggle="tooltip" title="Delete" data-url="' . route('categories.destroy', $row->id) . '"><i class="icofont icofont-ui-delete"></i></a>';
                    }

                    $actionBtn .= '</div>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.categories.index');
    }
    
    public function create()
    {
       return view('admin.categories.create');
    }


    public function store(RequestCategory $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();
        return response()->json(['success' => "Category created successfully"]);
    }


    public function show(Category $category)
    {
        
    }

    
    public function edit(Request $request, $id)
    {
        $category_edit = Category::find($id);
        return view('admin.categories.edit', compact('category_edit'));
    }


    public function update(RequestCategory $request, $id)
    {
        // dd($request);
        $category_update = Category::find($id);
        // dd( $category_update);
        $category_update->name = $request->name;
        $category_update->description = $request->description;
        $category_update->save();
        return response()->json(["success" => "Category updated successfully"]);
    }

    public function destroy($id)
    {
        Category::find($id)->delete();
        return response()->json(['message' => "delete"]);
    }
}
