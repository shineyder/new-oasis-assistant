<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Territory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        return view('report');
    }

    public function data(Request $request)
    {
        $request->ajax();
        $cobert = $this->actualCobert();
        $data = Event::join('users', 'events.user_id', '=', 'users.id')
            ->join('territories', 'events.territory_id', '=', 'territories.id')
            ->select(
                'users.name',
                'territories.map',
                'territories.block',
                'events.id',
                'events.territory_id',
                'events.desc2',
                'events.desc3',
                'events.desc4',
            )
            ->where('user_id', Auth::user()->id)
            ->where('cobert', $cobert['cobert'])
            ->where('event_type', "doReport");


        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('defStatus', function ($data) {
                    $btn = "<button
                                type='button'
                                class='edit btn btn-primary btn-sm'
                                data-bs-toggle='modal'
                                data-bs-target='#updateReportModal'
                                onClick='passIdUpload($data->id, $data->territory_id)'
                                style='margin-right: 10px;'>
                                    Atualizar
                            </button>";
                    $btn = $btn . "<button
                                type='button'
                                class='edit btn btn-danger btn-sm'
                                data-bs-toggle='modal'
                                data-bs-target='#deleteReportModal'
                                onClick='passIdDelete($data->id, $data->territory_id)'>
                                    Deletar
                            </button>";
                    return $btn;
                })
                ->rawColumns(['defStatus'])
                ->make(true);
    }

    public function masterIndex()
    {
        if (Auth::user()->access < 8) :
            return back()->with('message_danger', 'Acesso negado!');
        endif;

        return view('report-master');
    }

    public function masterData(Request $request)
    {
        if (Auth::user()->access < 8) :
            return back()->with('message_danger', 'Acesso negado!');
        endif;

        $request->ajax();
        $cobert = $this->actualCobert();
        $data = Event::join('users', 'events.user_id', '=', 'users.id')
            ->join('territories', 'events.territory_id', '=', 'territories.id')
            ->select(
                'users.name',
                'territories.map',
                'territories.block',
                'events.id',
                'events.territory_id',
                'events.desc2',
                'events.desc3',
                'events.desc4',
            )
            ->where('cobert', $cobert['cobert'])
            ->where('event_type', "doReport");

        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('defStatus', function ($data) {
                    $btn = "<button
                                type='button'
                                class='edit btn btn-primary btn-sm'
                                data-bs-toggle='modal'
                                data-bs-target='#updateReportModal'
                                onClick='passIdUpload($data->id, $data->territory_id)'
                                style='margin-right: 10px;'>
                                    Atualizar
                            </button>";
                    $btn = $btn . "<button
                                type='button'
                                class='edit btn btn-danger btn-sm'
                                data-bs-toggle='modal'
                                data-bs-target='#deleteReportModal'
                                onClick='passIdDelete($data->id, $data->territory_id)'>
                                    Deletar
                            </button>";
                    return $btn;
                })
                ->rawColumns(['defStatus'])
                ->make(true);
    }

    public function updateReport(Request $request)
    {
        $report = Event::find($request->reportUpdateId);
        $report->desc2 = $request->number_of_houses;
        $report->desc3 = $request->number_of_commerces;
        $report->desc4 = $request->number_of_buildings;
        $report->save();

        $territory = Territory::find($request->territoryUpdateId);
        $territory->number_of_houses = $request->number_of_houses;
        $territory->number_of_commerces = $request->number_of_commerces;
        $territory->number_of_buildings = $request->number_of_buildings;
        $territory->save();

        return back()->with('message_success', 'Relatório atualizado com sucesso');
    }

    public function deleteReport(Request $request)
    {
        $report = Event::find($request->reportDeleteId);
        $report->event_type = "delReport";
        $report->desc1 = 0;
        $report->save();

        $cobert = $this->actualCobert();

        $oldData = Event::select('desc2', 'desc3', 'desc4')
                    ->where("territory_id", $request->territoryDeleteId)
                    ->where('cobert', '<', $cobert['cobert'])
                    ->where('event_type', "doReport")
                    ->first();

        $territory = Territory::find($request->territoryDeleteId);
        $territory->worked = 0;
        $territory->number_of_houses = (isset($oldData->desc2) ? $oldData->desc2 : 0);
        $territory->number_of_commerces = (isset($oldData->desc3) ? $oldData->desc3 : 0);
        $territory->number_of_buildings = (isset($oldData->desc4) ? $oldData->desc4 : 0);
        $territory->save();

        return back()->with('message_success', 'Relatório deletado com sucesso');
    }

    public function doS13()
    {
        header('Content-Type: text/html; charset=UTF-8');

        //Variavel para monstarmos a tabela
        $dadosXls  = "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
        $dadosXls .= "<table border='1'>";
        $dadosXls .= "<tr>";
        for ($i = 1; $i <= 24; $i++) :
            $dadosXls .= "<th colspan='2'>Mapa " . $i . "</th>";
        endfor;
        $dadosXls .= "</tr>";

        //Lê cobert atual
        $cobertNow = $this->actualCobert();
        $cobertNow = $cobertNow['cobert'];

        //Passa pelos registros de cada cobert
        for ($i = 1; $i <= $cobertNow; $i++) :
            $dadosXls .= "<tr>";

            //Passa por cada um dos mapas
            for ($j = 1; $j <= 24; $j++) :
                //Lê qual id da primeira quadra do mapa
                $mapFirst = Territory::select('id')
                                ->where('map', $j)
                                ->orderBy('id', 'ASC')
                                ->first();
                $mapFirst = $mapFirst['id'];
                //Lê qual id da última quadra do mapa
                $mapLast = Territory::select('id')
                                ->where('map', $j)
                                ->orderBy('id', 'DESC')
                                ->first();
                $mapLast = $mapLast['id'];

                //Lê quando trabalho no mapa começou
                $temp[$j][0] = Event::select('created_at')
                            ->where('cobert', $i)
                            ->where('event_type', "doReport")
                            ->whereBetween('territory_id', [$mapFirst, $mapLast])
                            ->orderBy('created_at', 'ASC')
                            ->first();

                //Confere se todas as quadras do mapa foram trabalhadas
                $conf = Event::select(DB::raw('COUNT(user_id) AS Qtd'))
                            ->where('cobert', $i)
                            ->where('event_type', "doReport")
                            ->whereBetween('territory_id', [$mapFirst, $mapLast])
                            ->first();
                if ($conf['Qtd'] < ($mapLast - $mapFirst + 1)) :
                    //Se não foi completo, tempo de conclusão fica vazio
                    $temp[$j][1]['created_at'] = "";
                else :
                    //Se foi completo, lê o tempo de conclusão
                    $temp[$j][1] = Event::select('created_at')
                                ->where('cobert', $i)
                                ->where('event_type', "doReport")
                                ->whereBetween('territory_id', [$mapFirst, $mapLast])
                                ->orderBy('created_at', 'DESC')
                                ->first();
                endif;

                //Lê id de qual publicador mais trabalhou no mapa
                $idUser = Event::select('user_id', DB::raw('COUNT(user_id) AS Qtd'))
                    ->where('cobert', $i)
                    ->whereBetween('territory_id', [$mapFirst, $mapLast])
                    ->groupBy('user_id')
                    ->orderBy('Qtd', 'DESC')
                    ->first();

                //Escreve nome do publicador, se houver
                if ($idUser == false) :
                    $dadosXls .= "<td colspan='2'></td>";
                    continue;
                else :
                    $idUser = $idUser['user_id'];
                    $publisher = User::select('name')->where('id', $idUser)->first();
                    $dadosXls .= "<td colspan='2'>" . $publisher['name'] . "</td>";
                endif;
            endfor;

            $dadosXls .= "</tr>";
            $dadosXls .= "<tr>";

            //Passa por cada um dos mapas para preencher as datas trabalhadas
            for ($j = 1; $j <= 24; $j++) :
                //Escreve as datas de inicio e fim do trabalho no mapa, se houver
                if ($temp[$j][0] == false) :
                    $dadosXls .= "<td></td>";
                    $dadosXls .= "<td></td>";
                    continue;
                else :
                    $dadosXls .= "<td>" . substr(
                        $temp[$j][0]['created_at'],
                        0,
                        strpos($temp[$j][0]['created_at'], ' ')
                    ) . "</td>";
                    $dadosXls .= "<td>" . substr(
                        $temp[$j][1]['created_at'],
                        0,
                        strpos($temp[$j][1]['created_at'], ' ')
                    ) . "</td>";
                endif;
            endfor;
            $dadosXls .= "</tr>";
        endfor;
        $dadosXls .= "</table>";

        //Nome do arquivo que será exportado
        $arquivo = "S13.xls";
        //Configurações header para forçar o download
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $arquivo . '"');
        header('Cache-Control: max-age=0');
        //Se for o IE9, isso talvez seja necessário
        header('Cache-Control: max-age=1');
        //Envia o conteúdo do arquivo
        echo $dadosXls;
        exit;
    }

    public function actualCobert()
    {
        $cobert = Event::select('cobert')->orderBy('id', 'DESC')->get()->first();
        return $cobert;
    }
}
