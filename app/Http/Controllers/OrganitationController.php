<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organitation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class OrganitationController extends Controller
{
    public function index()
    {
        //$org_id=Auth::user()->organitation_id;
        $data['org']=Organitation::all();
        return view('pages.organitation.index',$data);
    }

    public function create()
    {
        $org_id=Auth::user()->organitation_id;
        $user = User::with(['roles','permissions'])->where('id', Auth::user()->id)->first();
        return view('pages.organitation.create');
    }

    public function store(Request $request)
    {
        $org_id=Auth::user()->organitation_id;
        $validator = Validator::make($request->all(), [
            'code' => 'required|size:2|unique:organitations,code',
            'shortname' => 'required|max:10',
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('error','Add Organisasi Failed')->withInput();
        }
        $data = [
            'code' => $request->input('code'),
            'shortname' => $request->input('shortname'),
            'name' => $request->input('name'),
        ];
        //store to db
        Organitation::create($data);
        return redirect()->route('organitation.index')->with('success','Add Organisasi Success');
    }

    public function edit($id)
    {
        $id=Crypt::decryptString($id);  
        $org_id=Auth::user()->organitation_id;
        $user = User::with(['roles','permissions'])->where('id', Auth::user()->id)->first();
        $data['organitation'] = Organitation::where('id', $id)->first();
        return view('pages.organitation.edit',$data);
    }

    public function update(Request $request, $id)
    {
        $id=Crypt::decryptString($id);
        $org_id=Auth::user()->organitation_id;
        $organitations = Organitation::where('id', $id)->first();
        $validator = Validator::make($request->all(), [
            'code' => 'required|size:2|unique:organitations,code,'.$organitations->id,
            'shortname' => 'required|max:10',
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('error','Update Organisasi Failed')->withInput();
        }
        $data = [
            'code' => $request->input('code'),
            'shortname' => $request->input('shortname'),
            'name' => $request->input('name'),
        ];
        //store to db
        Organitation::find($id)->update($data);
        return redirect()->route('organitation.index')->with('success','Update Organisasi Success');
    }


    public function destroy($id)
    {
        $id=Crypt::decryptString($id);
        $organitations = Organitation::where('id', $id)->first();
            $path=public_path('storage/photo/'.$organitations->code);
            if(File::exists($path)){
                //echo $path. " --> ada <br>";
                $this->deleteDir($path);
            }

            $pathqr=public_path('storage/qrcode/'.$organitations->code);
            if(File::exists($pathqr)){
                //echo $path. " --> ada <br>";
                $this->deleteDir($pathqr);
            }

        Organitation::where('id',$id)->delete();
        return redirect()->route('organitation.index')->with('success','Delete Success');
    }

    private function deleteDir($pathDir){
        if(File::exists($pathDir)){
            File::deleteDirectory($pathDir);
        }
    }
}
