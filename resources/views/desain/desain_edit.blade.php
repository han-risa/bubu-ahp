<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="{{ asset('vendors/choices.js/choices.min.css') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Desain</h3>
                <p class="text-subtitle text-muted"></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href={{ route('desain.index') }}>Desain</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
                        <h4 class="card-title">Form Edit</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" action="{{ route('desain.update', $data->id)}}" method="POST">
                                @csrf
                                @method('PUT') <!-- Add this line to spoof the PUT request -->
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="nama_desain">Nama Desain</label>
                                            <input type="text" id="nama_desain" class="form-control" value="{{ $data->nama_desain }}" name="nama_desain">
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
    <script>
        // Convert the PHP variable to a JavaScript object
        let desainData = @json($data);

        // Log the data to the browser console
        console.log(desainData);
    </script>
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
