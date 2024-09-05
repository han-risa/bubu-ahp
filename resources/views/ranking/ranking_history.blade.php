<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="{{ asset('vendors/simple-datatables/style.css') }}">

        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Riwayat Ranking</h3>
                <p class="text-subtitle text-muted"></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Riwayat Ranking</li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>

    <section class="section">
        <div class="container">
            <div class="row">
                @foreach($groupedData as $bulan_id => $dataGroup)
                    <div class="col-md-6 mb-4">
                        <!-- Card for each unique bulan_tahun -->
                        <div class="card c">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title">Ranking ({{ $dataGroup->first()->bulan->bulan_tahun }})</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped" id="table{{ $bulan_id }}">
                                    <thead>
                                        <tr>
                                            <th>Nama Desain</th>
                                            <th>Skor</th>
                                            <th>Peringkat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($dataGroup as $item)
                                            <tr>
                                                <td>{{ $item->desain->nama_desain }}</td>
                                                <td>{{ $item->skor_ranking }}</td>
                                                <td>{{ $item->posisi_ranking }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <script src="{{ asset('vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('vendors/sweetalert2/sweetalert2.min.css') }}"></script>
    <script src="{{ asset('vendors/simple-datatables/simple-datatables.js') }}"></script>
    @foreach($groupedData as $bulan_id => $dataGroup)
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var myTable = document.querySelector('#table{{ $bulan_id }}');
                var dataTable = new simpleDatatables.DataTable(myTable, {
                    perPageSelect: false, // Optional: If you want to disable the per-page select dropdown
                    searchable: false   // Disable search functionality
                });
            });
        </script>
    @endforeach
</x-app-layout>
