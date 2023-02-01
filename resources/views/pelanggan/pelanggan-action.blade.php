<div class="modal-content">     
                        
                                    <form id="formAction" action="{{ !isset($pelanggan) ?  route('pelanggan.store') :  route('pelanggan.update', $pelanggan->id_pelanggan)}}" method="post">
                                        @csrf
                                        @isset($pelanggan)
                                        @if($pelanggan->id_pelanggan)
                                            @method('put')
                                        @endif
                                        @endisset
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="largeModalLabel">@if(isset($pelanggan)) Edit Data @else Tambah Data  @endif </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                      <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="pelangganNama" class="form-label">Nama</label>
                                                <input type="text"  value="{{isset($pelanggan) ? $pelanggan->nama_pelanggan : '' }}" placeholder="Nama" id="pelangganNama" class="form-control" name="nama_pelanggan">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="pelangganContact" class="form-label">Contact</label>
                                                <input type="text" value="{{isset($pelanggan) ?  $pelanggan->contact_pelanggan : ''  }}"  placeholder="Contact" id="pelangganContact" class="form-control" name="contact_pelanggan">
                                            </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="pelangganAlamat" class="form-label">Alamat</label>
                                                <input type="text" value="{{isset($pelanggan) ?  $pelanggan->alamat_pelanggan : ''   }}" placeholder="Alamat" id="pelangganAlamat" class="form-control" name="alamat_pelanggan">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                            <label for="pelangganRiwayat" class="form-label">Riwayat Order</label>
                                                <input type="text" value="{{isset($pelanggan) ?  $pelanggan->riwayat_order : ''   }}" placeholder="Riwayat Order" id="pelangganRiwayat" class="form-control" name="riwayat_order">
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
                            
                            
                            
                       