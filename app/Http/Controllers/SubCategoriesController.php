<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\SubCategories;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\RequestSubCategories;
use function PHPUnit\Framework\returnValueMap;

use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class SubCategoriesController extends Controller  implements HasMiddleware
{
    public static function middleware(): array

    {
        return [
            new Middleware('permission:sub-categories-list', only: ['index']),
            new Middleware('permission:sub-categories-create', only: ['create', 'store']),
            new Middleware('permission:sub-categories-edit', only: ['edit', 'update']),
            new Middleware('permission:sub-categories-delete', only: ['destroy']),

        ];
    }
   
    public function index(Request $request)
    {
    //   dd($request);
    if ($request->ajax()) {
        $subCategories = SubCategories::orderBy('id', 'desc')->with('categories')->get();
  
        return DataTables::of($subCategories)

            ->addColumn('action', function ($row) {
                $actionBtn = '<div class="dropdown action-dropdown">
                    <a href="javascript:void(0);" class="link-dot" id="income_dropdown"data-bs-toggle="dropdown" aria-expanded="false"><i class="icon-more-alt"></i></a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="income_dropdown">
                   ';

                if (Gate::check('sub-categories-edit')) {
                    $actionBtn .= ' <a id="EditSubcategoryModal" href="javascript:void(0)" class="nav-link"  style="color: #46b8da;  data-bs-toggle="tooltip" title="Edit" data-ajax-popup="false" data-url="' . route('sub-categories.edit', $row->id) . '"><i class="icofont icofont-edit-alt"></i></a>';
                }

                if (Gate::check('categories-delete')) {
                    $actionBtn .= '<a href="javascript:void(0)" class="delete nav-link" style="color: red;" data-bs-toggle="tooltip" title="Delete" data-url="' . route('sub-categories.destroy', $row->id) . '"><i class="icofont icofont-ui-delete"></i></a>';
                }
                

                $actionBtn .= '</div>';
                return $actionBtn;
            })
            ->addColumn('categories', function ($row) {
                $category_name = '';
                if (!empty($row->categories)) {
                    $category_name = $row->categories->name;
                }
                return $category_name;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
        return view('admin.sub-categories.index');
    }

  
    public function create()
    {
        $categories = Category::all();
        return view('admin.sub-categories.create',compact('categories'));
    }

   
    public function store(RequestSubCategories $request)
    {
       $sub_categories = New SubCategories();
       $sub_categories->sub_category_name = $request->sub_category_name;
       $sub_categories->description = $request->description;
       $sub_categories->category_id = $request->category_id;
       $sub_categories->save();

       return response()->json(['success'=> "SubCategory created successfully"]);
    }

  
    public function show(SubCategories $subCategories)
    {
        
    }

 
    public function edit($id)
    {
      $SubCategories = SubCategories::find($id);
      $categories = Category::all();
    //   dd($SubCategories);
      return view('admin.sub-categories.edit',compact('categories','SubCategories'));
    }

   
    public function update(Request $request,$id)
    {
        $sub_categories =SubCategories::find($id);
       $sub_categories->sub_category_name = $request->sub_category_name;
       $sub_categories->description = $request->description;
       $sub_categories->category_id = $request->category_id;
       $sub_categories->save();

       return response()->json(['success'=> "SubCategory updated successfully"]);
    }

    
    public function destroy($id)
    {
        SubCategories::find($id)->delete();
        return response()->json(['message' => "delete"]);
    }
}
