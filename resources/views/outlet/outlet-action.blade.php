<div class="modal-content">     
                        
                                    <form id="formAction" action="{{ !isset($outlet) ?  route('outlet.store') :  route('outlet.update', $outlet->id_outlet)}}" method="post">
                                        @csrf
                                        @isset($outlet)
                                        @if($outlet->id_outlet)
                                            @method('put')
                                        @endif
                                        @endisset
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="largeModalLabel">@if(isset($outlet)) Edit Data @else Tambah Data  @endif </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                      <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="alamatOutlet" class="form-label">Alamat</label>
                                                <input type="text"  value="{{isset($outlet) ? $outlet->alamat_outlet : '' }}" placeholder="Alamat" id="alamatOutlet" class="form-control" name="alamat_outlet">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="kota" class="form-label">Kota</label>
                                                <input type="text" value="{{isset($outlet) ?  $outlet->kota : ''  }}"  placeholder="Kota" id="kota" class="form-control" name="kota">
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
                            
        
                            
                            
                       