<?php

namespace App\Services\Core;

use App\Models\User;
use Illuminate\Container\Attributes\Auth;

class SidebarMenuService
{
    public function build(): array
    {
        $menu = [];

        $menu[] = $this->homeMenu();


        return $menu;
    }

    private function homeMenu(): array
    {
        return [
            'label' => 'Home',
            'items' => [
                [
                    'label' => 'Dashboard',
                    'icon' => 'pi pi-fw pi-home',
                    'route' => route('dashboard')
                ],
            ],
        ];
    }
}
