<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="{{ asset('vendors/simple-datatables/style.css') }}">

        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Dataset</h3>
                <p class="text-subtitle text-muted"></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Dataset</li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Data Penjualan</h5>

            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Desain</th>
                            <th>Kuantitas</th>
                            <th>Pembeli</th>
                            <th>Omset</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $item)
                        <tr>
                            <td>{{ $item->desain }}</td>
                            <td>{{ $item->jumlah_terjual }}</td>
                            <td>{{ $item->jumlah_pembeli }}</td>
                            <td>{{ 'Rp ' . number_format($item->omset, 2) }}</td>
                            <td></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <script src="{{ asset('vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var myTable = document.querySelector('#table1');
            var dataTable = new simpleDatatables.DataTable(myTable);
        });
    </script>
</x-app-layout>
