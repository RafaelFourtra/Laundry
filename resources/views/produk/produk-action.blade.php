<div class="modal-content">     
                        
                                    <form id="formAction" action="{{ !isset($produk) ?  route('produk.store') :  route('produk.update', $produk->id_produk)}}" method="post">
                                        @csrf
                                        @isset($produk)
                                        @if($produk->id_produk)
                                            @method('put')
                                        @endif
                                        @endisset
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="largeModalLabel">@if(isset($produk)) Edit Data @else Tambah Data  @endif </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                      <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="jenisProduk" class="form-label">Jenis</label>
                                                <input type="text"  value="{{isset($produk) ? $produk->jenis : '' }}" placeholder="Jenis" id="jenisProduk" class="form-control" name="jenis">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="hargaProduk" class="form-label">Harga</label>
                                                <input type="text" value="{{isset($produk) ?  $produk->harga : ''  }}"  placeholder="Harga" id="jenisProduk" class="form-control" name="harga">
                                            </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                            <label for="satuanProduk" class="form-label">Satuan</label><br>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="satuan" id="satuanProduk" value="Kilo" @isset($produk) {{$produk->satuan == 'Kilo'? 'checked' : ''}} @endisset> Kilo
                                                </div>           
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="satuan" id="satuanProduk" value="Potong" @isset($produk) {{$produk->satuan == 'Potong'? 'checked' : ''}} @endisset> Potong
                                                </div>                                                  
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
                            
                            
                            
                       