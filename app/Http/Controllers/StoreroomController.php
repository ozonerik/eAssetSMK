<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Storeroom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use App\Models\Organitation;
use App\Models\Budgeting;
use App\Models\Fiscalyear;
use App\Models\Itemtype;
use App\Models\Inventory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class StoreroomController extends Controller
{
    public function index()
    {
        $org_id=Auth::user()->organitation_id;
        $user = User::with(['roles','permissions'])->where('id', Auth::user()->id)->first();
        if($user->hasRole(['admin'])){
            $data['storeroom'] = Storeroom::orderBy('organitation_id', 'asc')->get();
        }else{
            $data['storeroom'] = Storeroom::where('organitation_id', $org_id)->get();
        }
        return view('pages.storeroom.index',$data);
    }

    public function create()
    {
        $org_id=Auth::user()->organitation_id;
        $user = User::with(['roles','permissions'])->where('id', Auth::user()->id)->first();
        if($user->hasRole(['admin'])){
            $data['organitation']= Organitation::orderBy('code', 'asc')->get();
            return view('pages.storeroom.create',$data);
        }else{
            return view('pages.storeroom.create');
        }
    }

    public function store(Request $request)
    {
        $user = User::with(['roles','permissions'])->where('id', Auth::user()->id)->first(); 
        if($user->hasRole(['admin'])){
            $org_id = $request->input('organitation');
        }else{
            $org_id = Auth::user()->organitation_id;
        };
        $validator = Validator::make($request->all(), [
            'shortname' => 'required|max:10|unique:storerooms,shortname,NULL,id,organitation_id,'.$org_id,
            'roomname' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('error','Add Penyimpanan Failed')->withInput();
        }

        $data = [
            'shortname' => $request->input('shortname'),
            'roomname' => $request->input('roomname'),
            'organitation_id' => $org_id,
            'user_id' => Auth::user()->id,
        ];
        //store to db
        Storeroom::create($data);
        return redirect()->route('storeroom.index')->with('success','Add Penyimpanan Success');
    }

    public function edit($id)
    {
        $id=Crypt::decryptString($id);  
        $org_id=Auth::user()->organitation_id;
        $user = User::with(['roles','permissions'])->where('id', Auth::user()->id)->first();
        if($user->hasRole(['admin'])){
            $data['organitation']= Organitation::orderBy('code', 'asc')->get();
        }
        $data['storeroom'] = Storeroom::where('id', $id)->first();
        return view('pages.storeroom.edit',$data);
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
            'shortname' => 'required|max:10|unique:storerooms,shortname,'.$id.',id,organitation_id,'.$org_id,
            'roomname' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('error','Update Penyimpanan Failed')->withInput();
        }

        $data = [
            'shortname' => $request->input('shortname'),
            'roomname' => $request->input('roomname'),
            'organitation_id' => $org_id,
            'user_id' => Auth::user()->id,
        ];
        //store to db
        Storeroom::find($id)->update($data);
        return redirect()->route('storeroom.index')->with('success','Update Penyimpanan Success');
    }


    public function destroy($id)
    {
        $id=Crypt::decryptString($id);
        $storeroom = Storeroom::where('id', $id)->first();
        $inv = Inventory::where('storeroom_id', $storeroom->id)->get();
        
        foreach ($inv as $i) {
            $path=public_path('storage/'.$i->picture);
            $this->deleteFile($path);
            $qrpath=public_path('storage/'.$i->qrpicture);
            $this->deleteFile($qrpath);
        }
        

        Storeroom::where('id',$id)->delete();
        return redirect()->route('storeroom.index')->with('success','Delete Success');
    }

    private function deleteFile($pathFile){
        if(File::exists($pathFile)){
            File::delete($pathFile);
        }
    }

}
