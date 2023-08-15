<x-dashboard.layout>
    <x-slot:title>
        Edit User
        </x-slot>
        <x-dashboard.breadcrumb />
        <div class="card">
            <div class="card-header bg-dark text-light fw-bold">Create User</div>
            <div class="card-body">
                @error('error')
                    <div class="mt-2 alert alert-danger">{{ $message }}</div>
                @enderror
                @if (session()->has('success'))
                    <div class="mt-2 alert alert-success">{{ session('success') }}</div>
                @endif
                <form action="{{ route('dashboard.admin.user.store') }}" method="post" class="mb-3">
                    @csrf
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                            id="nama" value="{{ old('nama') }}">
                        @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror"
                            name="username" id="username" value="{{ old('username') }}">
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nik" class="form-label">NIK</label>
                        <input type="text" class="form-control @error('nik') is-invalid @enderror" name="nik" id="nik" value="{{ old('nik') }}">
                        @error('nik')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="unit_kerja" class="form-label">Unit Kerja</label>
                        <input type="text" class="form-control @error('unit_kerja') is-invalid @enderror"
                            name="unit_kerja" id="unit_kerja" value="{{ old('unit_kerja') }}">
                        @error('unit_kerja')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat" value="{{ old('alamat') }}">
                        @error('alamat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" id="password">
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Password Confirmation</label>
                        <input type="password" class="form-control" name="password_confirmation"
                            id="password_confirmation">
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select name="role" id="role"
                            class="form-control form-select @error('role') is-invalid @enderror">
                            @foreach ($types as $type)
                                <option value="{{ $type['value'] }}" @if (old('role') == $type['value']) selected @endif>
                                    {{ $type['name'] }}</option>
                            @endforeach
                        </select>
                        @error('role')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="my-4"></div>
                    <button type="submit" class="btn btn-sm btn-primary">
                        <i class="fa-solid fa-floppy-disk"></i>
                        Simpan
                    </button>
                    <a href="{{ route('dashboard.admin.user.index') }}" class="text-white btn btn-sm btn-info mx-2">
                        <i class="fa-solid fa-backward"></i>
                        Kembali
                    </a>
                </form>
            </div>
        </div>
</x-dashboard.layout>
