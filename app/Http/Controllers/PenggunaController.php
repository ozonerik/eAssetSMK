<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\Organitation;
use Excel;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class PenggunaController extends Controller
{
    public function index()
    {
        $data['users'] = User::with(['roles','permissions'])->get();
        return view('pages.pengguna.index',$data);
    }

    public function create()
    {
        $data['roles']= Role::all();
        $data['permission']= Permission::all();
        $data['organitation']= Organitation::all();
        return view('pages.pengguna.create',$data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'organitation' => 'nullable',
            'roles' => 'nullable',
            'permissions' => 'nullable',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('error','Update Failed')->withInput();
        }
        //filter password yg kosong
        $nilai = collect([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'password'=>Hash::make($request->input('password')),
            'organitation_id'=>$request->input('organitation'),
        ])->filter()->all();
        
        $user_roles = $request->input('roles');
        $user_permissions = $request->input('permissions'); 
        
        //insert data
        $user = User::create($nilai);
        $user->syncRoles($user_roles);
        $user->syncPermissions($user_permissions);
        return redirect()->route('pengguna.index')->with('success','Add User Success');
    }

    public function user_export() 
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function user_import(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'user_file' => 'required|mimes:xlsx',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('error','Import Failed');
        }

        $file = $request->file('user_file');

        //storage\app\uploads
        // $path = $file->storeAs(
        //     'uploads', 'users.xlsx' , 'public'
        // );

        $path = $file->storeAs(
            'uploads', 'users.xlsx'
        );
        
        Excel::import(new UsersImport, storage_path('app/uploads/users.xlsx'));
        //dd($path);
        return redirect()->route('pengguna.index')->with('success','Import Success');
    }
    
    public function destroy($id)
    {
        $id=Crypt::decryptString($id);    
        //dd($id);
        User::where('id',$id)->delete();
        return redirect()->route('pengguna.index')->with('success','Delete Success');
    }
    
    public function edit($id)
    {
        $id=Crypt::decryptString($id);    
        //dd($id);
        $data['user'] = User::with(['roles','permissions','organitation'])->where('id', $id)->first();
        $data['roles']= Role::all();
        $data['permission']= Permission::all();
        $data['organitation']= Organitation::all();
        return view('pages.pengguna.edit',$data);
    }

    public function update(Request $request, $id)
    {
        $id=Crypt::decryptString($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'nullable|min:6',
            'organitation' => 'nullable',
            'roles' => 'nullable',
            'permissions' => 'nullable',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('error','Update Failed')->withInput();
        }

        if(!empty($request->input('password'))) {
            $password=Hash::make($request->input('password'));
        } else {
            $password=null;
        }

        //filter password yg kosong
        $nilai = collect([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'password'=>$password,
        ])->filter()->all();
        
        $user_roles = $request->input('roles');
        $user_permissions = $request->input('permissions'); 

        //update data
        $user = User::find($id);
        $user->update($nilai);
        $user->update(['organitation_id'=>$request->input('organitation')]);
        $user->syncRoles($user_roles);
        $user->syncPermissions($user_permissions);
        
        return redirect()->route('pengguna.index')->with('success','Update Success');
    }

    public function deleteSel(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'userids' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('error','Delete Failed');
        }
        $userids = Str::of($request->input('userids'))->explode(',')->filter();
        $ids = $userids->all();
        foreach($ids as $id){
            User::where('id',Crypt::decryptString($id))->delete();
        }
        return redirect()->route('pengguna.index')->with('success','Delete Success');
    }

    public function roleSel(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'userids' => 'required',
            'organitation' => 'nullable',
            'roles' => 'nullable',
            'permissions' => 'nullable',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('error','Roles & Permissions Update Failed');
        }
        $userids = Str::of($request->input('userids'))->explode(',')->filter();
        $ids = $userids->all();
        $organitation_id = $request->input('organitation');
        $user_roles = $request->input('roles');
        $user_permissions = $request->input('permissions'); 
        foreach($ids as $id){
            $user = User::find(Crypt::decryptString($id));
            $user->update(['organitation_id' => $organitation_id]);
            $user->syncRoles($user_roles);
            $user->syncPermissions($user_permissions);
        }
        return redirect()->route('pengguna.index')->with('success','Roles & Permissions Update Success');
    }

    public function editprofile()
    {  
        $data['user'] = User::with(['roles','permissions'])->where('id', Auth::user()->id)->first();
        $data['roles']= Role::all();
        $data['permission']= Permission::all();
        $data['organitation']= Organitation::all();
        return view('pages.pengguna.edit-profile',$data);
    }

    public function updateprofile(Request $request, $id)
    {
        $id=Crypt::decryptString($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required|min:6',
            'current_password' => 'required|current_password|min:6',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('error','Update Failed')->withInput();
        }

        if(!empty($request->input('password'))) {
            $password=Hash::make($request->input('password'));
        } else {
            $password=null;
        }

        //filter password yg kosong
        $nilai = collect([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'password'=>$password,
        ])->filter()->all();

        //dd($nilai);

        //update data
        $user = User::find($id);
        $user->update($nilai);
        
        return redirect()->route('profile')->with('success','Update Profile Success');
    }


}
