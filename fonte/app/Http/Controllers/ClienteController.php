<?php

namespace App\Http\Controllers;
use Validator;
use App\Cliente;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class ClienteController extends Controller
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
            $selecionado = Cliente::find($id);
            if(!$selecionado){
                $selecionado = new Cliente;
            }
            $showForm = true;
        }else{
            $selecionado = new Cliente;
        }
        $clientes = Cliente::paginate(5);
        return view('cliente',['clientes'=>$clientes, 'selecionado'=>$selecionado, 'showForm' => $showForm]);
    }

    public function cadastrar(Request $request){
        if($request['cpfUpdate']){
            $validator = Validator::make($request->all(), [
                'cpf' => 'required|max:11',
                'nome' => 'required|max:50',
            ]);
        }else{
            $validator = Validator::make($request->all(), [
                'cpf' => 'required|unique:cliente|max:11',
                'nome' => 'required|max:50',
            ]);
        }

        if ($validator->fails()) {
            return redirect()->route('cliente', ['id' => 'erro','showForm' => true])
                        ->withErrors($validator)
                        ->withInput();
        }else{
            if($request['cpfUpdate']){
                $cliente = Cliente::find($request['cpfUpdate']);
                Cliente::where('cpf', $request['cpfUpdate'])
                ->update(['cpf' => $request['cpf'],
                            'nome' => $request['nome'],
                            'descricao' => $request['descricao']
                            ]);
                $msg = 'Cliente alterado com sucesso!';
            } else {
                $cliente = new Cliente;
                $cliente->CPF = $request['cpf'];
                $cliente->NOME = $request['nome'];
                $cliente->DESCRICAO = $request['descricao'];
                $cliente->save();
                $msg = 'Cliente cadastrado com sucesso!';
            }
            
        }

        return redirect('cliente')->with('success', $msg);
    }

    public function delete($id)
    {
        //DB::connection()->enableQueryLog();
        $selecionado = Cliente::find($id);
        if($selecionado){
            DB::table('cliente')->where('cpf',$id)->delete();
            $msg = ['succes','Cliente deletado com sucesso!'];
        }else{
            $msg = ['erro','Cliente não encontrado!'];
        }
        //$queries = DB::getQueryLog();
        //Log::info($queries);
        return redirect('cliente')->with($msg[0], $msg[1]);
    }
}
