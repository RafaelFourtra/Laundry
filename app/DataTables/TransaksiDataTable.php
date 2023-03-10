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
use Illuminate\Http\Request;
use Carbon\Carbon;

class TransaksiDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function($row, Request $request){
                return '<button type="button" data-id='.$row->no_pesanan.' data-jenis="detail" class="btn mb-2 btn-primary btn-md action  btn-detail"><i class="ti-pencil"></i></button>';
                 })
            ->setRowId('id')
            ->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Transaksi $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Transaksi $model): QueryBuilder
    {
        $from_date = $this->request()->get(key: 'from_date');
        $to_date = $this->request()->get(key: 'to_date');
        $query = $model->newQuery();
 

        if(!empty($from_date) && !empty($to_date)){
            $from_date = Carbon::parse($from_date);
            $to_date = Carbon::parse($to_date);

            $query = $query->whereBetween(column:'transaksi_date', values:[$from_date,$to_date]);
        }

            return $query;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->parameters([ 'searchDelay' => 1000])
                    ->setTableId('transaksi-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('print'),
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            
            Column::make('DT_RowIndex')->title('No')->searchable(false)->orderable(false),
            Column::make('no_pesanan'),
            Column::make('transaksi_jumlah'),
            Column::make('diskon'),
            Column::make('pembayaran'),
            Column::make('kembalian'),
            Column::make('transaksi_date')->title('Tanggal Ambil'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Transaksi_' . date('YmdHis');
    }
}
