<?php

namespace App\Repositories\Contracts;

use App\Models\Transaksi;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

interface TransaksiRepositoryInterface
{
    public function getAll(): Collection;

    public function getById(int $id): ?Transaksi;

    public function create(array $data): Transaksi;

    public function delete(Transaksi $transaksi): bool;
}
