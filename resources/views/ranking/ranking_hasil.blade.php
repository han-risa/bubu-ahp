<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="{{ asset('vendors/simple-datatables/style.css') }}">

        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Hasil Ranking</h3>
                <p class="text-subtitle text-muted"></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Hasil Ranking</li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>

    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title">Hasil Ranking</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1" style="width: 900px; margin: 0 auto">
                    <thead>
                        <tr>
                            <th>Nama Desain</th>
                            <th>Skor</th>
                            <th>Ranking</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- <tr>
                            <td>Desain 1</td>
                            <td>100</td>
                            <td>1</td>
                        </tr>
                        <tr>
                            <td>Desain 2</td>
                            <td>90</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>Desain 3</td>
                            <td>80</td>
                            <td>3</td>
                        </tr> --}}
                        @foreach($rankedData as $item)
                            <tr>
                                <td>{{ $item['nama_desain'] }}</td>
                                <td>{{ $item['final_score'] }}</td>
                                <td>{{ $item['rank'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <script src="{{ asset('vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('vendors/sweetalert2/sweetalert2.min.css') }}"></script>
    <script src="{{ asset('vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var myTable = document.querySelector('#table1');
            var dataTable = new simpleDatatables.DataTable(myTable);
        });
    </script>
    <!-- SweetAlert2 Script -->
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Yakin Hapus Entry ini?',
                text: "Data tidak akan dapat dipulihkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal',
                confirmButtonText: 'Ya, hapus data tersebut!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }
    </script>
</x-app-layout>
