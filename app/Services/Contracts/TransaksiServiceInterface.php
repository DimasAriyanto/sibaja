<?php

namespace App\Services\Contracts;

use App\Models\Transaksi;
use Illuminate\Database\Eloquent\Collection;

interface TransaksiServiceInterface
{
    public function getAll(): Collection;

    public function getById(int $id): Transaksi;

    public function create(array $data): Transaksi;

    public function delete(int $id): bool;
}
