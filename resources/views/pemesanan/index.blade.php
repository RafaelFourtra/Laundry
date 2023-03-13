@extends('layouts.master')
<link rel=stylesheet href="{{ asset('vendor/datatables.net-dt/css/jquery.dataTables.min.css')}}" />
<link rel=stylesheet href="{{ asset('vendor/datatables.net-responsive-dt/css/responsive.dataTables.min.css') }}" />
@section('content')
<div class="main-content">
    <div class="title">
        Pemesanan
    </div>
    <div class="content-wrapper">
        <div class="row same-height">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                         
                            <div class="col-md-2">
                                <select class="form-select select-status" id="select">
                                    <option value="Proses" selected>Proses</option>
                                    <option value="Selesai">Selesai</option>
                                    <option value="Batal">Batal</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <a href="{{ route('pemesanan.create') }}" type="button"
                                    class="btn btn-sm mb-2 btn-success btn-add">
                                    <i class="ti-plus"></i> Tambah</a>
                            </div>
                      
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
    //Filter

    const table = $("#pemesanan-table");
    $(".select-status").change(function() {
        table.on('preXhr.dt', function(e, s, d) {

            d.status = $(".select-status").val();
        })

        table.DataTable().ajax.reload();
    });





    const modal = new bootstrap.Modal($('#modalAction'))


    function store() {
        $('#formAction').on('submit', function(e) {
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
                success: function(res) {
                    console.log(res);
                    window.LaravelDataTables["pemesanan-table"].ajax.reload()
                    modal.hide()
                },
                error: function(res) {
                    let errors = res.responseJSON?.errors
                    $(_form).find('.text-danger.text-small').remove()
                    if (errors) {
                        for (const [key, value] of Object.entries(errors)) {
                            $(`[name='${key}']`).parent().append(
                                `<span class="text-danger text-small">${value}</span>`
                            )
                        }
                    }
                }
            })
        })
    }
    $('#pemesanan-table').on('click', '.action', function() {
        let data = $(this).data()
        let id = data.id
        let jenis = data.jenis


        $.ajax({
            method: 'get',
            url: `{{url('pemesanan/')}}/${id}/edit`,
            success: function(res) {
                console.log(res);
                $('#modalAction').find('.modal-Dialog').html(res)
                modal.show()
                store()
            },
            error: function(res) {
                alert(res.responseText)
            },
        })
    })
})
</script>