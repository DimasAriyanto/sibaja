<?php

namespace App\Http\Controllers\Transaksi;

use App\DataTables\TransaksiDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Transaksi\StoreTransaksiRequest;
use App\Services\Contracts\TransaksiServiceInterface;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    protected TransaksiServiceInterface $transaksiService;

    public function __construct(
        TransaksiServiceInterface $transaksiService,
    ) {
        $this->transaksiService = $transaksiService;
    }

    public function index(TransaksiDataTable $dataTable)
    {
        return $dataTable->render('transaksi.index');
    }

    public function show(int $id)
    {
        try {
            $transaksi = $this->transaksiService->getById($id);

            return view('transaksi.show', compact('transaksi'));
        } catch (ModelNotFoundException $e) {
            return redirect()
                ->route('dashboard.transaksi.index')
                ->withErrors([
                    'error' => $e->getMessage(),
                ]);
        } catch (Exception $e) {
            return back()->withErrors([
                'error' => 'Ada masalah saat membuka halaman!',
            ]);
        }
    }

    public function create()
    {
        return view('transaksi.create');
    }

    public function store(StoreTransaksiRequest $request)
    {
        try {
            $data = $request->validated();

            $this->transaksiService->create($data);

            return redirect()
                ->back()
                ->with('success', 'Transaksi penjualan berhasil ditambahkan');
        } catch (ModelNotFoundException $e) {
            return redirect()
                ->route('dashboard.transaksi.penjualan.index')
                ->withErrors([
                    'error' => $e->getMessage(),
                ]);
        } catch (Exception $e) {

            return redirect()
                ->back()
                ->withErrors([
                    'error' => 'Gagal menambahkan transaksi penjualan',
                ]);
        }
    }

    public function destroy(int $id)
    {
        try {
            $this->transaksiService->delete($id);

            return redirect()
                ->back()
                ->with('success', 'Transaksi berhasil dihapus');
        } catch (ModelNotFoundException $e) {
            return redirect()
                ->route('dashboard.penjualan.index')
                ->withErrors([
                    'error' => $e->getMessage(),
                ]);
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withErrors([
                    'error' => 'Gagal menghapus transaksi penjualan.',
                ]);
        }
    }
}
