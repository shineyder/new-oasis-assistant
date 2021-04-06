<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Territory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TerritoryController extends Controller
{
    public function index()
    {
        return view('territory');
    }

    public function showRegio($regio)
    {
        return view('territory.show-map-regio', compact('regio'));
    }

    public function showLocal($regio, $local)
    {
        return view('territory.show-map-local', compact('regio', 'local'));
    }

    public function showFrame($local)
    {
        $data = Territory::where('map', $local)->get();
        return view('territory.frame', compact('data', 'local'));
    }

    public function report(Request $request)
    {
        $data = Territory::where('map', $request->mapactive)->get();

        foreach ($data as $blockData) :
            $id = $blockData->id;
            $change = 0;

            //Verifica se houve mudanças: trabalhada
            if (intval(isset($request['work_' . $id]) ? "1" : "0") != intval($blockData->worked)) :
                $blockData->worked = intval(isset($request['work_' . $id]) ? "1" : "0");
                $change = 1;
            endif;

            //Verifica se houve mudanças: numero de residencias
            if (intval($blockData->number_of_houses) != intval($request['n_res_' . $id])) :
                $blockData->number_of_houses = $request['n_res_' . $id];
                $change = 1;
            endif;

            //Verifica se houve mudanças: numero de comercios
            if (intval($blockData->number_of_commerces) != intval($request['n_com_' . $id])) :
                $blockData->number_of_commerces = $request['n_com_' . $id];
                $change = 1;
            endif;

            //Verifica se houve mudanças: numero de edificios
            if (intval($blockData->number_of_buildings) != intval($request['n_edi_' . $id])) :
                $blockData->number_of_buildings = $request['n_edi_' . $id];
                $change = 1;
            endif;

            if ($change == 1) :
                $blockData->save();

                $log = new Event();
                $log->user_id = Auth::user()->id;
                $log->territory_id = $id;
                $log->event_type = "doReport";
                $log->data1 = "worked";
                $log->desc1 = $blockData->worked;
                $log->data2 = "houses";
                $log->desc2 = $blockData->number_of_houses;
                $log->data3 = "commerces";
                $log->desc3 = $blockData->number_of_commerces;
                $log->data4 = "buildings";
                $log->desc4 = $blockData->number_of_buildings;
                $log->save();
            endif;
        endforeach;

        // Verifica se o território foi completo
        $this->verifyIfTerritoryIsFinished();

        return back()->with('message_success', 'Relatório enviado com sucesso!');
    }

    public function verifyIfTerritoryIsFinished()
    {
        $data = Territory::where('worked', 0)->get();
        if (count($data) == 0) :
            $this->completeTerritory();
        endif;
        return 0;
    }

    public function completeTerritory()
    {
        $log = new Event();
        $log->event_type = "territoryComplete";
        $log->save();

        $info = Event::orderBy('id', 'DESC')->get('cobert')->first();
        $newCobertDefault = $info['cobert'] + 1;
        DB::statement("ALTER TABLE `events` ALTER `cobert` SET default $newCobertDefault");
        DB::table('territories')->update(array('worked' => 0));
    }
}
