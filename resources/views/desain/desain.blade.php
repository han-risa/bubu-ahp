<x-app-layout>
    <x-slot name="header">
        <link rel="stylesheet" href="{{ asset('vendors/simple-datatables/style.css') }}">

        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Desain</h3>
                <p class="text-subtitle text-muted"></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Desain</li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>

    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title">Daftar Desain</h5>
                <a href="{{ route('desain.create') }}" class="btn btn-primary float-right">Tambah Desain</a>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Nama Desain</th>
                            <th style="width: 200px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $item)
                        <tr>
                            <td>{{ $item->nama_desain }}</td>
                            <td style="width: 200px; white-space: nowrap;">
                                <!-- Edit Button -->
                                <a href="{{ route('desain.edit', $item->id) }}" class="btn btn-primary btn-sm">
                                    Edit
                                </a>

                                <!-- Delete Button -->
                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $item->id }})">
                                    Delete
                                </button>

                                <!-- Delete Form (hidden) -->
                                <form id="delete-form-{{ $item->id }}" action="{{ route('desain.destroy', $item->id) }}" method="POST" style="display:none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
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
