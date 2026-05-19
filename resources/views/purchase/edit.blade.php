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
                <h6 class="font-weight-bolder mb-0">Edit {{ $title }} Data</h6>
            </nav>
        </div>
    </nav>

    <div class="container-fluid py-4">
        <form action="{{ route('purchase.update', $data->id) }}" method="POST" id="purchaseForm">
            @csrf
            @method('PUT')
            @if(session('error'))
                <div class="alert alert-danger text-white">{{ session('error') }}</div>
            @endif
            <div class="row">
                <!-- Header Info -->
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Purchase Info</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label text-xs font-weight-bold">Invoice No</label>
                                <input type="text" name="no_nota" class="form-control" value="{{ old('no_nota', $data->no_nota) }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-xs font-weight-bold">Invoice Date</label>
                                <input type="date" name="tgl_nota" class="form-control" value="{{ old('tgl_nota', $data->tgl_nota) }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-xs font-weight-bold">Distributor</label>
                                <input type="hidden" name="id_distributor" value="{{ $data->id_distributor }}">
                                <input type="text" class="form-control" value="{{ $data->distributor->name_distributor ?? 'N/A' }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Items -->
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Edit Purchases Data</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0" id="itemTable">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Product</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Purchase Price</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Quantity</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody id="itemBody">
                                        @foreach($data->details as $index => $detail)
                                        <tr>
                                            <td class="p-2">
                                                <input type="hidden" name="items[{{ $index }}][id_barang]" value="{{ $detail->id_barang }}">
                                                <input type="text" class="form-control form-control-sm" value="{{ $detail->product->nama_barang ?? 'N/A' }}" readonly>
                                            </td>
                                            <td class="p-2">
                                                <input type="number" name="items[{{ $index }}][harga_beli]" class="form-control form-control-sm price" required value="{{ $detail->harga_beli }}">
                                            </td>
                                            <td class="p-2">
                                                <input type="number" name="items[{{ $index }}][jumlah_beli]" class="form-control form-control-sm qty" required value="{{ $detail->jumlah_beli }}">
                                            </td>
                                            <td class="p-2">
                                                <span class="text-xs font-weight-bold subtotal">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3" class="text-end text-sm font-weight-bold p-3">Total Payment</td>
                                            <td colspan="1" class="text-sm font-weight-bolder p-3">
                                                <input type="text" id="grandTotalInput" class="form-control form-control-sm border-0 bg-light fw-bold fs-6" readonly value="Rp {{ number_format($data->total_bayar, 0, ',', '.') }}">
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <a href="{{ route('purchase.index') }}" class="btn bg-gradient-secondary btn-sm me-2">CANCEL</a>
                            <button type="submit" class="btn btn-sm text-white" style="background-color: #d1008c;">EDIT THIS PURCHASE</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        function attachListeners() {
            const rows = document.querySelectorAll('#itemBody tr');
            rows.forEach(row => {
                let priceInput = row.querySelector('.price');
                let qtyInput = row.querySelector('.qty');
                let subtotalSpan = row.querySelector('.subtotal');

                const calculate = () => {
                    let price = parseFloat(priceInput.value) || 0;
                    let qty = parseFloat(qtyInput.value) || 0;
                    let subtotal = price * qty;
                    subtotalSpan.innerText = 'Rp ' + subtotal.toLocaleString('id-ID');
                    calculateGrandTotal();
                };

                priceInput.addEventListener('input', calculate);
                qtyInput.addEventListener('input', calculate);
            });
        }

        function calculateGrandTotal() {
            let subtotals = document.querySelectorAll('.subtotal');
            let grand = 0;
            subtotals.forEach(span => {
                let text = span.innerText.replace('Rp ', '').replace(/\./g, '').replace(/,/g, '');
                grand += parseFloat(text) || 0;
            });
            document.getElementById('grandTotalInput').value = 'Rp ' + grand.toLocaleString('id-ID');
        }

        document.addEventListener('DOMContentLoaded', attachListeners);
    </script>
@endsection
