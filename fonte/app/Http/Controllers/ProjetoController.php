<?php

namespace App\Http\Controllers;
use Validator;
use App\Projeto;
use App\Cliente;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class ProjetoController extends Controller
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
            $selecionado = Projeto::find($id);
            if(!$selecionado){
                $selecionado = new Projeto;
            }
            $showForm = true;
        }else{
            $selecionado = new Projeto;
        }
        $projetos = Projeto::paginate(5);
        $clientes = Cliente::all();
        Log::info("clientes: ");
        foreach($clientes as $cliente){
            Log::info($cliente->CPF);
        }
        return view('projeto',['projetos'=>$projetos, 
        'selecionado'=>$selecionado,
         'showForm' => $showForm,
         'clientes' => $clientes]);
    }

    public function cadastrar(Request $request){
        if($request['cod_projeto_update']){
            $validator = Validator::make($request->all(), [
                'cod_projeto' => 'required|max:4',
                'nome' => 'required|max:30',
                'descricao' => 'required|max:100',
                'cpf' => 'required|max:11'
                ]);
            }else{
                $validator = Validator::make($request->all(), [
                    'cod_projeto' => 'required|unique:projeto|max:4',
                    'nome' => 'required|max:30',
                    'descricao' => 'required|max:100',
                    'cpf' => 'required|max:11'
            ]);
        }

        if ($validator->fails()) {
            return redirect()->route('projeto', ['id' => 'erro','showForm' => true])
                        ->withErrors($validator)
                        ->withInput();
        }else{
            if($request['cod_projeto_update']){
                $projeto = Projeto::find($request['cod_projeto_update']);
                Projeto::where('cod_projeto', $request['cod_projeto_update'])
                ->update(['cod_projeto' => $request['cod_projeto_update'],
                            'nome' => $request['nome'],
                            'descricao' => $request['descricao'],
                            'cpf' => $request['cpf']
                            ]);
                $msg = 'Projeto alterado com sucesso!';
            } else {
                $projeto = new Projeto;
                $projeto->cod_projeto = $request['cod_projeto'];
                $projeto->nome = $request['nome'];
                $projeto->descricao = $request['descricao'];
                $projeto->cpf = $request['cpf'];
                $projeto->save();
                $msg = 'Projeto cadastrado com sucesso!';
            }
            
        }

        return redirect('projeto')->with('success', $msg);
    }

    public function delete($id)
    {
        //DB::connection()->enableQueryLog();
        $selecionado = Projeto::find($id);
        if($selecionado){
            DB::table('projeto')->where('cod_projeto',$id)->delete();
            $msg = ['succes','Projeto deletado com sucesso!'];
        }else{
            $msg = ['erro','Projeto não encontrado!'];
        }
        //$queries = DB::getQueryLog();
        //Log::info($queries);
        return redirect('projeto')->with($msg[0], $msg[1]);
    }
}
