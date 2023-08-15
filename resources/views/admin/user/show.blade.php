<x-dashboard.layout>
    <x-slot:title>
        Detail User
        </x-slot>
        <x-dashboard.breadcrumb />
        <div class="card">
            <div class="card-header bg-dark text-light fw-bold">Detail User</div>
            <div class="card-body">
                <form>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" readonly class="form-control" id="nama" value="{{ $user->nama }}">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" readonly class="form-control" id="username" value="{{ $user->username }}">
                    </div>
                    <div class="mb-3">
                        <label for="nik" class="form-label">NIK</label>
                        <input type="text" readonly class="form-control" id="nik" value="{{ $user->nik }}">
                    </div>
                    <div class="mb-3">
                        <label for="unit_kerja" class="form-label">Unit Kerja</label>
                        <input type="text" readonly class="form-control" id="unit_kerja" value="{{ $user->unit_kerja }}">
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" readonly class="form-control" id="alamat" value="{{ $user->alamat }}">
                    </div>
                    <div class="mb-3">
                        <label for="unit_kerja" class="form-label">Unit Kerja</label>
                        <input type="text" readonly class="form-control" id="unit_kerja" value="{{ $user->unit_kerja }}">
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <input type="text" readonly class="form-control" id="type"
                            value="{{ ucfirst($user->role) }}">
                    </div>
                    <div class="mb-3">
                        <label for="created_at" class="form-label">Tanggal Dibuat</label>
                        <input type="text" readonly class="form-control" id="created_at"
                            value="{{ $user->created_at }}">
                    </div>
                    <div class="mb-3">
                        <label for="updated_at" class="form-label">Tanggal Diupdate</label>
                        <input type="text" readonly class="form-control" id="updated_at"
                            value="{{ $user->updated_at }}">
                    </div>
                    <div class="my-4"></div>
                    <a href="{{ route('dashboard.admin.user.index') }}" class="text-white btn btn-sm btn-info">
                        <i class="fa-solid fa-backward"></i>
                        Kembali
                    </a>
                </form>
            </div>
        </div>
</x-dashboard.layout>
