<?php

namespace App\DataTables;

use App\Models\Pelanggan;
use App\Models\Detail_Pemesanan;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Http\Request;

class PelangganDataTable extends DataTable
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
               return '<button type="button" data-id='.$row->id_pelanggan.' data-jenis="edit" class="btn mb-2 btn-primary btn-md action"><i class="ti-pencil"></i></button> <button type="button" data-id='.$row->id_pelanggan.' data-jenis="delete" class="btn mb-2 btn-danger btn-md action"><i class="ti-trash"></i></button>';
        })
            ->addIndexColumn()
            ->editColumn('riwayat_order', function($data){
                $idPelanggan = $data->id_pelanggan;
                $datapelanggan = Detail_Pemesanan::where("id_pelanggan",$idPelanggan)->get()->pluck("id_pemesan");
                // dd($datapelanggan);
                 $no = 0;
                 foreach($datapelanggan as $i => $ds){
                     if(isset($datapelanggan[$i-1])){
                         if($datapelanggan[$i] != $datapelanggan[$i-1]){
                             $no++;
                         }
                     }else{
                        $no++;
                     }
                     
                 }
                 return $no;

            })
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Pelanggan $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Pelanggan $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->parameters(['searchDelay' => 1000])
                    ->setTableId('pelanggan-table')
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
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
          
            Column::make('DT_RowIndex')->width(40)->title('No')->searchable(false)->orderable(false),
            Column::make('nama_pelanggan')->title('Nama')->width(140),
            Column::make('contact_pelanggan')->title('Contact')->width(140),
            Column::make('alamat_pelanggan')->title('Alamat')->width(200),
            Column::make('riwayat_order')->title('Riwayat')->width(60),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(100)
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
        return 'Pelanggan_' . date('YmdHis');
    }
}