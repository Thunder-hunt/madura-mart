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
                                <label class="form-label text-xs font-weight-bold">No. Nota</label>
                                <input type="text" name="no_nota" class="form-control" value="{{ old('no_nota', $data->no_nota) }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-xs font-weight-bold">Date</label>
                                <input type="date" name="tgl_nota" class="form-control" value="{{ old('tgl_nota', $data->tgl_nota) }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-xs font-weight-bold">Distributor</label>
                                <select name="id_distributor" class="form-control" required>
                                    <option value="">Select Distributor</option>
                                    @foreach($distributors as $d)
                                        <option value="{{ $d->id }}" {{ old('id_distributor', $data->id_distributor) == $d->id ? 'selected' : '' }}>{{ $d->name_distributor }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Items -->
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h6>Edit Purchases Data</h6>
                            <button type="button" class="btn btn-dark btn-sm" id="addItem">Add Row</button>
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
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="itemBody">
                                        @foreach($data->details as $index => $detail)
                                        <tr>
                                            <td class="p-2">
                                                <select name="items[{{ $index }}][id_barang]" class="form-control form-control-sm product-select" required>
                                                    <option value="" data-price="0">Select Product</option>
                                                    @foreach($products as $p)
                                                        <option value="{{ $p->id }}" data-price="{{ $p->harga_jual }}" {{ $detail->id_barang == $p->id ? 'selected' : '' }}>{{ $p->nama_barang }}</option>
                                                    @endforeach
                                                </select>
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
                                            <td class="p-2 text-center">
                                                @if($index > 0)
                                                <button type="button" class="btn btn-link text-danger mb-0 p-0 remove-row"><i class="fa fa-trash"></i></button>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3" class="text-end text-sm font-weight-bold p-3">Total Payment</td>
                                            <td colspan="2" class="text-sm font-weight-bolder p-3">
                                                <span id="grandTotal">Rp {{ number_format($data->total_bayar, 0, ',', '.') }}</span>
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
        let rowIdx = {{ count($data->details) }};

        document.getElementById('addItem').addEventListener('click', function() {
            let tbody = document.getElementById('itemBody');
            let tr = document.createElement('tr');
            tr.innerHTML = `
                <td class="p-2">
                    <select name="items[${rowIdx}][id_barang]" class="form-control form-control-sm product-select" required>
                        <option value="" data-price="0">Select Product</option>
                        @foreach($products as $p)
                            <option value="{{ $p->id }}" data-price="{{ $p->harga_jual }}">{{ $p->nama_barang }}</option>
                        @endforeach
                    </select>
                </td>
                <td class="p-2">
                    <input type="number" name="items[${rowIdx}][harga_beli]" class="form-control form-control-sm price" required placeholder="0">
                </td>
                <td class="p-2">
                    <input type="number" name="items[${rowIdx}][jumlah_beli]" class="form-control form-control-sm qty" required placeholder="0">
                </td>
                <td class="p-2">
                    <span class="text-xs font-weight-bold subtotal">Rp 0</span>
                </td>
                <td class="p-2 text-center">
                    <button type="button" class="btn btn-link text-danger mb-0 p-0 remove-row"><i class="fa fa-trash"></i></button>
                </td>
            `;
            tbody.appendChild(tr);
            rowIdx++;
            attachListeners(tr);
        });

        function attachListeners(row) {
            let select = row.querySelector('.product-select');
            let priceInput = row.querySelector('.price');
            let qtyInput = row.querySelector('.qty');
            let subtotalSpan = row.querySelector('.subtotal');

            if (select) {
                select.addEventListener('change', function() {
                    let price = this.options[this.selectedIndex].getAttribute('data-price') || 0;
                    priceInput.value = price;
                    calculate();
                });
            }

            const calculate = () => {
                let price = parseFloat(priceInput.value) || 0;
                let qty = parseFloat(qtyInput.value) || 0;
                let subtotal = price * qty;
                subtotalSpan.innerText = 'Rp ' + subtotal.toLocaleString('id-ID');
                calculateGrandTotal();
            };

            priceInput.addEventListener('input', calculate);
            qtyInput.addEventListener('input', calculate);

            let removeBtn = row.querySelector('.remove-row');
            if (removeBtn) {
                removeBtn.addEventListener('click', function() {
                    row.remove();
                    calculateGrandTotal();
                });
            }
        }

        function calculateGrandTotal() {
            let subtotals = document.querySelectorAll('.subtotal');
            let grand = 0;
            subtotals.forEach(span => {
                let text = span.innerText.replace('Rp ', '').replace(/\./g, '').replace(/,/g, '');
                grand += parseFloat(text) || 0;
            });
            document.getElementById('grandTotal').innerText = 'Rp ' + grand.toLocaleString('id-ID');
        }

        // Attach to all existing rows
        document.querySelectorAll('#itemBody tr').forEach(row => attachListeners(row));
    </script>
@endsection
