<?php

namespace App\Http\Controllers;
use Validator;
use App\Processo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class ProcessoController extends Controller
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
            $selecionado = Processo::find($id);
            if(!$selecionado){
                $selecionado = new Processo;
            }
            $showForm = true;
        }else{
            $selecionado = new Processo;
        }
        $processos = Processo::paginate(5);
        return view('processo',['processos'=>$processos, 'selecionado'=>$selecionado, 'showForm' => $showForm]);
    }

    public function cadastrar(Request $request){
        if($request['cod_proc_update']){
            $validator = Validator::make($request->all(), [
                'cod_proc' => 'required|max:3',
                'nome' => 'required|max:30',
                'descricao' => 'required|max:100',
            ]);
        }else{
            $validator = Validator::make($request->all(), [
                'cod_proc' => 'required|unique:processo|max:3',
                'nome' => 'required|max:30',
                'descricao' => 'required|max:100',
            ]);
        }

        if ($validator->fails()) {
            return redirect()->route('processo', ['id' => 'erro','showForm' => true])
                        ->withErrors($validator)
                        ->withInput();
        }else{
            if($request['cod_proc_update']){
                $processo = Processo::find($request['cod_proc_update']);
                Processo::where('cod_proc', $request['cod_proc_update'])
                ->update(['cod_proc' => $request['cod_proc_update'],
                            'nome' => $request['nome'],
                            'descricao' => $request['descricao']
                            ]);
                $msg = 'Processo alterado com sucesso!';
            } else {
                $processo = new Processo;
                $processo->cod_proc = $request['cod_proc'];
                $processo->nome = $request['nome'];
                $processo->descricao = $request['descricao'];
                $processo->save();
                $msg = 'Processo cadastrado com sucesso!';
            }
            
        }

        return redirect('processo')->with('success', $msg);
    }

    public function delete($id)
    {
        //DB::connection()->enableQueryLog();
        $selecionado = Processo::find($id);
        if($selecionado){
            DB::table('processo')->where('cod_proc',$id)->delete();
            $msg = ['succes','Processo deletado com sucesso!'];
        }else{
            $msg = ['erro','Processo não encontrada!'];
        }
        //$queries = DB::getQueryLog();
        //Log::info($queries);
        return redirect('processo')->with($msg[0], $msg[1]);
    }
}
