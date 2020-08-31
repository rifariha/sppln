<?php

namespace App\DataTables;

use App\Models\Article;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class ArticleDataTable extends DataTable
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
        $dataTable->editColumn('article_category', function ($data) {
            $category = $data->category->category_name;
            return $category;
        });

        $dataTable->editColumn('image', function ($data) {
            $url = asset('storage/' . $data->image);
            return '<img src="' . $url . '" border="0" width="100" align="center" />';
        });

        $dataTable->editColumn('status', function ($data) {
            $status = $data->status == 0 ? 'Unpublished' : 'Published';
            $color = $data->status == 0 ? 'btn-primary' : 'btn-success';

            $link = "
                    <Button type='submit' class='btn btn-sm $color'> $status </button>
            ";
            return $link;
        })->rawColumns(['status','image','article_category','action'])->make(true);
        
        return $dataTable->addColumn('action', 'articles.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Article $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Article $model)
    {
        $model = Article::select(['article.*'])->with('category');
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
                'responsive' => true,
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
            'image',
            ['data' => 'title', 'title' => 'Judul'],
            ['data' => 'article_category', 'title' => 'Kategori', 'searchable' => false],
            ['data' => 'created_by', 'title' => 'Ditulis Oleh'],
            'status'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'articles_datatable_' . time();
    }
}
