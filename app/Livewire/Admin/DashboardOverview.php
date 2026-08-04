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
    public $chartLabels = [];
    public $chartData = [];

    public function mount()
    {
        $this->totalArticles   = Article::count();
        $this->totalProducts   = Product::count();
        $this->totalTeam       = TeamProfile::count();
        $this->totalLegalities = Legality::count();

        $this->recentActivities = ActivityLog::with('user')->latest()->take(8)->get();
        $this->buildChartData();
    }

    protected function buildChartData()
    {
        $data = Article::selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->whereBetween('created_at', [now()->subMonths(5)->startOfMonth(), now()->endOfMonth()])
            ->groupBy('bulan')->pluck('total', 'bulan');

        $bulanIndo = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
        foreach (range(5, 0) as $i) {
            $bulanKe = now()->subMonths($i)->month;
            $this->chartLabels[] = $bulanIndo[$bulanKe - 1];
            $this->chartData[]   = $data[$bulanKe] ?? 0;
        }
    }

    public function render()
    {
        return view('livewire.admin.dashboard-overview')
            ->layout('layouts.admin');
    }
}
