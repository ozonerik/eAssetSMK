<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Budgeting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use App\Models\Organitation;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class BudgetingController extends Controller
{
    public function index()
    {
        $org_id=Auth::user()->organitation_id;
        $user = User::with(['roles','permissions'])->where('id', Auth::user()->id)->first();
        if($user->hasRole(['admin'])){
            $data['budget'] = Budgeting::orderBy('organitation_id', 'asc')->get();
        }else{
            $data['budget'] = Budgeting::where('organitation_id', $org_id)->get();
        }
        
        return view('pages.budgeting.index',$data);

    }

    public function create()
    {
        $org_id=Auth::user()->organitation_id;
        $user = User::with(['roles','permissions'])->where('id', Auth::user()->id)->first();
        if($user->hasRole(['admin'])){
            $data['organitation']= Organitation::orderBy('code', 'asc')->get();
            return view('pages.budgeting.create',$data);
        }else{
            return view('pages.budgeting.create');
        }
        
    }

    public function store(Request $request)
    {
        //dd($org_id);
        $user = User::with(['roles','permissions'])->where('id', Auth::user()->id)->first(); 
        if($user->hasRole(['admin'])){
            $org_id = $request->input('organitation');
        }else{
            $org_id = Auth::user()->organitation_id;
        };

        $validator = Validator::make($request->all(), [
            'code' => 'required|size:2|unique:budgetings,code,NULL,id,organitation_id,'.$org_id,
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('error','Add Sumber Anggaran Failed')->withInput();
        }
 
        $data = [
            'code' => $request->input('code'),
            'name' => $request->input('name'),
            'organitation_id' => $org_id,
            'user_id' => Auth::user()->id,
        ];
        //store to db
        Budgeting::create($data);
        return redirect()->route('budgeting.index')->with('success','Add Sumber Anggaran Success');
    }

    public function edit($id)
    {
        $id=Crypt::decryptString($id);  
        $org_id=Auth::user()->organitation_id;
        $user = User::with(['roles','permissions'])->where('id', Auth::user()->id)->first();
        if($user->hasRole(['admin'])){
            $data['organitation']= Organitation::orderBy('code', 'asc')->get();
        }
        $data['budgeting'] = Budgeting::where('id', $id)->first();
        return view('pages.budgeting.edit',$data);
    }

    public function update(Request $request, $id)
    {
        $id=Crypt::decryptString($id);
        
        $user = User::with(['roles','permissions'])->where('id', Auth::user()->id)->first(); 
        if($user->hasRole(['admin'])){
            $org_id = $request->input('organitation');
        }else{
            $org_id = Auth::user()->organitation_id;
        };

        $validator = Validator::make($request->all(), [
            'code' => 'required|size:2|unique:budgetings,code,'.$id.',id,organitation_id,'.$org_id,
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('error','Update Sumber Anggaran Failed')->withInput();
        }

        $data = [
            'code' => $request->input('code'),
            'name' => $request->input('name'),
            'organitation_id' => $org_id,
            'user_id' => Auth::user()->id,
        ];
        //store to db
        Budgeting::find($id)->update($data);
        return redirect()->route('budgeting.index')->with('success','Update Sumber Anggaran Success');
    }


    public function destroy($id)
    {
        $id=Crypt::decryptString($id);
        $budgeting = Budgeting::where('id', $id)->first();
        $organitation = Organitation::where('id', $budgeting->organitation_id)->first();
        $pathphoto=public_path('storage/photo/'.$organitation->code.'/'.$budgeting->code);
        $pathqrcode=public_path('storage/qrode/'.$organitation->code.'/'.$budgeting->code);
        $this->deleteDir($pathphoto);
        $this->deleteDir($pathqrcode);
        Budgeting::where('id',$id)->delete();
        return redirect()->route('budgeting.index')->with('success','Delete Success');
    }

    private function deleteDir($pathDir){
        if(File::exists($pathDir)){
            File::deleteDirectory($pathDir);
        }
    }

}
