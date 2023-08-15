<?php

namespace App\View\Components\Dashboard;

use App\Services\BreadcrumbItemService;
use App\Services\Contracts\BreadcrumbServiceInterface;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Breadcrumb extends Component
{
    public array $breadcrumb = [];

    /**
     * Create a new component instance.
     */
    public function __construct(BreadcrumbServiceInterface $breadcrumbService)
    {

        $breadcrumbService->register(
            'dashboard.index',
            BreadcrumbItemService::make()
                ->addName('Dashboard')
                ->addIcon('fa-solid fa-home')
                ->addRoute('dashboard.index')
        );

        $breadcrumbItemAdmin = BreadcrumbItemService::make()
            ->addName('Admin')
            ->addIcon('fa-solid fa-layer-group');


        // admin User
        $breadcrumbService
            ->registerUsing('dashboard.admin.user.index', 'dashboard.index')
            ->register('dashboard.admin.user.index', $breadcrumbItemAdmin)
            ->register(
                'dashboard.admin.user.index',
                BreadcrumbItemService::make()
                    ->addName('User')
                    ->addIcon('fa-solid fa-user')
                    ->addRoute('dashboard.admin.user.index')
            )
            ->registerUsing('dashboard.admin.user.create', 'dashboard.admin.user.index')
            ->register(
                'dashboard.admin.user.create',
                BreadcrumbItemService::make()
                    ->addName('Create User')
                    ->addIcon('fa-solid fa-plus')
                    ->addRoute('dashboard.admin.user.create')
            )
            ->registerUsing('dashboard.admin.user.show', 'dashboard.admin.user.index')
            ->register(
                'dashboard.admin.user.show',
                BreadcrumbItemService::make()
                    ->addName('Detail User')
                    ->addIcon('fa-solid fa-eye')
                    ->addRouteWithParameters('dashboard.admin.user.show')
            )
            ->registerUsing('dashboard.admin.user.edit', 'dashboard.admin.user.index')
            ->register(
                'dashboard.admin.user.edit',
                BreadcrumbItemService::make()
                    ->addName('Edit User')
                    ->addIcon('fa-solid fa-pen-to-square')
                    ->addRouteWithParameters('dashboard.admin.user.edit')
            );

        $breadcrumbItemTransaksi = BreadcrumbItemService::make()
            ->addName('Transaksi')
            ->addIcon('fa-solid fa-table');

        // Transaksi
        $breadcrumbService
            ->registerUsing('dashboard.transaksi.index', 'dashboard.index')
            ->register('dashboard.transaksi.index', $breadcrumbItemTransaksi)
            ->register(
                'dashboard.transaksi.index',
                BreadcrumbItemService::make()
                    ->addName('Transaksi')
                    ->addRoute('dashboard.transaksi.index')
            )
            ->registerUsing('dashboard.transaksi.show', 'dashboard.transaksi.index')
            ->register(
                'dashboard.transaks..show',
                BreadcrumbItemService::make()
                    ->addName('Detail Transaksi')
                    ->addRouteWithParameters('dashboard.transaksi.show')
            )
            ->registerUsing('dashboard.transaksi.create', 'dashboard.transaksi.index')
            ->register(
                'dashboard.transaksi.create',
                BreadcrumbItemService::make()
                    ->addName('Input Transaksi')
                    ->addRoute('dashboard.transaksi.create')
            );

        $breadcrumbService
            ->registerUsing('dashboard.profile.index', 'dashboard.index')
            ->register(
                'dashboard.profile.index',
                BreadcrumbItemService::make()
                    ->addName('Profile')
                    ->addIcon('fa-solid fa-profile')
                    ->addRouteWithParameters('dashboard.profile.index')
            );

            $this->breadcrumb = $breadcrumbService->resolve();

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.breadcrumb');
    }
}
