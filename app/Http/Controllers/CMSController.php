<?php

namespace App\Http\Controllers;

use App\Models\CMS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;

class CMSController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            $CMS = CMS::orderBy('id', 'desc')->get();
            return DataTables::of($CMS)

                ->addColumn('action', function ($row) {
                    $actionBtn = '<div class="dropdown action-dropdown">
                        <a href="javascript:void(0);" class="link-dot" id="income_dropdown"data-bs-toggle="dropdown" aria-expanded="false"><i class="icon-more-alt"></i></a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="income_dropdown">
                       ';

                    // if (Gate::check('product-edit', $row)) {
                        $actionBtn .= ' <a id="EditSMSModal" href="javascript:void(0)" class="nav-link"  style="color: #46b8da;  data-bs-toggle="tooltip" title="Edit" data-ajax-popup="false" data-url="' . route('cms.edit', $row->id) . '"><i class="icofont icofont-edit-alt"></i></a>';
                    // }

                    

                    $actionBtn .= '</div>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.cms.index');
    }


    public function edit($id){
        $cms = CMS::find($id);
        // dd($cms);
        return view('admin.cms.edit');
    }
}
