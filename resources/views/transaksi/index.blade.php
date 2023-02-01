@extends('layouts.master')
<link rel=stylesheet href="{{ asset('vendor/datatables.net-dt/css/jquery.dataTables.min.css')}}" />
<link rel=stylesheet href="{{ asset('vendor/datatables.net-responsive-dt/css/responsive.dataTables.min.css') }}" />
@section('content')
<div class="main-content">
    <div class="title">
        Transaksi
    </div>
    <div class="content-wrapper">
        <div class="row same-height">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        <form id="form-trans" action="{{ route('transaksi.store') }}" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-8">

                                        <div class="card-body">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th scope="col">No Pesanan</th>
                                                        <th><a href="#" class="btn btn-sm btn-success  rounded-circle"
                                                                id="add_order"><i class="fa fa-plus-circle"></i></a>
                                                        </th>

                                                    </tr>
                                                </thead>
                                                <tbody class="addMoreOrder">
                                                    <tr>
                                                        <td>1</td>
                                                        <td>
                                                            <select class="form-control no_pesanan" id="no_pesanan"
                                                                name="no_pesanan">
                                                                <option value="">Select Item
                                                                </option>
                                                                @foreach($pemesanan as $p)
                                                                <option value='{{ $p->no_pesanan }}' required>
                                                                    {{ $p->no_pesanan }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <a href=""
                                                                class="btn btn-sm btn-danger delete rounded-circle"><i
                                                                    class="fa fa-times"></i></a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="card-header">
                                            <input type="hidden" class="total-span-input" value="" name="transaksi_jumlah">
                                            <h4>Total <b class="total total-span" >0.00</b></h4>
                                        </div>

                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-12 pelanggan d-grid gap-1">

                                                    <label for="pembayaran">Pembayaran</label>
                                                    <input type="number" name="pembayaran" id="pembayaran"
                                                        class="form-control pembayaran" required>
                                                    <label for="kembalian">Kembalian</label>
                                                    <input type="number" name="kembalian" id="kembalian"
                                                        class="form-control kembalian" required readonly>
                                                </div>
                                            </div>
                                        </div><br>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>

                            </div>






                    </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="row same-height">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        @if(request()->user()->hasRole(['admin', 'petugas']))
                        <div class="col-md-2">
                            <a href="{{ route('pemesanan.create') }}" type="button"
                                class="btn mb-2 btn-success btn-add">
                                <i class="ti-plus"></i> Tambah</a>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalAction" tabindex="-1" aria-labelledby="largeModalLabel" style="display: none;"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">

    </div>
</div>
</div>

@endsection
<script src="{{ asset('vendor/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('vendor/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
{{ $dataTable->scripts() }}
<script>
$(document).ready(function() {
    store();
    function store(){
            $('#form-trans').on('submit', function(e){
                e.preventDefault()
                const _form = this
                const formData = new FormData(_form)

                const url = this.getAttribute('action')     

                $.ajax({
                    method: 'POST',
                    url,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res){
                        
                        window.LaravelDataTables["transaksi-table"].ajax.reload()
                    },
                    error: function(res){
                       let errors = res.responseJSON?.errors
                       $(_form).find('.text-danger.text-small').remove()
                        if(errors){
                            for(const [key, value] of Object.entries(errors)){
                                $(`[name='${key}']`).parent().append(`<span class="text-danger text-small">${value}</span>`)
                            }
                        }
                    }
                })
            })
        }
    $('#pembayaran').keyup(function() {
            var total = $('.total-span-input').val();
            var pembayaran = $(this).val();
            var tot = pembayaran - total;
            $('#kembalian').val(tot).toFixed(2);
        });
    $(document).delegate("#no_pesanan", "change", function() {
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr("content")
            },
            type: "post",
            data: {
                no: $(this).val(),
                get: ["total_harga", "json"],
                status: ["proses"]
            },
            dataType: "json",
            url: "/getdetailpesanan",
            success: function(data) {
                console.log(data);
                if (data != null) {
                    $(".total-span").text(data["total_harga"]);
                    $(".total-span-input").val(data["total_harga"]);
                } else {
                    alert("Hanya boleh proses");
                }

            },
            error: function(err) {
                alert(err.responseText);
            }
        });
    });

});
</script>