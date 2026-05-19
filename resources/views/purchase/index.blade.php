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
                                                <button type="button" class="border-0 bg-transparent p-0 me-2" onclick="confirmPurchaseAction('edit', '{{ $data->id }}')">
                                                    <img src="{{ asset('be/assets/img/icon/edit.png') }}" alt="edit" width="20" title="Edit">
                                                </button>
                                                <form id="delete-form-{{ $data->id }}" action="{{ route('purchase.destroy', $data->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="border-0 bg-transparent p-0" onclick="confirmPurchaseAction('delete', '{{ $data->id }}')">
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
        // ─── Flash messages ─────────────────────────────────────────────────────
        @if (session('simpan'))
            Swal.fire({ icon: 'success', title: 'Success!', text: '{{ session('simpan') }}', confirmButtonText: 'OK' });
        @endif
        @if (session('hapus'))
            Swal.fire({ icon: 'success', title: 'Deleted!', text: '{{ session('hapus') }}', confirmButtonText: 'OK' });
        @endif
        @if (session('error'))
            Swal.fire({ icon: 'error', title: 'Error!', text: '{{ session('error') }}', confirmButtonText: 'OK' });
        @endif

        // ─── Password-protected Edit & Delete ───────────────────────────────────
        async function confirmPurchaseAction(action, purchaseId) {
            // Step 1: Ask for password
            const { value: password, isConfirmed } = await Swal.fire({
                title: 'Password required!',
                text: 'Enter your account password to continue.',
                input: 'password',
                inputPlaceholder: 'Enter password',
                showCancelButton: true,
                confirmButtonColor: '#d1008c',
                cancelButtonColor: '#aaa',
                confirmButtonText: 'OK',
                cancelButtonText: 'Cancel',
                inputValidator: (value) => {
                    if (!value) return 'Password cannot be empty!';
                }
            });

            if (!isConfirmed || !password) return;

            // Step 2: Verify password on server
            try {
                const response = await fetch(`/purchase/${purchaseId}/confirm-password`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ password: password, action: action })
                });

                const result = await response.json();

                if (!response.ok || !result.success) {
                    // Step 3: Wrong password
                    Swal.fire({
                        icon: 'error',
                        title: 'Access denied',
                        text: result.message || 'Password is incorrect.'
                    });
                    return;
                }

                // Step 4: Password correct — show success then confirm action
                await Swal.fire({
                    icon: 'success',
                    title: 'Nice!',
                    text: 'Your password is correct.',
                    confirmButtonColor: '#d1008c',
                    confirmButtonText: 'OK',
                    timer: 1500,
                    timerProgressBar: true
                });

                if (action === 'edit') {
                    // Step 5a: Confirm edit
                    const editConfirm = await Swal.fire({
                        icon: 'question',
                        title: 'Edit this purchase?',
                        text: 'Do you want to edit this purchase?',
                        showCancelButton: true,
                        confirmButtonColor: '#d1008c',
                        cancelButtonColor: '#aaa',
                        confirmButtonText: 'Yes, edit it',
                        cancelButtonText: 'Cancel'
                    });

                    if (editConfirm.isConfirmed) {
                        window.location.href = result.redirect;
                    }
                } else if (action === 'delete') {
                    // Step 5b: Confirm delete
                    const deleteConfirm = await Swal.fire({
                        icon: 'warning',
                        title: 'Delete this purchase?',
                        text: 'This action will reverse the stock and cannot be undone.',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#aaa',
                        confirmButtonText: 'Yes, delete it',
                        cancelButtonText: 'Cancel'
                    });

                    if (deleteConfirm.isConfirmed) {
                        document.getElementById('delete-form-' + purchaseId).submit();
                    }
                }

            } catch (err) {
                Swal.fire({
                    icon: 'error',
                    title: 'Network Error',
                    text: 'Could not reach the server. Please try again.'
                });
            }
        }
    </script>
@endsection
