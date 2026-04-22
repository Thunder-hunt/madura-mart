@extends('be.master')

@section('menu')
    @include('be.menu')
@endsection

@section('purchase')
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">{{ $title }}</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">{{ $title }}</h6>
            </nav>
        </div>
    </nav>

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>{{ $title }} Transactions</h6>
                        <a href="{{ route('purchase.create') }}" class="btn btn-primary btn-sm mb-0"> Record New Purchase</a>
                    </div>
                    
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-primary text-xs font-weight-bolder opacity-7">No.</th>
                                        <th class="text-uppercase text-primary text-xs font-weight-bolder opacity-7">Action</th>
                                        <th class="text-uppercase text-primary text-xs font-weight-bolder opacity-7">No. Nota</th>
                                        <th class="text-uppercase text-primary text-xs font-weight-bolder opacity-7">Date</th>
                                        <th class="text-uppercase text-primary text-xs font-weight-bolder opacity-7">Distributor</th>
                                        <th class="text-uppercase text-primary text-xs font-weight-bolder opacity-7">Total Bayar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $nmr => $data)
                                        <tr>
                                            <td class="text-xs font-weight-bold mb-0 ps-4">{{ $nmr + 1 . '.' }}</td>
                                            <td class="text-xs font-weight-bold mb-0">
                                                <a href="{{ route('purchase.show', $data->id) }}" class="me-2">
                                                    <img src="{{ asset('be/assets/img/icon/eye.png') }}" alt="show" width="20" title="Detail">
                                                </a>
                                                <form action="{{ route('purchase.destroy', $data->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="border-0 bg-transparent p-0" onclick="hapus(event, this)">
                                                        <img src="{{ asset('be/assets/img/icon/trash.png') }}" alt="delete" width="20" title="Delete">
                                                    </button>
                                                </form>
                                            </td>
                                            
                                            <td class="text-xs font-weight-bold mb-0">{{ $data->no_nota }}</td>
                                            <td class="text-xs font-weight-bold mb-0">{{ $data->tgl_nota }}</td>
                                            <td class="text-xs font-weight-bold mb-0">{{ $data->distributor->name_distributor ?? 'N/A' }}</td>
                                            <td class="text-xs font-weight-bold mb-0">Rp {{ number_format($data->total_bayar, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if (session('simpan'))
            Swal.fire({ icon: 'success', title: 'Success!', text: '{{ session('simpan') }}' });
        @endif
        @if (session('hapus'))
            Swal.fire({ icon: 'success', title: 'Deleted!', text: '{{ session('hapus') }}' });
        @endif
        @if (session('error'))
            Swal.fire({ icon: 'error', title: 'Error!', text: '{{ session('error') }}' });
        @endif

        function hapus(e, el) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "Deleting this will revert product stock! This action cannot be undone.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
            }).then((result) => {
                if (result.isConfirmed) {
                    el.closest("form").submit();
                }
            });
        }
    </script>
@endsection
