<?php

namespace App\DataTables;

use App\Models\DppDocument;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class DppDocumentUiksbuDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        $dataTable->editColumn('file', function($data)
        {
            // $folder = 'discussion/backup/'.$data->folder;
            $link = url('storage/'.$data->file);
            return "<a href=$link><button class='btn btn-md btn-success'> Download </button></a>";
        })->rawColumns(['file','action'])->make(true);
        
        return $dataTable->addColumn('action', 'dpp_documents.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\DppDocument $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(DppDocument $model)
    {
        $model = DppDocument::where(['category' => 'uiksbu']);
        return $model;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px'])
            ->parameters([
                'stateSave' => true,
                'order'     => [[0, 'desc']],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            ['data' => 'name', 'title' => 'Nama Dokumen'],
            ['data' => 'file', 'title' => 'Download'],
            ['data' => 'inputted_by', 'title' => 'Diinput oleh'],
            // ['data' => 'category', 'title' => 'Kategori']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'dpp_documents_datatable_' . time();
    }
}
