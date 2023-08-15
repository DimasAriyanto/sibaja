<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Services\Contracts\UserServiceInterface;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function index(int $id)
    {
        try {
            $user = $this->userService->getById($id);

            return view('profile.index', compact('user'));
        } catch (ModelNotFoundException $e) {
            return redirect()
                ->route('dashboard.index')
                ->withErrors([
                    'error' => $e->getMessage(),
                ]);
        } catch (Exception $e) {
            return back()->withErrors([
                'error' => 'Ada masalah saat membuka halaman!',
            ]);
        }
    }
}
