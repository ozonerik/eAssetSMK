<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Itemtype;
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
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ItemtypeController extends Controller
{
    public function index()
    {
        $org_id=Auth::user()->organitation_id;
        $user = User::with(['roles','permissions'])->where('id', Auth::user()->id)->first();
        if($user->hasRole(['admin'])){
            $data['itemtype'] = Itemtype::orderBy('organitation_id', 'asc')->get();
        }else{
            $data['itemtype'] = Itemtype::where('organitation_id', $org_id)->get();
        }
        
        return view('pages.itemtype.index',$data);

    }

    public function create()
    {
        $org_id=Auth::user()->organitation_id;
        $user = User::with(['roles','permissions'])->where('id', Auth::user()->id)->first();
        if($user->hasRole(['admin'])){
            $data['organitation']= Organitation::orderBy('code', 'asc')->get();
        }
        return view('pages.itemtype.create',$data);
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
            'code' => 'required|size:3|unique:itemtypes,code,NULL,id,organitation_id,'.$org_id,
            'shortname' => 'required|max:10',
            'typename' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('error','Add Jenis Barang Failed')->withInput();
        }

        $data = [
            'code' => $request->input('code'),
            'shortname' => $request->input('shortname'),
            'typename' => $request->input('typename'),
            'organitation_id' => $org_id,
            'user_id' => Auth::user()->id,
        ];
        //store to db
        Itemtype::create($data);
        return redirect()->route('itemtype.index')->with('success','Add Jenis Barang Success');
    }

    public function edit($id)
    {
        $id=Crypt::decryptString($id);  
        $org_id=Auth::user()->organitation_id;
        $user = User::with(['roles','permissions'])->where('id', Auth::user()->id)->first();
        if($user->hasRole(['admin'])){
            $data['organitation']= Organitation::orderBy('code', 'asc')->get();
        }
        $data['itemtype'] = Itemtype::where('id', $id)->first();
        return view('pages.itemtype.edit',$data);
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
            'code' => 'required|size:3|unique:itemtypes,code,'.$id.',id,organitation_id,'.$org_id,
            'shortname' => 'required|max:10',
            'typename' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('error','Update Jenis Barang Failed')->withInput();
        }

        $data = [
            'code' => $request->input('code'),
            'shortname' => $request->input('shortname'),
            'typename' => $request->input('typename'),
            'organitation_id' => $org_id,
            'user_id' => Auth::user()->id,
        ];
        //store to db
        Itemtype::find($id)->update($data);
        return redirect()->route('itemtype.index')->with('success','Update Jenis Barang Success');
    }


    public function destroy($id)
    {
        $id=Crypt::decryptString($id);
        $itemtype = Itemtype::where('id', $id)->first();
        $budgeting = Budgeting::where('organitation_id', $itemtype->organitation_id)->get();
        $fiscalyear = Fiscalyear::where('organitation_id', $itemtype->organitation_id)->get();
        $organitation = Organitation::where('id', $itemtype->organitation_id)->first();
        foreach ($budgeting as $r) {
            foreach($fiscalyear as $f){
                //echo $r->code.'-'.$f->code.'-'.$itemtype->code.'<br>';
                $path=public_path('storage/photo/'.$organitation->code.'/'.$r->code.'/'.$f->code.'/'.$itemtype->code);
                if(File::exists($path)){
                    // echo $path. " --> ada <br>";
                    $this->deleteDir($path);
                }

                $pathqr=public_path('storage/qrcode/'.$organitation->code.'/'.$r->code.'/'.$f->code.'/'.$itemtype->code);
                if(File::exists($path)){
                    // echo $path. " --> ada <br>";
                    $this->deleteDir($path);
                }

            }   
        }

        Itemtype::where('id',$id)->delete();
        return redirect()->route('itemtype.index')->with('success','Delete Success');
    }

    private function deleteDir($pathDir){
        if(File::exists($pathDir)){
            File::deleteDirectory($pathDir);
        }
    }
}
