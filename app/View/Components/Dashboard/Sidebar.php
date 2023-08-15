<?php

namespace App\View\Components\Dashboard;

use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Sidebar extends Component
{
    public $menu, $user;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->user = Auth::user();

        $profileRoute = route('dashboard.profile.index', ['id' => $this->user->id]);

        $this->menu = [
            [
                'name' => 'Dashboard',
                'icon' => 'fa-solid fa-home',
                'route' => route('dashboard.index'),
            ],
            [
                'name' => 'Admin',
                'icon' => 'fa-solid fa-layer-group',
                'route' => '#',
                'role' => ['admin'],
                'child' => [
                    [
                        'name' => 'Pengguna',
                        'route' => route('dashboard.admin.user.index'),
                    ],
                ],
            ],
            [
                'name' => 'Transaksi',
                'icon' => 'fa-solid fa-wallet',
                'route' => route('dashboard.transaksi.index'),
            ],
            // [
            //     'name' => 'Sinkron Data',
            //     'icon' => 'fa-solid fa-money-bill',
            //     'route' => route('dashboard.sinkrondata.index'),
            // ],
            [
                'name' => 'Profile',
                'icon' => 'fa-solid fa-user',
                'route' => $profileRoute,
            ],
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.sidebar');
    }
}
