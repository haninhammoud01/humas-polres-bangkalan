@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container-fluid px-4">
    
    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <p class="text-muted mb-0">Selamat datang, {{ auth()->user()->nama }}!</p>
        </div>
        <div class="text-muted">
            <i class="far fa-calendar me-2"></i>
            {{ now()->translatedFormat('l, d F Y') }}
        </div>
    </div>

    {{-- Quick Stats Cards --}}
    <div class="row g-4 mb-4">
        @foreach($quickStats as $stat)
        <div class="col-md-6 col-xl-3">
            <div class="stat-card stat-card-{{ $stat['color'] }}">
                <div class="stat-icon">
                    <i class="fas {{ $stat['icon'] }}"></i>
                </div>
                <div class="stat-content">
                    <h3 class="stat-value">{{ $stat['value'] }}</h3>
                    <p class="stat-title">{{ $stat['title'] }}</p>
                    <small class="stat-change">{{ $stat['change'] }}</small>
                </div>
                <a href="{{ $stat['link'] }}" class="stat-link">
                    Lihat Detail <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
        @endforeach
    </div>

    <div class="row g-4">
        {{-- Chart Section --}}
        <div class="col-xl-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="mb-0 fw-bold" style="color: #1a1a1a;">
                        <i class="fas fa-chart-line me-2"></i>Statistik Berita (6 Bulan Terakhir)
                    </h5>
                </div>
                <div class="card-body p-4">
                    <canvas id="beritaChart" height="80"></canvas>
                </div>
            </div>
        </div>

        {{-- Recent Activities Timeline --}}
        <div class="col-xl-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="mb-0 fw-bold" style="color: #1a1a1a;">
                        <i class="fas fa-history me-2"></i>Aktivitas Terkini
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="activity-timeline">
                        @forelse($recentActivities as $activity)
                        <div class="activity-item">
                            <div class="activity-icon activity-icon-{{ $activity['color'] }}">
                                <i class="fas {{ $activity['icon'] }}"></i>
                            </div>
                            <div class="activity-content">
                                <h6 class="activity-title">{{ $activity['title'] }}</h6>
                                <p class="activity-desc">{{ \Illuminate\Support\Str::limit($activity['description'], 50) }}</p>
                                <div class="activity-meta">
                                    <span class="activity-user">
                                        <i class="fas fa-user fa-sm me-1"></i>{{ $activity['user'] }}
                                    </span>
                                    <span class="activity-time">
                                        <i class="far fa-clock fa-sm me-1"></i>{{ $activity['time']->diffForHumans() }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-5 text-muted">
                            <i class="fas fa-inbox fa-3x mb-3"></i>
                            <p>Belum ada aktivitas</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="row g-4 mt-2">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom py-3">
                    <h5 class="mb-0 fw-bold" style="color: #1a1a1a;">
                        <i class="fas fa-bolt me-2"></i>Quick Actions
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <a href="{{ route('admin.berita.create') }}" class="quick-action-btn">
                                <i class="fas fa-plus-circle"></i>
                                <span>Buat Berita Baru</span>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('admin.pengumuman.create') }}" class="quick-action-btn">
                                <i class="fas fa-bullhorn"></i>
                                <span>Tambah Pengumuman</span>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('admin.album.create') }}" class="quick-action-btn">
                                <i class="fas fa-camera"></i>
                                <span>Upload Foto</span>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('admin.layanan.index') }}" class="quick-action-btn">
                                <i class="fas fa-cogs"></i>
                                <span>Kelola Layanan</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
(function() {
    'use strict';
    
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('beritaChart');
        if (!ctx) return;
        
        const chartLabels = JSON.parse('{!! json_encode($chartLabels) !!}');
        const chartData = JSON.parse('{!! json_encode($chartData) !!}');
        
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: chartLabels,
                datasets: [{
                    label: 'Jumlah Berita',
                    data: chartData,
                    backgroundColor: 'rgba(26, 26, 26, 0.1)',
                    borderColor: '#1a1a1a',
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#1a1a1a',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#1a1a1a',
                        padding: 12,
                        titleFont: { size: 14, weight: 'bold' },
                        bodyFont: { size: 13 },
                        cornerRadius: 8,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            font: { size: 12 }
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    },
                    x: {
                        ticks: {
                            font: { size: 12 }
                        },
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    });
})();
</script>
@endpush

@push('styles')
<style>
/* Stat Cards */
.stat-card {
    position: relative;
    background: white;
    border-radius: 12px;
    padding: 24px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    overflow: hidden;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 24px rgba(0,0,0,0.12);
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: currentColor;
}

.stat-card-primary { color: #0d6efd; }
.stat-card-warning { color: #ffc107; }
.stat-card-success { color: #198754; }
.stat-card-info { color: #0dcaf0; }

.stat-icon {
    width: 60px;
    height: 60px;
    background: currentColor;
    color: white;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    margin-bottom: 16px;
    opacity: 0.9;
}

.stat-value {
    font-size: 32px;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 4px;
}

.stat-title {
    font-size: 14px;
    color: #666;
    margin-bottom: 8px;
    font-weight: 500;
}

.stat-change {
    color: #999;
    font-size: 12px;
}

.stat-link {
    display: inline-flex;
    align-items: center;
    margin-top: 12px;
    color: currentColor;
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
    transition: all 0.3s;
}

.stat-link:hover {
    gap: 8px;
}

/* Activity Timeline */
.activity-timeline {
    max-height: 500px;
    overflow-y: auto;
    padding: 16px;
}

.activity-item {
    display: flex;
    gap: 16px;
    padding: 16px;
    border-radius: 8px;
    transition: all 0.3s;
    position: relative;
}

.activity-item:not(:last-child) {
    margin-bottom: 12px;
}

.activity-item:hover {
    background: #f8f9fa;
}

.activity-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    color: white;
    font-size: 16px;
}

.activity-icon-primary { background: #0d6efd; }
.activity-icon-warning { background: #ffc107; }
.activity-icon-success { background: #198754; }

.activity-content {
    flex: 1;
}

.activity-title {
    font-size: 14px;
    font-weight: 600;
    color: #1a1a1a;
    margin-bottom: 4px;
}

.activity-desc {
    font-size: 13px;
    color: #666;
    margin-bottom: 8px;
    line-height: 1.4;
}

.activity-meta {
    display: flex;
    gap: 16px;
    font-size: 12px;
    color: #999;
}

/* Quick Actions */
.quick-action-btn {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 12px;
    padding: 24px;
    background: white;
    border: 2px solid #e9ecef;
    border-radius: 12px;
    text-decoration: none;
    color: #1a1a1a;
    transition: all 0.3s;
    text-align: center;
}

.quick-action-btn i {
    font-size: 32px;
    color: #1a1a1a;
}

.quick-action-btn span {
    font-weight: 600;
    font-size: 14px;
}

.quick-action-btn:hover {
    border-color: #1a1a1a;
    background: #1a1a1a;
    color: white;
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(26,26,26,0.15);
}

.quick-action-btn:hover i {
    color: white;
}

/* Card */
.card {
    border-radius: 12px;
}

/* Scrollbar */
.activity-timeline::-webkit-scrollbar {
    width: 6px;
}

.activity-timeline::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.activity-timeline::-webkit-scrollbar-thumb {
    background: #ccc;
    border-radius: 10px;
}

.activity-timeline::-webkit-scrollbar-thumb:hover {
    background: #999;
}
</style>
@endpush
