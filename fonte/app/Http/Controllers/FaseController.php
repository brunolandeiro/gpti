<?php

namespace App\Http\Controllers;
use Validator;
use App\Fase;
use App\Projeto;
use App\Processo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class FaseController extends Controller
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
            $selecionado = Fase::find($id);
            if(!$selecionado){
                $selecionado = new Fase;
            }
            $showForm = true;
        }else{
            $selecionado = new Fase;
        }
        $fases = Fase::paginate(5);
        $projetos = Projeto::all();
        $processos = Processo::all();
        return view('fase',['fases'=>$fases, 
        'selecionado'=>$selecionado,
         'showForm' => $showForm,
         'projetos' => $projetos,
         'processos' => $processos
         ]);
    }

    public function cadastrar(Request $request){
        if($request['cod_fase_update']){
            $validator = Validator::make($request->all(), [
                'cod_fase' => 'required|max:4',
                'dt_ini' => 'required|max:10',
                'dt_fim' => 'required|max:10',
                'descricao' => 'required|max:100',
                'cod_proc' => 'required|max:3',
                'cod_projeto' => 'required|max:4'
                ]);
            }else{
                $validator = Validator::make($request->all(), [
                    'cod_fase' => 'required|unique:fase|max:4',
                    'dt_ini' => 'required|max:10',
                    'dt_fim' => 'required|max:10',
                    'descricao' => 'required|max:100',
                    'cod_proc' => 'required|max:3',
                    'cod_projeto' => 'required|max:4'
            ]);
        }

        if ($validator->fails()) {
            return redirect()->route('fase', ['id' => 'erro','showForm' => true])
                        ->withErrors($validator)
                        ->withInput();
        }else{
            if($request['cod_fase_update']){
                $fase = Fase::find($request['cod_fase_update']);
                Fase::where('cod_fase', $request['cod_fase_update'])
                ->update(['cod_fase' => $request['cod_fase_update'],
                            'cod_proc' => $request['cod_proc'],
                            'cod_projeto' => $request['cod_projeto'],
                            'descricao' => $request['descricao'],
                            'dt_ini' => $request['dt_ini'],
                            'dt_fim' => $request['dt_fim']
                            ]);
                $msg = 'Fase alterada com sucesso!';
            } else {
                $fase = new Fase;
                $fase->cod_fase = $request['cod_fase'];
                $fase->dt_ini = $request['dt_ini'];
                $fase->dt_fim = $request['dt_fim'];
                $fase->descricao = $request['descricao'];
                $fase->cod_proc = $request['cod_proc'];
                $fase->cod_projeto = $request['cod_projeto'];
                $fase->save();
                $msg = 'Fase cadastrada com sucesso!';
            }
            
        }

        return redirect('fase')->with('success', $msg);
    }

    public function delete($id)
    {
        //DB::connection()->enableQueryLog();
        $selecionado = Fase::find($id);
        if($selecionado){
            DB::table('fase')->where('cod_fase',$id)->delete();
            $msg = ['succes','Fase deletada com sucesso!'];
        }else{
            $msg = ['erro','Fase não encontrada!'];
        }
        //$queries = DB::getQueryLog();
        //Log::info($queries);
        return redirect('fase')->with($msg[0], $msg[1]);
    }
}
