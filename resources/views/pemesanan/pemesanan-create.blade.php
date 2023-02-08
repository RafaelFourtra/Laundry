@extends('layouts.master')
<link rel=stylesheet href="{{ asset('vendor/datatables.net-dt/css/jquery.dataTables.min.css')}}" />
<link rel=stylesheet href="{{ asset('vendor/datatables.net-responsive-dt/css/responsive.dataTables.min.css') }}" />
@section('content')

<div class="main-content">
    <form action="{{ route('pemesanan.store') }}" method="post">

        <div class="title">

            @csrf
         
        </div>
        <br>

        <div class="content-wrapper">
            <div class="row same-height">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-8">

                                    <div class="card-body">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th scope="col">Jenis</th>
                                                    <th scope="col">Jumlah</th>
                                                    <th scope="col">Satuan</th>
                                                    <th scope="col">Harga</th>
                                                    <th scope="col">Total</th>
                                                    <th><a href="#" class="btn btn-sm btn-success  rounded-circle"
                                                            id="add_order"><i class="fa fa-plus-circle"></i></a></th>

                                                </tr>
                                            </thead>
                                            <tbody class="addMoreOrder">
                                                <tr>
                                                    <td>1</td>
                                                    <td>
                                                        <select class="form-control id_produk" id="id_produk"
                                                            name="id_produk[]">
                                                            <option value="">Select Item</option>
                                                            @foreach($produk as $p)
                                                            <option data-harga='{{ $p->harga }}'
                                                                data-satuan='{{ $p->satuan }}'
                                                                value='{{ $p->id_produk }}' required>{{ $p->jenis }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="jumlah[]" id="jumlah"
                                                            class="form-control jumlah" required>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="satuan[]" id="satuan"
                                                            class="form-control satuan" required>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="harga[]" id="harga"
                                                            class="form-control harga" required>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="total_harga[]" id="total_harga"
                                                            class="form-control total_harga" required>
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
                                        <h4>Total <b class="total">0.00</b></h4>
                                    </div>

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12 pelanggan d-grid gap-1">

                                                <label for="id_pelanggan">Nama</label>
                                                <select class="form-control id_pelanggan" id="id_pelanggan"
                                                    name="id_pelanggan">
                                                    <option value=""></option>
                                                    @foreach($pelanggan as $pl)
                                                    <option data-contact='{{ $pl->contact_pelanggan }}'
                                                        data-alamat='{{ $pl->alamat_pelanggan }}'
                                                        value='{{ $pl->id_pelanggan }}' required>
                                                        {{ $pl->nama_pelanggan }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                <label for="contact_pelanggan">Contact</label>
                                                <input type="text" name="contact_pelanggan[]" id="contact_pelanggan"
                                                    class="form-control contact_pelanggan" readonly>
                                                <label for="alamat_pelanggan">Alamat</label>
                                                <input type="text" name="alamat_pelanggan[]" id="alamat_pelanggan"
                                                    class="form-control alamat_pelanggan" readonly>
                                            </div>
                                        </div><br>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </form>
</div>
@endsection
<script src="{{ asset('vendor/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('vendor/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>

<script>
$(".myList").hide();

$('#add_order').on('click', function(e) {

    var produk = $(".id_produk").html();
    var numberofrow = ($('.addMoreOrder tr').length - 0) + 1;
    var tr = '<tr><td class="no">' + numberofrow + '</td>' +
        '<td><select class="form-control id_produk" name="id_produk[]">' + produk + '</select></td>' +
        '<td> <input type="number" name="jumlah[]" class="form-control jumlah"></td>' +
        '<td> <input type="text" name="satuan[]" class="form-control satuan"></td>' +
        '<td> <input type="number" name="harga[]" class="form-control harga"></td>' +
        '<td> <input type="number" name="total_harga[]" class="form-control total_harga"></td>' +
        '<td><a href="" class="btn btn-sm btn-danger delete rounded-circle"><i class="fa fa-times"></i></a></td>';
    $('.addMoreOrder').append(tr);
});
$('.addMoreOrder').delegate('.delete', 'click', function(e) {
    e.preventDefault();
    $(this).parent().parent().remove();
});

function TotalHarga() {
    var total = 0;
    $('.total_harga').each(function(i, e) {
        var amount = $(this).val() - 0;
        total += amount;
    });
    $('.total').html(total);

};
$(document).ready(function() {
    $(".myList").hide();

    $('#add_order').on('click', function(e) {

        var produk = $(".id_produk").html();
        var numberofrow = ($('.addMoreOrder tr').length - 0) + 1;
        var tr = '<tr><td class="no">' + numberofrow + '</td>' +
            '<td><select class="form-control id_produk" name="id_produk[]">' + produk +
            '</select></td>' +
            '<td> <input type="number" name="jumlah[]" class="form-control jumlah"></td>' +
            '<td> <input type="text" name="satuan[]" class="form-control satuan"></td>' +
            '<td> <input type="number" name="harga[]" class="form-control harga"></td>' +
            '<td> <input type="number" name="total_harga[]" class="form-control total_harga"></td>' +
            '<td><a href="" class="btn btn-sm btn-danger delete rounded-circle"><i class="fa fa-times"></i></a></td>';
        $('.addMoreOrder').append(tr);
    });

    $('.addMoreOrder').delegate('.delete', 'click', function(e) {
        e.preventDefault();
        $(this).parent().parent().remove();
    });

    function TotalHarga() {
        var total = 0;
        $('.total_harga').each(function(i, e) {
            var amount = $(this).val() - 0;
            total += amount;
        });
        $('.total').html(total);

    };
    $('.addMoreOrder').delegate('.id_produk', 'change', function() {

        var tr = $(this).parent().parent();
        var harga = tr.find('.id_produk option:selected').attr('data-harga');
        tr.find('.harga').val(harga);
        var satuan = tr.find('.id_produk option:selected').attr('data-satuan');
        tr.find('.satuan').val(satuan);
        var jumlah = tr.find('.jumlah').val() - 0;
        var harga = tr.find('.harga').val() - 0;
        var satuan = tr.find('.satuan').val() - 0;
        var total_harga = (jumlah * harga);
        tr.find('.total_harga').val(total_harga);
        TotalHarga();
    });

    $('.addMoreOrder').delegate('.jumlah , .diskon', 'keyup', function() {
        var tr = $(this).parent().parent();
        var harga = tr.find('.id_produk option:selected').attr('data-harga');
        tr.find('.harga').val(harga);
        var satuan = tr.find('.id_produk option:selected').attr('data-satuan');
        tr.find('.satuan').val(satuan);
        var jumlah = tr.find('.jumlah').val() - 0;
        var harga = tr.find('.harga').val() - 0;
        var satuan = tr.find('.satuan').val() - 0;
        var total_harga = (jumlah * harga);
        tr.find('.total_harga').val(total_harga);
        TotalHarga();
    });

    $('.pelanggan').delegate('.id_pelanggan', 'change', function() {

        var div = $(this).parent();

        var contact = div.find('.id_pelanggan option:selected').attr('data-contact');
        div.find('.contact_pelanggan').val(contact);
        var alamat = div.find('.id_pelanggan option:selected').attr('data-alamat');
        div.find('.alamat_pelanggan').val(alamat);

    });
});
</script>