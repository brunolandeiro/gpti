<?php

namespace App\Http\Controllers;
use Validator;
use App\Cliente;
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

    public function index()
    {
        $clientes = Cliente::paginate(5);
        return view('cliente',['clientes'=>$clientes]);
    }

    public function cadastrar(Request $request){

        $validator = Validator::make($request->all(), [
            'cpf' => 'required|unique:cliente|max:11',
            'nome' => 'required|max:11',
        ]);

        if ($validator->fails()) {
            return redirect('cliente')
                        ->withErrors($validator)
                        ->withInput();
        }else{
            $cliente = new Cliente;
            $cliente->CPF = $request['cpf'];
            $cliente->NOME = $request['nome'];
            $cliente->DESCRICAO = $request['descricao'];
            $cliente->save();
        }

        return redirect('cliente')->with('success', 'Cliente cadastrado com sucesso!');
    }

    public function get($id)
    {
        $cliente = Cliente::find($id);
        $clientes = Cliente::paginate(5);
        return view('cliente',['clientes'=>$clientes,'selecionado'=>$cliente]);
    }
}
