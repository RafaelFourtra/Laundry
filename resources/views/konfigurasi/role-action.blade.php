                                <div class="modal-content">
                                    <form id="formAction" action="{{ $role->id ? route('roles.update', $role->id) : route('roles.store') }}" method="post">
                                        @csrf
                                        @if($role->id)
                                            @method('put')
                                        @endif
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="largeModalLabel">@if($role->id)Edit Data @else Tambah Data @endif</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                      <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="roleName" class="form-label">Name</label>
                                                <input type="text" value="{{$role->name}}" placeholder="Role Name" id="roleName" class="form-control" name="name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="guardName" class="form-label">Guard</label>
                                                <input type="text" value="{{$role->guard_name}}" placeholder="Guard Name" id="guardName" class="form-control" name="guard_name">
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