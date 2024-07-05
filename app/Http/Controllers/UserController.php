<?php

namespace App\Http\Controllers;

use Log;
use Hash;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Arr;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $search = $request->name;
            $gender = $request->gender;
            $country = $request->country;
            // dd($country);
            $startDate = $request->start_date;
            $endDate = $request->end_date;
            $data = User::with('roles');
            if (!empty($search)) {
                $data->where('name', 'like', "%" . $search . "%");
            }
            if (!empty($gender)) {
                $data->where('gender', $gender);
            }
            if (!empty($country)) {
                $data->where('country', $country);
            }

            if (!empty($startDate) && !empty($endDate)) {
                if ($startDate == $endDate) {
                    $data->whereDate('created_at', $startDate);
                } else {
                    $data->whereDate('created_at', '>=', $startDate)
                        ->whereDate('created_at', '<=', $endDate);
                }
            }

            if (!empty($startDate)) {
                $data->whereDate('created_at', '>=', $startDate);
            }


            if (!empty($endDate)) {
                $data->whereDate('created_at', '<=', $endDate);
            }

            $data = $data->latest()->get();
           
            // $results = User::where('name', 'like', "%$search%")->get();
            // $roles = Role::pluck('name','name')->all();
            //    dd($roles);
            return DataTables::of($data)
                ->addColumn('roles', function ($row) {
                    // Concatenate all roles into a single string
                    return '<span class="badge rounded-pill badge-info">' . $row->roles->first()?->name . '</span>';
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 1) {
                        return '<span class="badge rounded-pill badge-success">active</span>';
                    } else {
                        return '<span class="badge rounded-pill badge-danger">active</span>';
                    }
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<div class="dropdown action-dropdown">
                        <a href="javascript:void(0);" class="link-dot" id="income_dropdown"data-bs-toggle="dropdown" aria-expanded="false"><i class="icon-more-alt"></i></a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="income_dropdown">
                        <a id="EditUsersModal" href="javascript:void(0)" class="nav-link"  style="color: #46b8da;  data-bs-toggle="tooltip" title="Edit" data-ajax-popup="false" data-url="' . route('users.edit', $row->id) . '"><i class="icofont icofont-edit-alt"></i></a>
                        <a href="javascript:void(0)" class="delete nav-link" style="color: red;  data-bs-toggle="tooltip" title="Delete" data-url="' . route('users.destroy', $row->id) . '"><i class="icofont icofont-ui-delete"></i></a>';

                    if ($row->status == 1) {
                        $actionBtn .= '<a href="javascript:void(0)" class="nav-link" id="toggle-class" style="color: green;" data-bs-toggle="tooltip" title="Change Status" data-url="' . route('changeStatus', $row->id) . '" data-status="0">active</a>';
                    } else {
                        $actionBtn .= '<a href="javascript:void(0)" class="nav-link" id="toggle-class" style="color: red;" data-bs-toggle="tooltip" title="Change Status" data-url="' . route('changeStatus', $row->id) . '" data-status="1">inactive</a>';
                    }

                    $actionBtn .= '</div>';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'roles', 'status'])
                ->make(true);
        }
        return view('admin.users.index',compact('request'));

    }

    // $data = User::where('checkbox_state', 1)->latest()->paginate(5);
    // // $checkedUsers = User::where('checkbox_state', 1)->get();
    // return view('admin.users.index',compact('data'))
    //     ->with('i', ($request->input('page', 1) - 1) * 5);


   
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        // return view('users.create',compact('roles'));
        return view('admin.users.create', compact('roles'));
    }

  
    public function store(Request $request): RedirectResponse
    {
        // dd($request->all());
        // $request->validate([
        //     'name' => 'required',
        //     'email' => 'required|email|unique:users,email',
        //     'password' => 'required|same:confirm-password',
        //     'roles' => 'required'
        // ]);
    
        $users = new User();
        $users->name = $request->name;  
        $users->email = $request->email;
        $users->gender = $request->gender;
        $users->country = $request->country;
        $users->countries = json_encode($request->countries); 
        $users->hobbies = json_encode($request->hobbies); 
        $users->password =  Hash::make($request->password);
        $users->assignRole($request->input('roles'));
        // dd($users);
        $users->save();
        return redirect()->route('users.index')->with('success', 'User created successfully');
    }


    public function show($id): View
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }


    public function edit($id)
    {
        $user = User::find($id);
    //   return ($user->country);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        // dd($userRole);
        return view('admin.users.edit', compact('user', 'roles', 'userRole'));
    }


    public function update(Request $request, $id)
    {
    //   dd($request);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        // $input = $request->all();
        // if (!empty($input['password'])) {
        //     $input['password'] = Hash::make($input['password']);
        // } else {
        //     $input = Arr::except($input, array('password'));
        // }

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->country = $request->country;
        $user->countries = json_encode($request->countries); 
        $user->hobbies = json_encode($request->hobbies); 
        $user->password =  Hash::make($request->password);
        // dd($user);
        $user->save();
        $user->assignRole($request->input('roles'));
        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    public function changeUserStatus(Request $request, $value)
    {
        // dd("tets");
        $user = User::find($request->id);

        $user->status = $request->status;

        $user->save();

        return response()->json(['success' => 'User status updated successfully.']);
    }
    public function destroy($id)
    {
        User::find($id)->delete();
        return response()->json(['message' => "delete"]);
        // return redirect()->route('admin.users.index')
        //                 ->with('success','User deleted successfully');
    }
    public function UserExport() 
    {
        // dd("tets");
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function import(Request $request) 
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:2048',
        ]);
    
        try {
            Excel::import(new UsersImport, $request->file('file'));
            return response()->json(['data' => 'Users imported successfully.'], 201);
        } catch (\Exception $ex) {
       
            return response()->json(['data' => 'Some error has occurred.', 'error' => $ex->getMessage()], 400);
        }
    }


    public function Filters(Request $request){
        // $filters = User::where('name', 'LIKE', '%'.$request->search.'%')
        // ->with(['programs' => function($filter) use ($request) { 
        //    $filter->where('name','LIKE','%'.$request->search.'%');
        // }])->get();

    //        // Check for search input
    // if (request('search')) {
      
    //     $users = User::where('name', 'like', '%' . request('search') . '%')->get();
    //     dd($users);
    // } else {
    //     $users = User::all();
    // }

    $search = $request->input('search');
  
    $results = User::where('name', 'like', "%$search%")->get();
    // dd($results);
    return view('admin.users.index',compact('results'));

    // return view('admin.users.index');
    }
    
    // "{{ route('admin.report.index') }}?name={{ $request->name }}&type={{ $request->type }}",
}
