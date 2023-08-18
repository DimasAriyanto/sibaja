<?php

namespace App\DataTables;

use App\Models\Transaksi;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TransaksiDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('action', function (Transaksi $transaksi) {
                $detailHref = route('dashboard.penjualan.show', ['id' => $transaksi->id]);
                $deleteAction = route('dashboard.penjualan.destroy', ['id' => $transaksi->id]);
                $methodDelete = method_field('delete');
                $csrf = csrf_field();

                return <<<EOL
              <a href="$detailHref" class="btn btn-sm btn-info text-white">
                <i class="fa-solid fa-circle-info"></i>
                Detail
              </a>
              <form action="$deleteAction" method="post" class="d-inline">
                $csrf
                $methodDelete
                <button type="submit" onclick="alertDeleteForm(event)" class="btn btn-sm btn-danger text-white">
                  <i class="fa-solid fa-trash"></i>
                  Delete
                </button>
              </form>
            EOL;
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Transaksi $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('transaksi-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
            Column::make('id'),
            Column::make('add your columns'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Transaksi_' . date('YmdHis');
    }
}
