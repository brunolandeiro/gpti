<?php

namespace App\Http\Controllers;
use Validator;
use App\Etapa;
use App\Processo;
use App\Area;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class EtapaController extends Controller
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

    public function index($id = null, $showForm = false)
    {
        if($id != null){
            $selecionado = Etapa::find($id);
            if(!$selecionado){
                $selecionado = new Etapa;
            }
            $showForm = true;
        }else{
            $selecionado = new Etapa;
        }
        $etapas = Etapa::paginate(5);
        $processos = Processo::all();
        $areas = Area::all();
        return view('etapa',
        ['etapas'=>$etapas, 
        'selecionado'=>$selecionado, 
        'showForm' => $showForm,
        'processos' => $processos,
        'areas' => $areas,
        ]);
    }

    public function cadastrar(Request $request){
        if($request['cod_etapa_update']){
            $validator = Validator::make($request->all(), [
                'cod_etapa' => 'required|max:4',
                'processo' => 'required|max:3',
                'area' => 'required|max:2',
                'nome' => 'required|max:30',
                'descricao' => 'required|max:100',
            ]);
        }else{
            $validator = Validator::make($request->all(), [
                'cod_etapa' => 'required|unique:etapa|max:4',
                'processo' => 'required|max:3',
                'area' => 'required|max:2',                
                'nome' => 'required|max:30',
                'descricao' => 'required|max:100',
            ]);
        }

        if ($validator->fails()) {
            return redirect()->route('etapa', ['id' => 'erro','showForm' => true])
                        ->withErrors($validator)
                        ->withInput();
        }else{
            if($request['cod_etapa_update']){
                $etapa = Etapa::find($request['cod_etapa_update']);
                Etapa::where('cod_etapa', $request['cod_etapa_update'])
                ->update(['cod_etapa' => $request['cod_etapa_update'],
                            'cod_proc' => $request['processo'],
                            'cod_area' => $request['area'],
                            'nome' => $request['nome'],
                            'descricao' => $request['descricao']
                            ]);
                $msg = 'Etapa alterada com sucesso!';
            } else {
                $etapa = new Etapa;
                $etapa->cod_etapa = $request['cod_etapa'];
                $etapa->cod_proc = $request['processo'];
                $etapa->cod_area = $request['area'];
                $etapa->nome = $request['nome'];
                $etapa->descricao = $request['descricao'];
                $etapa->save();
                $msg = 'Etapa cadastrada com sucesso!';
            }
            
        }

        return redirect('etapa')->with('success', $msg);
    }

    public function delete($id)
    {
        //DB::connection()->enableQueryLog();
        $selecionado = Etapa::find($id);
        if($selecionado){
            DB::table('etapa')->where('cod_etapa',$id)->delete();
            $msg = ['succes','Etapa deletada com sucesso!'];
        }else{
            $msg = ['erro','Etapa não encontrada!'];
        }
        //$queries = DB::getQueryLog();
        //Log::info($queries);
        return redirect('etapa')->with($msg[0], $msg[1]);
    }
}
