<div class="modal-content">

    <form id="formAction" action="{{ route('pemesanan.update', $pemesanan->id)}}" method="put">
        @csrf
        @method('put')
        <div class="modal-header">
            <h5 class="modal-title" id="largeModalLabel">Edit Data</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="statusPemesanan" class="form-label">Status</label>
                        <select class="form-select form-select-sm mb-3" aria-label="Default select example"
                            id="statusPemesanan" name="status">
                            <option value="Proses">Proses</option>
                            <option value="Selesai">Selesai</option>
                            <option value="Batal">Batal</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </form>
</div>