                        <div class="modal-content">     
                        
                                    <form id="formAction" action="{{ !isset($user) ?  route('users.store') :  route('users.update', $user->id)}}" method="post">
                                        @csrf
                                        @isset($user)
                                        @if($user->id)
                                            @method('put')
                                        @endif
                                        @endisset
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="largeModalLabel">@if(isset($user)) Edit Data @else Tambah Data  @endif </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                      <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="userEmail" class="form-label">Email</label>
                                                <input type="email"  value="{{isset($user) ? $user->email : '' }}" placeholder="Email" id="userEmail" class="form-control" name="email">
                                            </div>
                                        </div>
                                        @if(!isset($user)) 
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="userPassword" class="form-label">Password</label>
                                                <input type="password" value="{{isset($user) ?  $user->password : ''  }}"  placeholder="Password" id="userPassword" class="form-control" name="password">
                                            </div>
                                        </div>
                                     @endif
                                      </div>
                                      <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="userName" class="form-label">Name</label>
                                                <input type="text" value="{{isset($user) ?  $user->name : ''   }}" placeholder="Name" id="userName" class="form-control" name="name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                            <label for="id_outlet">Outlet</label>
                                                <select class="form-select form-select-sm mb-3 outlet" aria-label="Default select example" id="outlet" name="outlet">
                                                    <option value="">Outlet</option>
                                                    @foreach($outlet as $ol)
                                                    <option   value='{{ $ol->alamat_outlet }} , {{ $ol->kota }}' required>{{ $ol->alamat_outlet }} , {{ $ol->kota }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                            <label for="userRole" class="form-label">Role</label>
                                                <select class="form-select form-select-sm mb-3" aria-label="Default select example" id="userRole" name="role">
                                                @foreach ($role as $r) 
                                                    <option value="{{$r->name}}" class="option-role" @isset($user) @if($user->roles[0]->name == $r->name)  selected @endif @endisset>{{$r->name}}</option>
                                                @endforeach
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
                            
                            
                            
                       