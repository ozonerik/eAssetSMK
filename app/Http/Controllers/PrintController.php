<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Organitation;
use App\Models\Budgeting;
use App\Models\Fiscalyear;
use App\Models\Itemtype;
use App\Models\Storeroom;
use App\Models\Inventory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use PDF;

class PrintController extends Controller
{
    public function assets(Request $request)
    {

        $user = User::with(['roles','permissions'])->where('id', Auth::user()->id)->first();
        if($user->hasRole(['admin'])){
            $data['org']=Organitation::where('id',Auth::user()->organitation_id)->first();
            $data['inv']=Inventory::with([
                'budgeting',
                'fiscalyear',
                'itemtype',
                'storeroom',
                'organitation',
                'user',
            ])->get();
        }else{
            $data['org']=Organitation::where('id',Auth::user()->organitation_id)->first();
            $data['inv']=Inventory::with([
                'budgeting',
                'fiscalyear',
                'itemtype',
                'storeroom',
                'organitation',
                'user',
            ])
            ->where('organitation_id',Auth::user()->organitation_id)
            ->get();
        }
        
        $pdf = PDF::loadView('pages.print.assets',$data)->setPaper('a4', 'landscape');
        $pdf->output();
        $domPdf = $pdf->getDomPDF();
  
        $canvas = $domPdf->get_canvas();
        $canvas->page_text(755, 552, "Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, [0, 0, 0]);
 
        return $pdf->stream('Daftar_'.date('d_m_Y', strtotime(now())).'.pdf');
        
        //return view('pages.print.assets',$data);
    }

    public function labels(Request $request)
    {
        $user = User::with(['roles','permissions'])->where('id', Auth::user()->id)->first();
        if($user->hasRole(['admin'])){
            $data['org']=Organitation::where('id',Auth::user()->organitation_id)->first();
            $data['inv']=Inventory::with([
                'budgeting',
                'fiscalyear',
                'itemtype',
                'storeroom',
                'organitation',
                'user',
            ])
            ->get();
        }else{
            $data['org']=Organitation::where('id',Auth::user()->organitation_id)->first();
            $data['inv']=Inventory::with([
                'budgeting',
                'fiscalyear',
                'itemtype',
                'storeroom',
                'organitation',
                'user',
            ])
            ->where('organitation_id',Auth::user()->organitation_id)
            ->get();
        }
        
        $data['labels']=$data['inv']->toArray();
         
        $pdf = PDF::loadView('pages.print.labels',$data)
        ->set_option('isRemoteEnabled', true)
        ->set_option('isPhpEnabled', true)
        ->setPaper('a4', 'landscape');
        $pdf->output();
        $domPdf = $pdf->getDomPDF();
  
        $canvas = $domPdf->get_canvas();
        $canvas->page_text(755, 552, "Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, [0, 0, 0]);
 
        return $pdf->stream('Label_'.date('d_m_Y', strtotime(now())).'.pdf');
        
        //return view('pages.print.labels',$data);
    }

}
