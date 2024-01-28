<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fiscalyear;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use App\Models\Organitation;
use App\Models\Budgeting;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class FiscalyearController extends Controller
{
    public function index()
    {
        $org_id=Auth::user()->organitation_id;
        $user = User::with(['roles','permissions'])->where('id', Auth::user()->id)->first();
        if($user->hasRole(['admin'])){
            $data['fiscal'] = Fiscalyear::orderBy('organitation_id', 'asc')->get();
        }else{
            $data['fiscal'] = Fiscalyear::where('organitation_id', $org_id)->get();
        }
        
        return view('pages.fiscal.index',$data);

    }
    public function create()
    {
        $org_id=Auth::user()->organitation_id;
        $user = User::with(['roles','permissions'])->where('id', Auth::user()->id)->first();
        return view('pages.fiscal.create');
    }

    public function store(Request $request)
    {
        $org_id=Auth::user()->organitation_id;
        $validator = Validator::make($request->all(), [
            'code' => 'required|size:2|unique:fiscalyears,code,NULL,id,organitation_id,'.$org_id,
            'year' => 'required|integer|digits:4',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('error','Add Tahun Anggaran Failed')->withInput();
        }
        $data = [
            'code' => $request->input('code'),
            'year' => $request->input('year'),
            'organitation_id' => Auth::user()->organitation_id,
            'user_id' => Auth::user()->id,
        ];
        //store to db
        Fiscalyear::create($data);
        return redirect()->route('fiscal.index')->with('success','Add Tahun Anggaran Success');
    }

    public function edit($id)
    {
        $id=Crypt::decryptString($id);  
        $org_id=Auth::user()->organitation_id;
        $user = User::with(['roles','permissions'])->where('id', Auth::user()->id)->first();
        $data['fiscalyear'] = Fiscalyear::where('id', $id)->first();
        return view('pages.fiscal.edit',$data);
    }

    public function update(Request $request, $id)
    {
        $id=Crypt::decryptString($id);
        $org_id=Auth::user()->organitation_id;
        $validator = Validator::make($request->all(), [
            'code' => 'required|size:2|unique:fiscalyears,code,'.$id.',id,organitation_id,'.$org_id,
            'year' => 'required|integer|digits:4',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('error','Update Tahun Anggaran Failed')->withInput();
        }
        $data = [
            'code' => $request->input('code'),
            'year' => $request->input('year'),
            'organitation_id' => Auth::user()->organitation_id,
            'user_id' => Auth::user()->id,
        ];
        //store to db
        Fiscalyear::find($id)->update($data);
        return redirect()->route('fiscal.index')->with('success','Update Tahun Anggaran Success');
    }


    public function destroy($id)
    {
        $id=Crypt::decryptString($id);
        $fiscalyear = Fiscalyear::where('id', $id)->first();
        $budgeting = Budgeting::where('organitation_id', $fiscalyear->organitation_id)->get();
        $organitation = Organitation::where('id', $fiscalyear->organitation_id)->first();
        foreach ($budgeting as $r) {
            $path=public_path('storage/photo/'.$organitation->code.'/'.$r->code.'/'.$fiscalyear->code);
            if(File::exists($path)){
                //echo $path. " --> ada <br>";
                $this->deleteDir($path);
            }

            $pathqr=public_path('storage/qrcode/'.$organitation->code.'/'.$r->code.'/'.$fiscalyear->code);
            if(File::exists($pathqr)){
                //echo $path. " --> ada <br>";
                $this->deleteDir($pathqr);
            }
          }

        Fiscalyear::where('id',$id)->delete();
        return redirect()->route('fiscal.index')->with('success','Delete Success');
    }

    private function deleteDir($pathDir){
        if(File::exists($pathDir)){
            File::deleteDirectory($pathDir);
        }
    }

}
