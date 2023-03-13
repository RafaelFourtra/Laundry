<?php

namespace App\DataTables;

use App\Models\Pemesanan;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\Models\Detail_Pemesanan;
use Illuminate\Http\Request;

class PemesananDataTable extends DataTable
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
            return '<button type="button" data-id='.$row->id.' data-jenis="edit" class="btn mb-2 btn-primary btn-md action"><i class="ti-pencil"></i></button> ';
            })
            ->setRowId('id')
            ->addColumn('nama_pelanggan', function($data){
                $id = $data->detail_pesanan->first()->id;
                $datapelanggan = Detail_Pemesanan::with("pelanggan")->find($id)->pelanggan;
               
              
                return $datapelanggan->nama_pelanggan;

            })
            ->addColumn('alamat_pelanggan', function($data){
                $id = $data->detail_pesanan->first()->id;
                $datapelanggan = Detail_Pemesanan::with("pelanggan")->find($id)->pelanggan;
               
              
                return $datapelanggan->alamat_pelanggan;

            })
            ->addColumn('user', function($data){
                //masih objek
                $usersdata = $data->user->outlet;

                return $usersdata;
            })
            ->addColumn('contact_pelanggan', function($data){
                $id = $data->detail_pesanan->first()->id;
                $datapelanggan = Detail_Pemesanan::with("pelanggan")->find($id)->pelanggan;
               
              
                return $datapelanggan->contact_pelanggan;

            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Pemesanan $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Pemesanan $model): QueryBuilder
    {
        $query = $model->with('user.outlet');
        $status = $this->request->get("status") == null ? "Proses" :  $this->request->get("status");

        if($status==null){
           return $query->newQuery();
        }
        //dd($status);
        return $model->where('status', $status);
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
                    ->setTableId('pemesanan-table')
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
           
            Column::make('no_pesanan')->orderable(false)->title('ID Order'),  
            Column::computed('nama_pelanggan'), 
            Column::computed('contact_pelanggan'),
            Column::computed('alamat_pelanggan'),  
            Column::computed('user')->title('Outlet'),  
            Column::make('status'), 
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
        return 'Pemesanan_' . date('YmdHis');
    }
}