<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Perankingan</h3>
                <p class="text-subtitle text-muted"></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Perankingan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>


    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-md-5 col-12 d-flex justify-content-center">
                        <button class="btn btn-primary col-md-5">
                            <a href="#" class="text-white" style="font-size: 20px">
                                <i class="bi bi-clipboard-plus-fill" style="font-size: 100px"></i><br>Perangkingan Baru
                            </a>
                        </button>
                    </div>
                    <div class="col-md-5 col-12 d-flex justify-content-center">
                        <button class="btn btn-primary col-md-5">
                            <a href="/dataset" class="text-white" style="font-size: 20px">
                                <i class="bi bi-clipboard-data-fill" style="font-size: 100px"></i><br>Riwayat Perankingan
                            </a>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </section>
</x-app-layout>
