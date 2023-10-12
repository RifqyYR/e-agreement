@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Kelola User</h1>
        </div>

        <div class="row">
            <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="table-responsive">
                    <table class="table ">
                        <thead>
                            <tr>
                                <th scope="col" class="font-weight-bold text-dark">#</th>
                                <th scope="col" class="font-weight-bold text-dark">Name</th>
                                <th scope="col" class="font-weight-bold text-dark">Email</th>
                                <th scope="col" class="font-weight-bold text-dark">Role</th>
                                <th scope="col" class="font-weight-bold text-dark">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->isAdmin == 1 ? 'Admin' : 'User Biasa' }}</td>
                                    <td>
                                        <div class="align-items-center d-grip gap-4">
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#editUserModal" onclick="hapusUser('{{ $user->id }}')">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                                                    viewBox="0 0 512 512">
                                                    <style>
                                                        svg {
                                                            fill: #ffffff
                                                        }
                                                    </style>
                                                    <path
                                                        d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z" />
                                                </svg>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#deleteUserModal" onclick="hapusUser('{{ $user->id }}')">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                                                    viewBox="0 0 448 512">
                                                    <style>
                                                        svg {
                                                            fill: #ffffff
                                                        }
                                                    </style>
                                                    <path
                                                        d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus user ini?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                                    id="btn-delete">Batal</button>
                                                <a id="deleteUserLink">
                                                    <button type="button" class="btn btn-danger">Hapus</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit User Form</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="" method="post"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label for="nama">Nama</label>
                                                        <input type="text"
                                                            class="form-control @error('nama') is-invalid @enderror"
                                                            name="nama" value="{{ $user->name }}">
                                                        @error('nama')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input type="text"
                                                            class="form-control @error('email') is-invalid @enderror"
                                                            name="email" value="{{ $user->email }}">
                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                      <label for="role">Role</label>
                                                      <select class="custom-select @error('role') is-invalid @enderror" name="role">
                                                          <option {{ $user->isAdmin == 0 ? 'selected' : '' }} value="0">User Biasa</option>
                                                          <option {{ $user->isAdmin == 1 ? 'selected' : '' }} value="1">Admin</option>
                                                      </select>
                                                      @error('role')
                                                          <span class="invalid-feedback" role="alert">
                                                              <strong>{{ $message }}</strong>
                                                          </span>
                                                      @enderror
                                                  </div>
                                                    <div class="form-group mt-5">
                                                        <input type="submit" class="btn btn-primary" value="Ubah">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
