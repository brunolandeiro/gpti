<?php

namespace App\Http\Controllers;
use Validator;
use App\EfsEtapa;
use App\Efs;
use App\Etapa;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class EfsEtapaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($cod_efs = null, $cod_etapa = null, $showForm = false)
    {
        if($cod_etapa != null && $cod_efs != null){
            $selecionado = EfsEtapa::where('cod_efs', $cod_efs)
            ->where('cod_etapa', $cod_etapa)
            ->first();
            if(!$selecionado){
                $selecionado = new EfsEtapa;
            }
            $showForm = true;
        }else{
            $selecionado = new EfsEtapa;
        }
        if($cod_efs == 'novo'){
            $selecionado = new EfsEtapa;
            $showForm = true;
        }
        $efs_etapas = EfsEtapa::all();
        $efss = Efs::all();
        $etapas = Etapa::all();
        return view('efs_etapa',['efs_etapas'=>$efs_etapas, 
        'selecionado'=>$selecionado, 
        'showForm' => $showForm,
        'etapas' => $etapas,
        'efss' => $efss,
        ]);
    }

    public function cadastrar(Request $request){
        $validator = Validator::make($request->all(), [
            'cod_efs' => 'required',
            'cod_etapa' => 'required',
            'tipo' => 'required|max:100',
        ]);
            
        if ($validator->fails()) {
            return redirect()->route('efs_etapa', ['cod_efs' => 'erro','cod_etapa' => 'erro','showForm' => true])
                        ->withErrors($validator)
                        ->withInput();
        }else{
            if($request['cod_efs_update'] && $request['cod_etapa_update']){
                $efs_etapa = EfsEtapa::where('cod_efs', $cod_efs)
                ->where('cod_etapa', $cod_etapa)
                ->first();
                $efs_etapa->tipo = $request['tipo'];
                $efs->save();
                $msg = 'Efs/Etapa alterado com sucesso!';
            } else {
                $efs_etapa = new EfsEtapa;
                $efs_etapa->cod_efs = $request['cod_efs'];
                $efs_etapa->cod_etapa = $request['cod_etapa'];
                $efs_etapa->tipo = $request['tipo'];
                $efs_etapa->save();
                $msg = 'Efs/Etapa cadastrado com sucesso!';
            }
            
        }

        return redirect('efs_etapa')->with('success', $msg);
    }

    
}
