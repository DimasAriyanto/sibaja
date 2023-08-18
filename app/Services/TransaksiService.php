<?php

namespace App\Services;

use App\Models\Transaksi;
use App\Repositories\Contracts\TransaksiRepositoryInterface;
use App\Services\Contracts\TransaksiServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class TransaksiService implements TransaksiServiceInterface
{
    protected TransaksiRepositoryInterface $transaksiRepository;

    public function __construct(
        TransaksiRepositoryInterface $transaksiRepository,
    ) {
        $this->transaksiRepository = $transaksiRepository;
    }

    public function getAll(): Collection
    {
        return $this->transaksiRepository->getAll;
    }

    public function getById(int $id): Transaksi
    {
        $penjualan = $this->transaksiRepository->getById($id);
        if (! $penjualan) {
            throw new ModelNotFoundException('Transaksi penjualan dengan id '.$id.' tidak ditemukan');
        }

        return $penjualan;
    }

    public function create(array $data): Transaksi
    {
        $data['user_id'] = Auth::id();
        $data['tanggal_transaksi'] = now();

        return $this->transaksiRepository->create($data);
    }

    public function delete(int $id): bool
    {
        $transaksi = $this->getById($id);

        return $this->transaksiRepository->delete($transaksi);
    }
}
