@extends('be.master')

@section('menu')
    @include('be.menu')
@endsection

@section('order')
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">New Order</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Record New Order</h6>
            </nav>
        </div>
    </nav>

    <div class="container-fluid py-4">
        <form action="{{ route('order.store') }}" method="POST">
            @csrf
            @if(session('error'))
                <div class="alert alert-danger text-white">{{ session('error') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger text-white">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Order Details</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label text-xs font-weight-bold">Customer (User)</label>
                                <select name="id_user" class="form-control" required>
                                    <option value="">Select User</option>
                                    @foreach($users as $u)
                                        <option value="{{ $u->id }}">{{ $u->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-xs font-weight-bold">Order Date</label>
                                <input type="datetime-local" name="tgl_pemesanan" class="form-control" required value="{{ date('Y-m-d\TH:i') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-xs font-weight-bold">Order Status</label>
                                <input type="text" name="status_pemesanan" class="form-control" required value="Manual Entry">
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-xs font-weight-bold">Transaction Status</label>
                                <select name="status" class="form-control" required>
                                    <option value="dipesan">Dipesan</option>
                                    <option value="diproses">Diproses</option>
                                    <option value="dikirim">Dikirim</option>
                                    <option value="selesai">Selesai</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-xs font-weight-bold">Payment Method</label>
                                <select name="metode_pembayaran" class="form-control" required>
                                    <option value="cod">COD</option>
                                    <option value="tf">Transfer</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-xs font-weight-bold">Notes</label>
                                <textarea name="keterangan" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h6>Order Items</h6>
                            <button type="button" class="btn btn-dark btn-sm" id="addItem">Add Row</button>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Product</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Price</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Qty</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Subtotal</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="itemBody">
                                        <tr>
                                            <td class="p-2 d-flex align-items-center">
                                                <img src="" class="product-preview me-2 d-none" style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px;">
                                                <select name="items[0][id_barang]" class="form-control form-control-sm product-select w-100" required>
                                                    <option value="" data-price="0" data-image="">Select Product</option>
                                                    @foreach($products as $p)
                                                        <option value="{{ $p->id }}" data-price="{{ $p->harga_jual }}" data-image="{{ $p->foto_barang ? asset('storage/' . $p->foto_barang) : '' }}">{{ $p->nama_barang }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="p-2">
                                                <input type="number" name="items[0][harga_jual]" class="form-control form-control-sm price" required>
                                            </td>
                                            <td class="p-2">
                                                <input type="number" name="items[0][jumlah_jual]" class="form-control form-control-sm qty" required min="1">
                                            </td>
                                            <td class="p-2"><span class="subtotal text-xs font-weight-bold">Rp 0</span></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3" class="text-end text-sm font-weight-bold p-3">Grand Total</td>
                                            <td colspan="2" class="text-sm font-weight-bolder p-3"><span id="grandTotal">Rp 0</span></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <a href="{{ route('order.index') }}" class="btn bg-gradient-secondary btn-sm me-2">Cancel</a>
                            <button type="submit" class="btn bg-gradient-primary btn-sm">Save Order</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        let rowIdx = 1;
        document.getElementById('addItem').addEventListener('click', function() {
            let tbody = document.getElementById('itemBody');
            let tr = document.createElement('tr');
            tr.innerHTML = `
                <td class="p-2 d-flex align-items-center">
                    <img src="" class="product-preview me-2 d-none" style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px;">
                    <select name="items[${rowIdx}][id_barang]" class="form-control form-control-sm product-select w-100" required>
                        <option value="" data-price="0" data-image="">Select Product</option>
                        @foreach($products as $p)
                            <option value="{{ $p->id }}" data-price="{{ $p->harga_jual }}" data-image="{{ $p->foto_barang ? asset('storage/' . $p->foto_barang) : '' }}">{{ $p->nama_barang }}</option>
                        @endforeach
                    </select>
                </td>
                <td class="p-2">
                    <input type="number" name="items[${rowIdx}][harga_jual]" class="form-control form-control-sm price" required>
                </td>
                <td class="p-2">
                    <input type="number" name="items[${rowIdx}][jumlah_jual]" class="form-control form-control-sm qty" required min="1">
                </td>
                <td class="p-2"><span class="subtotal text-xs font-weight-bold">Rp 0</span></td>
                <td class="text-center">
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
            let imgPreview = row.querySelector('.product-preview');

            select.addEventListener('change', function() {
                let price = this.options[this.selectedIndex].getAttribute('data-price') || 0;
                let image = this.options[this.selectedIndex].getAttribute('data-image');
                priceInput.value = price;
                
                if (image) {
                    imgPreview.src = image;
                    imgPreview.classList.remove('d-none');
                } else {
                    imgPreview.src = '';
                    imgPreview.classList.add('d-none');
                }
                
                calculate();
            });

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

        attachListeners(document.querySelector('#itemBody tr'));
    </script>
@endsection
