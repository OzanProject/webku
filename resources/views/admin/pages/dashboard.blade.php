@extends('admin.layouts.app')

@section('content')
<div class="p-md md:p-lg lg:p-xl mt-16 max-w-container-max mx-auto w-full">
    <div class="mb-lg">
        <h2 class="text-headline-md font-headline-md font-bold text-on-surface">Dashboard Overview</h2>
        <p class="text-body-md font-body-md text-on-surface-variant">Welcome back to {{ $siteName ?? config('app.name') }} Admin.</p>
    </div>
    
    <!-- KPI Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-md mb-lg">
        <!-- Revenue -->
        <div class="bg-surface-container-lowest rounded-xl p-md border border-outline-variant shadow-sm hover:shadow-[0px_10px_30px_rgba(15,23,42,0.1)] hover:-translate-y-1 transition-all duration-300">
            <div class="flex justify-between items-start mb-sm">
                <div class="p-sm bg-primary-container/10 rounded-lg text-primary-container">
                    <span class="material-symbols-outlined">payments</span>
                </div>
                <span class="text-label-sm font-label-sm text-[#16a34a] bg-[#16a34a]/10 px-xs py-base rounded-md flex items-center gap-1">
                    <span class="material-symbols-outlined text-[14px]">trending_up</span> +12%
                </span>
            </div>
            <h3 class="text-label-sm font-label-sm text-on-surface-variant mb-xs">Total Layanan</h3>
            <p class="text-headline-md font-headline-md font-bold text-on-surface">{{ $stats['total_services'] }}</p>
        </div>
        
        <!-- Orders -->
        <div class="bg-surface-container-lowest rounded-xl p-md border border-outline-variant shadow-sm hover:shadow-[0px_10px_30px_rgba(15,23,42,0.1)] hover:-translate-y-1 transition-all duration-300">
            <div class="flex justify-between items-start mb-sm">
                <div class="p-sm bg-tertiary/10 rounded-lg text-tertiary">
                    <span class="material-symbols-outlined">shopping_bag</span>
                </div>
                <span class="text-label-sm font-label-sm text-[#16a34a] bg-[#16a34a]/10 px-xs py-base rounded-md flex items-center gap-1">
                    <span class="material-symbols-outlined text-[14px]">trending_up</span> +5%
                </span>
            </div>
            <h3 class="text-label-sm font-label-sm text-on-surface-variant mb-xs">Total Produk</h3>
            <p class="text-headline-md font-headline-md font-bold text-on-surface">{{ $stats['total_products'] }}</p>
        </div>
        
        <!-- Customers -->
        <div class="bg-surface-container-lowest rounded-xl p-md border border-outline-variant shadow-sm hover:shadow-[0px_10px_30px_rgba(15,23,42,0.1)] hover:-translate-y-1 transition-all duration-300">
            <div class="flex justify-between items-start mb-sm">
                <div class="p-sm bg-secondary/10 rounded-lg text-secondary">
                    <span class="material-symbols-outlined">group_add</span>
                </div>
                <span class="text-label-sm font-label-sm text-[#16a34a] bg-[#16a34a]/10 px-xs py-base rounded-md flex items-center gap-1">
                    <span class="material-symbols-outlined text-[14px]">trending_up</span> +8%
                </span>
            </div>
            <h3 class="text-label-sm font-label-sm text-on-surface-variant mb-xs">Total Pesan Masuk</h3>
            <p class="text-headline-md font-headline-md font-bold text-on-surface">{{ $stats['total_messages'] }}</p>
        </div>
        
        <!-- Satisfaction -->
        <div class="bg-surface-container-lowest rounded-xl p-md border border-outline-variant shadow-sm hover:shadow-[0px_10px_30px_rgba(15,23,42,0.1)] hover:-translate-y-1 transition-all duration-300">
            <div class="flex justify-between items-start mb-sm">
                <div class="p-sm bg-primary/10 rounded-lg text-primary">
                    <span class="material-symbols-outlined">sentiment_very_satisfied</span>
                </div>
                <span class="text-label-sm font-label-sm text-on-surface-variant bg-surface-container px-xs py-base rounded-md">
                    Steady
                </span>
            </div>
            <h3 class="text-label-sm font-label-sm text-on-surface-variant mb-xs">Total Testimoni</h3>
            <p class="text-headline-md font-headline-md font-bold text-on-surface">{{ $stats['total_testimonials'] }}</p>
        </div>
    </div>
    
    <!-- Complex Layout Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-lg mb-lg">
        <!-- Performance Chart -->
        <div class="lg:col-span-2 bg-surface-container-lowest rounded-xl border border-outline-variant shadow-sm p-md flex flex-col min-h-[400px]">
            <div class="flex justify-between items-center mb-md">
                <div>
                    <h3 class="text-body-lg font-body-lg font-bold text-on-surface">Statistik Interaksi</h3>
                    <p class="text-label-sm font-label-sm text-on-surface-variant">Total Pesanan & Pesan 6 Bulan Terakhir</p>
                </div>
                <button type="button" class="text-on-surface-variant hover:text-primary p-xs rounded-md hover:bg-surface-container-high transition-colors">
                    <span class="material-symbols-outlined">more_vert</span>
                </button>
            </div>
            
            <!-- Chart Placeholder using stylized CSS elements to look like a chart -->
            <div class="flex-1 relative w-full h-full border-b border-l border-outline-variant/50 pt-md pb-xs pl-xs flex items-end justify-between px-4 mt-auto mb-8 ml-8 md:ml-10">
                <!-- Y-Axis labels -->
                <div class="absolute right-full pr-3 top-0 h-full flex flex-col justify-between items-end text-[10px] text-on-surface-variant translate-y-1.5 w-12">
                    @foreach($yAxisLabels as $label)
                        <span>{{ $label }}</span>
                    @endforeach
                </div>
                
                <!-- Grid lines -->
                <div class="absolute inset-0 flex flex-col justify-between pointer-events-none opacity-20 ml-2">
                    <div class="w-full border-t border-outline border-dashed h-0"></div>
                    <div class="w-full border-t border-outline border-dashed h-0"></div>
                    <div class="w-full border-t border-outline border-dashed h-0"></div>
                    <div class="w-full border-t border-outline border-dashed h-0"></div>
                    <div class="w-full border-t border-outline border-dashed h-0"></div>
                </div>
                
                <!-- Dynamic Bars -->
                @foreach($interactionStats as $stat)
                <div class="w-1/12 {{ $stat['color'] ?? 'bg-primary/50' }} rounded-t-sm relative group cursor-pointer hover:bg-primary transition-colors" style="height: {{ $stat['height_percent'] }}%;">
                    <div class="absolute -top-7 left-1/2 -translate-x-1/2 bg-inverse-surface text-inverse-on-surface text-[10px] px-1.5 py-0.5 rounded opacity-0 group-hover:opacity-100 transition-opacity z-10">{{ $stat['display'] }}</div>
                </div>
                @endforeach
                
                <!-- X-Axis labels -->
                <div class="absolute top-full mt-2 left-0 w-full flex justify-between text-[10px] text-on-surface-variant px-4">
                    @foreach($interactionStats as $stat)
                        <span>{{ $stat['month_name'] }}</span>
                    @endforeach
                </div>
            </div>
        </div>
        
        <!-- Quick Actions & Side Info -->
        <div class="lg:col-span-1 flex flex-col gap-md">
            <!-- Quick Actions -->
            <div class="bg-surface-container-lowest rounded-xl border border-outline-variant shadow-sm p-md">
                <h3 class="text-body-lg font-body-lg font-bold text-on-surface mb-md">Quick Actions</h3>
                <div class="flex flex-col gap-sm">
                    <a href="{{ route('admin.products.create') }}" class="flex items-center gap-md p-sm rounded-lg hover:bg-surface-container-high transition-colors w-full text-left group">
                        <div class="p-xs bg-primary-container/10 text-primary-container rounded-md group-hover:bg-primary-container group-hover:text-on-primary-container transition-colors">
                            <span class="material-symbols-outlined text-[20px]">add_circle</span>
                        </div>
                        <span class="text-label-md font-label-md flex-1">Tambah Produk Baru</span>
                        <span class="material-symbols-outlined text-on-surface-variant text-[16px] group-hover:translate-x-1 transition-transform">chevron_right</span>
                    </a>
                    <a href="{{ route('admin.services.create') }}" class="flex items-center gap-md p-sm rounded-lg hover:bg-surface-container-high transition-colors w-full text-left group">
                        <div class="p-xs bg-tertiary/10 text-tertiary rounded-md group-hover:bg-tertiary group-hover:text-on-tertiary transition-colors">
                            <span class="material-symbols-outlined text-[20px]">design_services</span>
                        </div>
                        <span class="text-label-md font-label-md flex-1">Tambah Layanan Baru</span>
                        <span class="material-symbols-outlined text-on-surface-variant text-[16px] group-hover:translate-x-1 transition-transform">chevron_right</span>
                    </a>
                    <a href="{{ route('admin.testimonials.index') }}" class="flex items-center gap-md p-sm rounded-lg hover:bg-surface-container-high transition-colors w-full text-left group">
                        <div class="p-xs bg-secondary/10 text-secondary rounded-md group-hover:bg-secondary group-hover:text-on-secondary transition-colors">
                            <span class="material-symbols-outlined text-[20px]">rate_review</span>
                        </div>
                        <span class="text-label-md font-label-md flex-1">Kelola Testimoni</span>
                        <span class="material-symbols-outlined text-on-surface-variant text-[16px] group-hover:translate-x-1 transition-transform">chevron_right</span>
                    </a>
                </div>
            </div>
            
            <!-- System Status mini-card -->
            <div class="bg-[#0f172a] text-white rounded-xl p-md relative overflow-hidden flex-1 flex flex-col justify-center">
                <div class="absolute inset-0 opacity-10 bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-primary-container to-transparent"></div>
                <div class="relative z-10">
                    <div class="flex items-center gap-sm mb-xs">
                        <div class="w-2 h-2 rounded-full {{ $systemStatus['indicator'] }} animate-pulse"></div>
                        <span class="text-label-sm font-label-sm text-gray-300">System Status</span>
                    </div>
                    <h4 class="text-body-lg font-body-lg font-bold">{{ $systemStatus['message'] }}</h4>
                    <p class="text-label-sm text-gray-400 mt-xs">Environment: {{ $systemStatus['environment'] }}</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Recent Messages Table -->
    <div class="bg-surface-container-lowest rounded-xl border border-outline-variant shadow-sm overflow-hidden mb-xl">
        <div class="p-md border-b border-outline-variant flex justify-between items-center bg-surface-bright">
            <h3 class="text-body-lg font-body-lg font-bold text-on-surface">Pesan Masuk Terbaru</h3>
            <a class="text-primary font-label-md text-label-md hover:underline flex items-center gap-xs" href="{{ route('admin.messages.index') }}">
                Lihat Semua <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-surface-container-lowest text-on-surface-variant text-label-sm font-label-sm uppercase tracking-wider">
                        <th class="p-md font-medium border-b border-outline-variant">Pengirim</th>
                        <th class="p-md font-medium border-b border-outline-variant">Email</th>
                        <th class="p-md font-medium border-b border-outline-variant">Subjek</th>
                        <th class="p-md font-medium border-b border-outline-variant">Status</th>
                        <th class="p-md font-medium border-b border-outline-variant text-right">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="text-body-md font-body-md divide-y divide-outline-variant">
                    @forelse($recentMessages as $msg)
                    <tr class="hover:bg-surface-container-low transition-colors group">
                        <td class="p-md">
                            <div class="flex items-center gap-sm">
                                <div class="w-8 h-8 rounded-full bg-primary-container text-on-primary-container flex items-center justify-center font-bold text-sm">{{ substr($msg->name, 0, 2) }}</div>
                                <span>{{ $msg->name }}</span>
                            </div>
                        </td>
                        <td class="p-md text-on-surface-variant">{{ $msg->email }}</td>
                        <td class="p-md text-on-surface-variant line-clamp-1 max-w-[200px]">{{ $msg->subject ?? 'Tanpa Subjek' }}</td>
                        <td class="p-md">
                            @if($msg->is_read)
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-[12px] font-medium bg-[#f3f4f6] text-[#374151] border border-[#d1d5db]">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#6b7280] mr-1.5"></span> Dibaca
                            </span>
                            @else
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-[12px] font-medium bg-[#fffbeb] text-[#92400e] border border-[#fde68a]">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#f59e0b] mr-1.5"></span> Baru
                            </span>
                            @endif
                        </td>
                        <td class="p-md text-right font-medium text-on-surface-variant text-sm">{{ $msg->created_at->diffForHumans() }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-md text-center text-on-surface-variant">Belum ada pesan masuk.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
