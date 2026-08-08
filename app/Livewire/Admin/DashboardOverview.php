<?php

namespace App\Livewire\Admin;

use App\Models\{Article, Product, TeamProfile, Legality, ActivityLog};
use Livewire\Component;

class DashboardOverview extends Component
{
    public $totalArticles;
    public $totalProducts;
    public $totalTeam;
    public $totalLegalities;
    public $recentActivities;

    public function mount()
    {
        $this->totalArticles   = Article::count();
        $this->totalProducts   = Product::count();
        $this->totalTeam       = TeamProfile::count();
        $this->totalLegalities = Legality::count();

        $this->recentActivities = ActivityLog::with('user')->latest()->take(6)->get();
    }

    public function activityIcon(string $module): string
    {
        return match ($module) {
            'artikel'          => 'newspaper',
            'produk'           => 'shopping-cart',
            'info_lingkungan'  => 'globe-alt',
            'data_demografis'  => 'chart-bar-square',
            'legalitas'        => 'shield-check',
            'profil_tim'       => 'user-group',
            'mitra'            => 'user-group',
            default            => 'bell',
        };
    }

    public function render()
    {
        return view('livewire.admin.dashboard-overview')
            ->layout('layouts.admin');
    }
}