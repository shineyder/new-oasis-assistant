<?php

namespace App\DataTables;

use App\Models\User as Publisher;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PublisherDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', 'publisher.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Publisher $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Publisher $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('publisher-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            ['data' => 'name', 'name' => 'name', 'title' => 'Nome'],
            ['data' => 'email', 'name' => 'email', 'title' => 'Email'],
            ['data' => 'group', 'name' => 'group', 'title' => 'Grupo'],
            ['data' => 'access', 'name' => 'access', 'title' => 'Acesso'],
            //'Definir Grupo',
            //'Definir Acesso'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Publisher_' . date('YmdHis');
    }
}
