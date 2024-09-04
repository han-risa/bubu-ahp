<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Dashboard</h3>
                <p class="text-subtitle text-muted"></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>


    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="row d-flex justify-content-center align-items-center">
                    <!-- Button 1 -->
                    <div class="col-md-4 col-12 d-flex justify-content-center">
                        <a href="{{ route('desain.index') }}" class="text-white" style="font-size: 20px; text-decoration: none; width: 100%;">
                            <button class="btn btn-primary" style="width: 100%;">
                                <i class="bi bi-list-ul" style="font-size: 100px"></i><br>Daftar Desain
                            </button>
                        </a>
                    </div>
                    <!-- Button 2 -->
                    <div class="col-md-4 col-12 d-flex justify-content-center">
                        <a href="{{ route('ranking.index') }}" class="text-white" style="font-size: 20px; text-decoration: none; width: 100%;">
                            <button class="btn btn-primary" style="width: 100%;">
                                <i class="bi bi-clipboard-plus-fill" style="font-size: 100px"></i><br>Perangkingan Baru
                            </button>
                        </a>
                    </div>
                    <!-- Button 3 -->
                    <div class="col-md-4 col-12 d-flex justify-content-center">
                        <a href="{{ route('ranking.riwayat') }}" class="text-white" style="font-size: 20px; text-decoration: none; width: 100%">
                            <button class="btn btn-primary" style="width: 100%;">
                                <i class="bi bi-bar-chart-line-fill" style="font-size: 100px"></i><br>Riwayat
                                Perankingan
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
