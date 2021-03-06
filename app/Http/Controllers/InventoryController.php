<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\Organitation;
use App\Models\Budgeting;
use App\Models\Fiscalyear;
use App\Models\Itemtype;
use App\Models\Storeroom;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Image;
use QrCode;

class InventoryController extends Controller
{
    public function cek($code)
    {
        //dd($code);
        $inv=Inventory::where('qrcode', $code)->get();
        foreach($inv as $row){
            print($row->name.'<br>');
        }
    }

    function datagraph($budgeting_id){
            $org_id=Auth::user()->organitation_id;
            $data['budget']=Inventory::selectRaw("sum(good_qty) as good, sum(med_qty) as med, sum(bad_qty) as bad, sum(lost_qty) as lost")
                        ->where('organitation_id', $org_id)
                        ->where('budgeting_id', $budgeting_id)
                        ->groupBy('budgeting_id')
                        ->get();
            return $data;
    }

    public function grafik()
    {
        return view('pages.inventory.graph');
    }

    public function index()
    {
        $org_id=Auth::user()->organitation_id;
        $user = User::with(['roles','permissions'])->where('id', Auth::user()->id)->first();
        if($user->hasRole(['admin'])){
            $data['inventory'] = Inventory::orderBy('qrcode', 'asc')->get();
        }else{
            $data['inventory'] = Inventory::where('organitation_id', $org_id)->get();
        }
        
        return view('pages.inventory.index',$data);

    }

    public function create()
    {
        $org_id=Auth::user()->organitation_id;
        $user = User::with(['roles','permissions'])->where('id', Auth::user()->id)->first();
        
        if($user->hasRole(['admin'])){
            $data['budgeting']= Budgeting::orderBy('organitation_id', 'asc')
                                ->orderBy('code', 'asc')
                                ->get();
            $data['fiscal']= Fiscalyear::orderBy('organitation_id', 'asc')
                                ->orderBy('code', 'asc')
                                ->get();                            
            $data['itemtype']= Itemtype::orderBy('organitation_id', 'asc')
                                ->orderBy('code', 'asc')
                                ->get();
            $data['storeroom']= Storeroom::orderBy('organitation_id', 'asc')
                                ->orderBy('shortname', 'asc')
                                ->get();
        }else{
            $data['budgeting']= Budgeting::where('organitation_id', $org_id)->orderBy('code', 'asc')->get();
            $data['fiscal']= Fiscalyear::where('organitation_id', $org_id)->orderBy('code', 'asc')->get();
            $data['itemtype']= Itemtype::where('organitation_id', $org_id)->orderBy('code', 'asc')->get();
            $data['storeroom']= Storeroom::where('organitation_id', $org_id)->orderBy('shortname', 'asc')->get();
        }
        
        return view('pages.inventory.create',$data);
    }

    //fungsi membuat kode inventaris
    function code_inv($budgeting,$fiscal,$itemtype){
        $user_id= Auth::user()->id;
        if(empty(Auth::user()->organitation_id)){
            $org_id="00";
            $code_org = $org_id;
        }else{
            $org_id=Auth::user()->organitation_id;
            $code_org= Organitation::where('id',$org_id)->get()->pluck('code')->implode('');
        }
        
        $code_budget= Budgeting::where('id',$budgeting)->get()->pluck('code')->implode('');
        $code_fiscal= Fiscalyear::where('id',$fiscal)->get()->pluck('code')->implode('');
        $code_itemtype= Itemtype::where('id',$itemtype)->get()->pluck('code')->implode('');
        $max_noinv= Inventory::where([
            ['organitation_id',$org_id],
            ['budgeting_id',$budgeting],
            ['fiscalyear_id',$fiscal],
            ['itemtype_id',$itemtype]
            ])->max('no');
        if(empty($max_noinv)){
            $no=1;
            $no_inv=sprintf('%05d', $no);
        }else{
            $no=$max_noinv+1;
            $no_inv=sprintf('%05d', $no);
        }
        $data['no']=$no;
        $data['code_org']=$code_org;
        $data['code_budget']=$code_budget;
        $data['code_fiscal']=$code_fiscal;
        $data['code_itemtype']=$code_itemtype;
        $data['qrcode_inv']=$code_org.'.'.$code_budget.'.'.$code_fiscal.'.'.$code_itemtype.'.'.$no_inv;
        $data['file_inv'] = Str::replace('.', '_', $data['qrcode_inv']);
        return $data;
    }
    //end fungsi membuat kode inventaris

    //fungsi resize picture and watermark
    function imgResWat($source,$dest,$filename){
        $img = Image::make($source->path());
        $source->move(public_path('photo/'.$dest), $filename);
        //aspect ratio 16:9
        $img->resize(960,540);
        $img->insert(public_path('img/watermark_logo.png'), 'bottom-right');
        $img->save(public_path('photo/'.$dest).'/'.$filename);
        $path = 'photo/'.$dest.'/'.$filename;
        return $path;
    }

    function makeQr($code_org,$qrfile,$text,$size){
        $fileqr=$qrfile.".png";
        $folderPath = public_path('qrcode/'.$code_org);
        if (!file_exists($folderPath)) {
            /**
           * 0755 - Permission
           * true - recursive?
           */
          mkdir($folderPath, 0755, true);
        }
        QrCode::size($size)
            ->format('png')
            ->generate($text, public_path('qrcode/'.$code_org.'/'.$fileqr));
        $pathqr='qrcode/'.$code_org.'/'.$fileqr;
        return $pathqr;
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'purchase_date' => 'nullable|date',
            'picture' => 'nullable|image',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('error','Add Inventaris Failed')->withInput();
        }

        $budget_id=$request->input('budgeting');
        $fiscal_id=$request->input('fiscal');
        $itemtype_id=$request->input('itemtype');
        $no=$this->code_inv($budget_id,$fiscal_id,$itemtype_id)['no'];
        $qrcode_inv=$this->code_inv($budget_id,$fiscal_id,$itemtype_id)['qrcode_inv'];
        $file_inv=$this->code_inv($budget_id,$fiscal_id,$itemtype_id)['file_inv'];
        $destpath = $this->code_inv($budget_id,$fiscal_id,$itemtype_id)['code_org'];
        
        if ($request->hasFile('picture')) {
            $file = $request->file('picture');
            $ext = $file->extension();
            $filename = $file_inv.".".$ext;
            $invpath= $this->imgResWat($file,$destpath,$filename);
        }else{
            $invpath='';
        }
        $data = [
            'no' => $no,
            'qrcode' => $qrcode_inv,
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'purchase_date' => $request->input('purchase_date'),
            'purchase_price' => $request->input('purchase_price'),
            'good_qty' => $request->input('good_qty'),
            'med_qty' => $request->input('med_qty'),
            'bad_qty' => $request->input('bad_qty'),
            'lost_qty' => $request->input('lost_qty'),
            'picture' => $invpath,
            'qrpicture' =>$this->makeQr($destpath,$file_inv,route('inventory.cek',$qrcode_inv),500),
            'budgeting_id' => $budget_id,
            'fiscalyear_id' => $fiscal_id,
            'itemtype_id' => $itemtype_id,
            'storeroom_id' => $request->input('storeroom'),
            'organitation_id' => Auth::user()->organitation_id,
            'user_id' => Auth::user()->id,
        ];
        //store to db
        Inventory::create($data);
        return redirect()->route('inventory.index')->with('success','Add Inventaris Success');
        dd($data);
    }

}
