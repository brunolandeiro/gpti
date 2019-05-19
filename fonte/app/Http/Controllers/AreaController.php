<?php

namespace App\Http\Controllers;
use Validator;
use App\Area;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class AreaController extends Controller
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
            $selecionado = Area::find($id);
            Log::info("COD_AREA -> ".$id);
            if(!$selecionado){
                $selecionado = new Area;
            }
            $showForm = true;
        }else{
            $selecionado = new Area;
        }
        $areas = Area::paginate(5);
        Log::info("AREA_SELECIONADA -> ".$selecionado);
        return view('area',['areas'=>$areas, 'selecionado'=>$selecionado, 'showForm' => $showForm]);
    }

    public function cadastrar(Request $request){
        if($request['cod_area_update']){
            $validator = Validator::make($request->all(), [
                'cod_area' => 'required|max:2',
                'nome' => 'required|max:30',
                'descricao' => 'required|max:100',
            ]);
        }else{
            $validator = Validator::make($request->all(), [
                'cod_area' => 'required|unique:area|max:2',
                'nome' => 'required|max:30',
                'descricao' => 'required|max:100',
            ]);
        }

        if ($validator->fails()) {
            return redirect()->route('area', ['id' => 'erro','showForm' => true])
                        ->withErrors($validator)
                        ->withInput();
        }else{
            if($request['cod_area_update']){
                $area = Area::find($request['cod_area_update']);
                Area::where('cod_area', $request['cod_area_update'])
                ->update(['cod_area' => $request['cod_area_update'],
                            'nome' => $request['nome'],
                            'descricao' => $request['descricao']
                            ]);
                $msg = 'Area alterada com sucesso!';
            } else {
                $area = new Area;
                $area->cod_area = $request['cod_area'];
                $area->nome = $request['nome'];
                $area->descricao = $request['descricao'];
                $area->save();
                $msg = 'Area cadastrada com sucesso!';
            }
            
        }

        return redirect('area')->with('success', $msg);
    }

    public function delete($id)
    {
        //DB::connection()->enableQueryLog();
        $selecionado = Area::find($id);
        if($selecionado){
            DB::table('area')->where('cod_area',$id)->delete();
            $msg = ['succes','Area deletada com sucesso!'];
        }else{
            $msg = ['erro','Area não encontrada!'];
        }
        //$queries = DB::getQueryLog();
        //Log::info($queries);
        return redirect('area')->with($msg[0], $msg[1]);
    }
}
