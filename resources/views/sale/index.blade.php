@extends('be.master')

@section('menu')
    @include('be.menu')
@endsection

@section('sale')
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <!-- Header (Rp,-) -->
                <div class="card shadow-sm mb-0" style="background-color: #3b82f6; border-radius: 10px 10px 0 0;">
                    <div class="card-body text-center py-2">
                        <h1 class="text-white mb-0" id="bigTotal" style="font-weight: 500; font-size: 45px;">Rp,-</h1>
                    </div>
                </div>

                <!-- Form Card -->
                <div class="card shadow-sm mb-4" style="border-radius: 0 0 10px 10px; border: 1px solid #e2e8f0;">
                    <div class="card-body p-4">
                        <form action="{{ route('sale.store') }}" method="POST" id="saleForm">
                            @csrf
                            <input type="hidden" name="tgl_jual" value="{{ date('Y-m-d') }}">
                            <div class="row">
                                <!-- Baris 1: No Invoice & Selling Price -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-xs font-weight-bold" style="color: #4a5568;">No Invoice</label>
                                    <input type="text" name="no_struk" class="form-control form-control-sm" placeholder="Enter Invoice No" value="ST-{{ date('YmdHis') }}" required readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-xs font-weight-bold" style="color: #4a5568;">Selling Price</label>
                                    <input type="number" id="sellingPrice" name="items[0][harga_jual]" class="form-control form-control-sm" placeholder="0" readonly>
                                </div>

                                <!-- Baris 2: Product & Selling Amount -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-xs font-weight-bold" style="color: #4a5568;">Product</label>
                                    <select name="items[0][id_barang]" id="productSelect" class="form-select form-select-sm" required>
                                        <option value="" data-price="0">Select Product</option>
                                        @foreach($products as $p)
                                            <option value="{{ $p->id }}" data-price="{{ $p->harga_jual }}">
                                                {{ $p->nama_barang }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-xs font-weight-bold" style="color: #4a5568;">Selling Amount</label>
                                    <input type="number" name="items[0][jumlah_jual]" id="qtyInput" class="form-control form-control-sm bg-light" placeholder="0" value="0">
                                </div>

                                <!-- Baris 3: Subtotal -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-xs font-weight-bold" style="color: #4a5568;">Subtotal</label>
                                    <input type="text" id="subTotal" class="form-control form-control-sm" placeholder="Rp 0" readonly>
                                </div>
                            </div>

                            <!-- Buttons -->
                            <div class="d-flex justify-content-end mt-2 gap-2">
                                <a href="{{ route('purchase.index') }}" class="btn btn-sm text-white shadow-none" style="background-color: #3b82f6; border-radius: 8px; padding: 10px 25px;">CANCEL</a>
                                <button type="submit" class="btn btn-sm text-white shadow-none" style="background-color: #d1008c; border-radius: 8px; padding: 10px 25px;">SAVE NEW SALE</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Data Table -->
                <div class="card shadow-sm">
                    <div class="card-header pb-0 border-bottom">
                        <h6 class="mb-0 py-2">Sales Data</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0 text-center">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NO</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">INVOICE NO</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">INVOICE DATE</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">PRODUCT ID</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">PRODUCT NAME</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">PRODUCT TYPE</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">EXPIRED DATE</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">STOCK</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">SELLING PRICE</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">PURCHASE PRICE</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">SELLING MARGIN</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">QUANTITY</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">IMAGE</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">SUB TOTAL</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">TOTAL PAY</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sale_details as $nmr => $detail)
                                        @php
                                            $purchase_price = \App\Models\Purchase_Detail::where('id_barang', $detail->id_barang)->latest()->first();
                                            $harga_beli = $purchase_price ? $purchase_price->harga_beli : 0;
                                            $margin = $detail->harga_jual - $harga_beli;
                                        @endphp
                                        <tr>
                                            <td class="text-xs font-weight-bold mb-0">{{ $nmr + 1 . '.' }}</td>
                                            <td class="text-xs font-weight-bold mb-0">{{ $detail->sale->no_struk ?? '-' }}</td>
                                            <td class="text-xs font-weight-bold mb-0">{{ $detail->sale->tgl_jual ?? '-' }}</td>
                                            <td class="text-xs font-weight-bold mb-0">{{ $detail->id_barang }}</td>
                                            <td class="text-xs font-weight-bold mb-0">{{ $detail->product->nama_barang ?? '-' }}</td>
                                            <td class="text-xs font-weight-bold mb-0">{{ $detail->product->jenis_barang ?? '-' }}</td>
                                            <td class="text-xs font-weight-bold mb-0">{{ $detail->product->tgl_expired ?? '-' }}</td>
                                            <td class="text-xs font-weight-bold mb-0">{{ $detail->product->stok ?? 0 }}</td>
                                            <td class="text-xs font-weight-bold mb-0">Rp {{ number_format($detail->harga_jual, 0, ',', '.') }}</td>
                                            <td class="text-xs font-weight-bold mb-0">Rp {{ number_format($harga_beli, 0, ',', '.') }}</td>
                                            <td class="text-xs font-weight-bold mb-0">{{ $margin }}</td>
                                            <td class="text-xs font-weight-bold mb-0">{{ $detail->jumlah_jual }}</td>
                                            <td>
                                                @if($detail->product && $detail->product->foto_barang)
                                                    <img src="{{ asset('storage/' . $detail->product->foto_barang) }}" alt="image" style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px;">
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="text-xs font-weight-bold mb-0">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                            <td class="text-xs font-weight-bold mb-0">Rp {{ number_format($detail->sale->total_bayar ?? 0, 0, ',', '.') }}</td>
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if (session('simpan'))
            Swal.fire({ icon: 'success', title: 'Success!', text: '{{ session('simpan') }}' });
        @endif
        @if (session('error'))
            Swal.fire({ icon: 'error', title: 'Error!', text: '{{ session('error') }}' });
        @endif

        const productSelect = document.getElementById('productSelect');
        const sellingPriceInput = document.getElementById('sellingPrice');
        const qtyInput = document.getElementById('qtyInput');
        const subTotalInput = document.getElementById('subTotal');
        const bigTotalDisplay = document.getElementById('bigTotal');

        function calculate() {
            const selectedOption = productSelect.options[productSelect.selectedIndex];
            const price = parseFloat(selectedOption.getAttribute('data-price')) || 0;
            const qty = parseFloat(qtyInput.value) || 0;
            
            const total = price * qty;

            sellingPriceInput.value = price;
            
            if (total > 0) {
                subTotalInput.value = 'Rp ' + total.toLocaleString('id-ID');
                bigTotalDisplay.innerText = 'Rp ' + total.toLocaleString('id-ID');
            } else {
                subTotalInput.value = 'Rp 0';
                bigTotalDisplay.innerText = 'Rp,-';
            }
        }

        productSelect.addEventListener('change', calculate);
        qtyInput.addEventListener('input', calculate);
    </script>
@endsection
