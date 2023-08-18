<?php

namespace App\Repositories;

use App\Models\Transaksi;
use App\Repositories\Contracts\TransaksiRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class TransaksiRepository implements TransaksiRepositoryInterface
{
    public function getAll(): Collection
    {
        return Transaksi::all();
    }

    public function getById(int $id): ?Transaksi
    {
        return Transaksi::find($id);
    }

    public function create(array $data): Transaksi
    {
        return Transaksi::create($data);
    }

    public function delete(Transaksi $transaksi): bool
    {
        return $transaksi->delete();
    }
}
