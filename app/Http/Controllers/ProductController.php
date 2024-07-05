<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\RequestProducts;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class ProductController extends Controller implements HasMiddleware
{


    public static function middleware(): array
    {
        return [
            new Middleware('permission:product-list', only: ['index']),
            new Middleware('permission:product-create', only: ['create', 'store']),
            new Middleware('permission:product-edit', only: ['edit', 'update']),
            new Middleware('permission:product-delete', only: ['destroy']),

        ];
    }


    public function index(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::orderBy('id', 'desc')->get();
            return DataTables::of($products)
                ->addColumn('image', function ($row) {
                    $image_url = url('images') . '/' . $row->image;
                    $image = '<img src="' . $image_url . '" alt="Image" style="max-width:100px; max-height:100px;">';
                    return $image;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<div class="dropdown action-dropdown">
                        <a href="javascript:void(0);" class="link-dot" id="income_dropdown"data-bs-toggle="dropdown" aria-expanded="false"><i class="icon-more-alt"></i></a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="income_dropdown">
                       ';
                    
                        if (Gate::check('product-edit', $row)) {
                            $actionBtn .= ' <a id="EditProductModal" href="javascript:void(0)" class="nav-link"  style="color: #46b8da;  data-bs-toggle="tooltip" title="Edit" data-ajax-popup="false" data-url="' . route('products.edit', $row->id) . '"><i class="icofont icofont-edit-alt"></i></a>';
                        }

                        if (Gate::check('product-delete', $row)) {
                            $actionBtn .= '<a href="javascript:void(0)" class="delete nav-link" style="color: red;" data-bs-toggle="tooltip" title="Delete" data-url="' . route('products.destroy', $row->id) . '"><i class="icofont icofont-ui-delete"></i></a>';
                        }

                        $actionBtn .= '</div>';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'image'])
                ->make(true);
        }
        return view('admin.products.index');
    }



    public function create()
    {
        return view('admin.products.create');
    }

    
    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->code = $request->code;
        $product->detail = $request->detail;

        // Handle the image upload
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images'), $imageName);
            $product->image = $imageName; // Save the image name to the database
        }
        // Save the product to the database
        $product->save();
        // Redirect to the products index with a success message
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function edit($id)
    {
        $products = Product::find($id);

        return view('admin.products.edit',compact('products'));
    }

    public function update (Request $request ,$id){
        $products = Product::find($id);
        $products->name = $request->name;
        $products->code = $request->code;
        $products->detail = $request->detail;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images'), $imageName);
            $products->image = $imageName; 
        }
        $products->save();
        return redirect()->route('products.index')->with('success','Product updated successfully');
    }

    public function destroy($id)
    {
        Product::find($id)->delete();
        return response()->json(['message' => "delete"]);
    }
}
