<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\UsersDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Services\Contracts\UserServiceInterface;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class UserController extends Controller
{

    protected $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('admin.user.index');
    }

    public function show(int $id)
    {
        try {
            $user = $this->userService->getById($id);

            return view('admin.user.show', compact('user'));
        } catch (ModelNotFoundException $e) {
            return redirect()
                ->route('dashboard.admin.user.index')
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
        $types = $this->userService->getMappedUserTypes();

        return view('admin.user.create', compact('types'));
    }

    public function edit(int $id)
    {
        try {
            $user = $this->userService->getById($id);
            $types = $this->userService->getMappedUserTypes();

            return view('admin.user.edit', compact('user', 'types'));
        } catch (ModelNotFoundException $e) {
            return redirect()
                ->route('dashboard.admin.user.index')
                ->withErrors([
                    'error' => $e->getMessage(),
                ]);
        } catch (Exception $e) {
            return back()->withErrors([
                'error' => 'Ada masalah saat membuka halaman!',
            ]);
        }
    }

    public function store(StoreUserRequest $request)
    {
        try {
            $data = $request->validated();
            $this->userService->create($data);

            return redirect()
                ->back()
                ->with('success', 'User berhasil ditambahkan');
        } catch (ModelNotFoundException $e) {
            return redirect()
                ->route('dashboard.admin.user.index')
                ->withErrors([
                    'error' => $e->getMessage(),
                ]);
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withErrors([
                    'error' => 'Gagal menambah user.',
                ]);
        }
    }

    public function update(UpdateUserRequest $request, int $id)
    {
        try {
            $data = $request->validated();
            if (empty($data['password'])) {
                unset($data['password']);
            }
            $this->userService->update($id, $data);

            return redirect()
                ->back()
                ->with('success', 'User berhasil diubah');
        } catch (ModelNotFoundException $e) {
            return redirect()
                ->route('dashboard.admin.user.index')
                ->withErrors([
                    'error' => $e->getMessage(),
                ]);
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withErrors([
                    'error' => $e->getMessage(),
                ]);
        }
    }

    public function destroy(int $id)
    {
        try {
            $this->userService->delete($id);

            return redirect()
                ->back()
                ->with('success', 'User berhasil dihapus');
        } catch (ModelNotFoundException $e) {
            return redirect()
                ->route('dashboard.admin.user.index')
                ->withErrors([
                    'error' => $e->getMessage(),
                ]);
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withErrors([
                    'error' => $e->getMessage(),
                ]);
        }
    }
}
