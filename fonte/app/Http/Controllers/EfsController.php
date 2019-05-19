<?php

namespace App\Http\Controllers;
use Validator;
use App\Efs;
use App\Etapa;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class EfsController extends Controller
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
            $selecionado = Efs::find($id);
            if(!$selecionado){
                $selecionado = new Efs;
            }
            $showForm = true;
        }else{
            $selecionado = new Efs;
        }
        $etapas = Etapa::all();
        $efss = Efs::paginate(5);
        return view('efs',['efss'=>$efss, 
        'selecionado'=>$selecionado, 
        'showForm' => $showForm, 
        'etapas'=>$etapas]);
    }

    public function cadastrar(Request $request){
        if($request['cod_efs_update']){
            $validator = Validator::make($request->all(), [
                'cod_efs' => 'required|max:5',
                'nome' => 'required|max:100',
                'descricao' => 'required|max:100',
            ]);
        }else{
            $validator = Validator::make($request->all(), [
                'cod_efs' => 'required|unique:efs|max:5',
                'nome' => 'required|max:100',
                'descricao' => 'required|max:100',
            ]);
        }

        if ($validator->fails()) {
            return redirect()->route('efs', ['id' => 'erro','showForm' => true])
                        ->withErrors($validator)
                        ->withInput();
        }else{
            if($request['cod_efs_update']){
                $efs = Efs::find($request['cod_efs_update']);
                Efs::where('cod_efs', $request['cod_efs_update'])
                ->update(['cod_efs' => $request['cod_efs_update'],
                            'nome' => $request['nome'],
                            'descricao' => $request['descricao']
                            ]);
                $msg = 'Efs alterado com sucesso!';
            } else {
                $efs = new Efs;
                $efs->cod_efs = $request['cod_efs'];
                $efs->nome = $request['nome'];
                $efs->descricao = $request['descricao'];
                $efs->save();
                foreach($request['etapas'] as $etapa){
                    
                }
                $msg = 'Efs cadastrado com sucesso!';
            }
            
        }

        return redirect('efs')->with('success', $msg);
    }

    public function delete($id)
    {
        //DB::connection()->enableQueryLog();
        $selecionado = Efs::find($id);
        if($selecionado){
            DB::table('efs')->where('cod_efs',$id)->delete();
            $msg = ['succes','Efs deletado com sucesso!'];
        }else{
            $msg = ['erro','Efs não encontrada!'];
        }
        //$queries = DB::getQueryLog();
        //Log::info($queries);
        return redirect('efs')->with($msg[0], $msg[1]);
    }
}
