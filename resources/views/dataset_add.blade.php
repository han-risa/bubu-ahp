<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="{{ asset('vendors/choices.js/choices.min.css') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Dataset</h3>
                <p class="text-subtitle text-muted"></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href={{ route('dataset') }}>Dataset</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
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
                            <form class="form" action={{ route('dataset.store') }}>
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="nama-desain">Nama Desain</label>
                                            <select class="choices form-select" id="desain">
                                                <option value="" selected>Pilih Desain</option>
                                                @foreach ($data as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="terjual">Jumlah Terjual</label>
                                            <input type="text" id="terjual" class="form-control"
                                                placeholder="Masukkan jumlah terjual" name="lname-column">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="pembeli">Jumlah Pembeli</label>
                                            <input type="text" id="pembeli" class="form-control" placeholder="Masukkan jumlah pembeli"
                                                name="city-column">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="bulan">Bulan Penjualan</label>
                                            <input type="date" class="form-control" placeholder="Select date.." id="bulan">
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                    </div>
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
