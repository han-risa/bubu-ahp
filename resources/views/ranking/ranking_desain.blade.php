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
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title">Daftar Desain</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('ranking.bulkAction') }}" method="POST">
                    @csrf
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>Select</th>
                                <th>Nama Desain</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($desain as $index => $item)
                                @if($index % 3 == 0)
                                    <tr>
                                @endif

                                <td style="text-align: center;">
                                    <input type="checkbox" name="desain_ids[]" value="{{ $item->id }}" class="form-check-input">
                                </td>
                                <td style="text-align: left;">{{ $item->nama_desain }}</td>

                                @if(($index + 1) % 3 == 0)
                                    </tr>
                                @endif
                            @endforeach

                            {{-- Close the last row and distribute empty columns evenly --}}
                            @if(count($desain) % 3 != 0)
                                @for($i = 0; $i < 3 - (count($desain) % 3); $i++)
                                    <td></td>
                                    <td></td>
                                @endfor
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </section>
</x-app-layout>
