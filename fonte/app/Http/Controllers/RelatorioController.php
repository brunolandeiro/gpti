<?php

namespace App\Http\Controllers;
use Validator;
use App\Area;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class RelatorioController extends Controller
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

    public function areaEtapaProcesso()
    {
        $relatorio = DB::table('etapa')
            ->join('area', 'etapa.cod_area', '=', 'area.cod_area')
            ->join('processo', 'etapa.cod_proc', '=', 'processo.cod_proc')
            ->select('etapa.*', 
                'processo.nome as pnome', 'processo.descricao as pdescricao', 
                'area.nome as anome', 'area.descricao as adescricao')
            ->get();

        return view('relatorio.area_etapa_processo',['relatorio'=>$relatorio]);
    }

    public function etapaEfs()
    {
        $relatorio = DB::table('efs_etapa')
            ->join('efs', 'efs_etapa.cod_efs', '=', 'efs.cod_efs')
            ->join('etapa', 'efs_etapa.cod_etapa', '=', 'etapa.cod_etapa')
            ->select('efs_etapa.*', 
                'etapa.nome as enome', 'etapa.descricao as edescricao', 'etapa.cod_proc as cod_proc', 
                'efs.nome as efsnome', 'efs.descricao as efsdescricao')
            ->get();

        return view('relatorio.relatorio_efs_etapa',['relatorio'=>$relatorio]);
    }

    public function areaEtapaProcessoEfs()
    {
        $relatorio = DB::table('etapa')
            ->join('area', 'etapa.cod_area', '=', 'area.cod_area')
            ->join('processo', 'etapa.cod_proc', '=', 'processo.cod_proc')
            ->join('efs_etapa', 'etapa.cod_etapa', '=', 'efs_etapa.cod_etapa')
            ->join('efs', 'efs_etapa.cod_efs', '=', 'efs.cod_efs')
            ->select('etapa.*', 
                'processo.nome as pnome', 'processo.descricao as pdescricao', 
                'area.nome as anome', 'area.descricao as adescricao',
                'efs.nome as efsnome', 'efs.descricao as efsdescricao'
                )
            ->get();

        return view('relatorio.area_etapa_processo_efs',['relatorio'=>$relatorio]);
    }

    
}
