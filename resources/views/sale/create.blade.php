@extends('be.master')

@section('menu')
    @include('be.menu')
@endsection

@section('sale')
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-lg-11">
                <!-- Header Magenta (Rp,-) -->
                <div class="card shadow-sm mb-0" style="background-color: #d1008c; border-radius: 10px 10px 0 0;">
                    <div class="card-body text-center py-2">
                        <h1 class="text-white mb-0" id="bigTotal" style="font-weight: 500; font-size: 45px;">Rp,-</h1>
                    </div>
                </div>

                <!-- Form Card -->
                <div class="card shadow-sm" style="border-radius: 0 0 10px 10px; border: 1px solid #c596ca;">
                    <div class="card-body p-4">
                        <form action="{{ route('sale.store') }}" method="POST" id="saleForm">
                            @csrf
                            <div class="row">
                                <!-- Baris 1: Invoive No & Invoice Date -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-xs font-weight-bold" style="color: #4a5568;">Invoive No</label>
                                    <input type="text" name="no_struk" class="form-control form-control-sm" placeholder="Enter Invoice No" value="ST-{{ date('YmdHis') }}" required readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-xs font-weight-bold" style="color: #4a5568;">Invoice Date</label>
                                    <input type="date" name="tgl_jual" class="form-control form-control-sm" value="{{ date('Y-m-d') }}" required>
                                </div>

                                <!-- Baris 2: Distributor & Selling Price -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-xs font-weight-bold" style="color: #4a5568;">Distributor</label>
                                    <select name="id_client" class="form-select form-select-sm">
                                        <option value="">Select Distributor</option>
                                        @foreach($clients as $c)
                                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-xs font-weight-bold" style="color: #4a5568;">Selling Price</label>
                                    <input type="number" id="sellingPrice" name="items[0][harga_jual]" class="form-control form-control-sm" placeholder="0" readonly>
                                </div>

                                <!-- Baris 3: Product & Purchase Amount -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-xs font-weight-bold" style="color: #4a5568;">Product</label>
                                    <select name="items[0][id_barang]" id="productSelect" class="form-select form-select-sm" required>
                                        <option value="">Select Product</option>
                                        @foreach($products as $p)
                                            <option value="{{ $p->id }}" data-price="{{ $p->harga_jual }}" data-purchase="{{ $p->harga_beli ?? 0 }}">
                                                {{ $p->nama_barang }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-xs font-weight-bold" style="color: #4a5568;">Purchase Amount</label>
                                    <input type="number" name="items[0][jumlah_jual]" id="qtyInput" class="form-control form-control-sm" placeholder="0" value="0">
                                </div>

                                <!-- Baris 4: Purchase Price & Sub total -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-xs font-weight-bold" style="color: #4a5568;">Purchase Price</label>
                                    <input type="number" id="purchasePrice" class="form-control form-control-sm" placeholder="0" readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-xs font-weight-bold" style="color: #4a5568;">Sub total</label>
                                    <input type="number" id="subTotal" class="form-control form-control-sm" placeholder="0" readonly>
                                </div>

                                <!-- Baris 5: Selling Margin & Total Pay -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-xs font-weight-bold" style="color: #4a5568;">Selling Margin</label>
                                    <input type="number" id="sellingMargin" class="form-control form-control-sm" placeholder="0" readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-xs font-weight-bold" style="color: #4a5568;">Total Pay</label>
                                    <input type="number" id="totalPay" class="form-control form-control-sm" placeholder="0" readonly style="background-color: #e2e8f0;">
                                </div>
                            </div>

                            <!-- Buttons -->
                            <div class="d-flex justify-content-end mt-4 gap-2">
                                <a href="{{ route('sale.index') }}" class="btn btn-sm text-white shadow-none" style="background-color: #8c9cb4; border-radius: 8px; padding: 10px 25px;">CANCEL</a>
                                <button type="submit" class="btn btn-sm text-white shadow-none" style="background-color: #d1008c; border-radius: 8px; padding: 10px 25px;">SAVE NEW SALE DATA</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .form-control-sm, .form-select-sm {
            border: 1px solid #cbd5e0 !important;
            border-radius: 8px !important;
            padding: 10px !important;
        }
        .form-label {
            margin-bottom: 4px;
        }
    </style>

    <script>
        const productSelect = document.getElementById('productSelect');
        const sellingPriceInput = document.getElementById('sellingPrice');
        const purchasePriceInput = document.getElementById('purchasePrice');
        const qtyInput = document.getElementById('qtyInput');
        const subTotalInput = document.getElementById('subTotal');
        const sellingMarginInput = document.getElementById('sellingMargin');
        const totalPayInput = document.getElementById('totalPay');
        const bigTotalDisplay = document.getElementById('bigTotal');

        function calculate() {
            const selectedOption = productSelect.options[productSelect.selectedIndex];
            const price = parseFloat(selectedOption.getAttribute('data-price')) || 0;
            const purchasePrice = parseFloat(selectedOption.getAttribute('data-purchase')) || 0;
            const qty = parseFloat(qtyInput.value) || 0;
            
            const total = price * qty;
            const margin = price - purchasePrice;

            sellingPriceInput.value = price;
            purchasePriceInput.value = purchasePrice;
            subTotalInput.value = total;
            totalPayInput.value = total;
            sellingMarginInput.value = margin;
            
            if (total > 0) {
                bigTotalDisplay.innerText = 'Rp ' + total.toLocaleString('id-ID') + ',-';
            } else {
                bigTotalDisplay.innerText = 'Rp,-';
            }
        }

        productSelect.addEventListener('change', calculate);
        qtyInput.addEventListener('input', calculate);
    </script>
@endsection
