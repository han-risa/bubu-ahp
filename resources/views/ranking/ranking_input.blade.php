<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="{{ asset('vendors/choices.js/choices.min.css') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Perangkingan</h3>
                <p class="text-subtitle text-muted"></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href={{ route('ranking.index') }}>Perankingan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Input</li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>


    <!-- // Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Form Input</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" action="{{ route('ranking.process') }}" method="POST">
                                @csrf
                                @foreach($desain as $key => $item)
                                    <div class="row">
                                        <input type="hidden" name="desain[{{ $key }}][id]" value="{{ $item->id }}">

                                        <!-- Nama Desain -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="nama_desain_{{ $key }}">Nama Desain</label>
                                                <input type="text" id="nama_desain_{{ $key }}" class="form-control" value="{{ $item->nama_desain }}" name="desain[{{ $key }}][nama_desain]" readonly>
                                            </div>
                                        </div>

                                        <!-- Jumlah Terjual -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="jumlah_terjual_{{ $key }}">Jumlah Terjual</label>
                                                <input type="text" id="jumlah_terjual_{{ $key }}" class="form-control" placeholder="Masukkan jumlah terjual" name="desain[{{ $key }}][jumlah_terjual]">
                                            </div>
                                        </div>

                                        <!-- Jumlah Pembeli -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="jumlah_pembeli_{{ $key }}">Jumlah Pembeli</label>
                                                <input type="text" id="jumlah_pembeli_{{ $key }}" class="form-control" placeholder="Masukkan jumlah pembeli" name="desain[{{ $key }}][jumlah_pembeli]">
                                            </div>
                                        </div>

                                        <!-- Omset -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="omset_{{ $key }}">Omset</label>
                                                <input type="text" id="omset_{{ $key }}" class="form-control" placeholder="Masukkan omset" name="desain[{{ $key }}][omset]">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-end">
                                        <div class="form-group">
                                            <label for="bulan-penjualan">Bulan Penjualan</label>
                                            <small class="text-muted">Format : bb/tttt</small>
                                            <input type="text" id="bulan-penjualan" class="form-control" placeholder="Pilih bulan penjualan" name="bulan_penjualan">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('vendors/choices.js/choices.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var choices = new Choices('#nama-choice');
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            flatpickr('#bulan-penjualan', {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
            });
        });
    </script>
</x-app-layout>
