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
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Order Detail</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">Order: #{{ $data->id }}</h6>
            </nav>
        </div>
    </nav>

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between">
                        <h6>Order Information</h6>
                        <a href="{{ route('order.index') }}" class="btn btn-secondary btn-sm">Back</a>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <p class="text-sm mb-0 text-secondary">Customer</p>
                                <h6 class="text-sm font-weight-bold">{{ $data->user->name ?? 'N/A' }}</h6>
                            </div>
                            <div class="col-md-3">
                                <p class="text-sm mb-0 text-secondary">Date</p>
                                <h6 class="text-sm font-weight-bold">{{ $data->tgl_pemesanan }}</h6>
                            </div>
                            <div class="col-md-3">
                                <p class="text-sm mb-0 text-secondary">Status</p>
                                <h6 class="text-sm font-weight-bold">{{ $data->status }}</h6>
                            </div>
                            <div class="col-md-3">
                                <p class="text-sm mb-0 text-secondary">Payment</p>
                                <h6 class="text-sm font-weight-bold">{{ strtoupper($data->metode_pembayaran) }}</h6>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Product</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Price</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Qty</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-end">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data->details as $item)
                                        <tr>
                                            <td class="p-3 text-sm font-weight-bold">{{ $item->product->nama_barang ?? 'N/A' }}</td>
                                            <td class="p-3 text-sm font-weight-bold">Rp {{ number_format($item->harga_jual, 0, ',', '.') }}</td>
                                            <td class="p-3 text-sm font-weight-bold">{{ $item->jumlah_jual }}</td>
                                            <td class="p-3 text-sm font-weight-bold text-end">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-end text-sm font-weight-bolder p-3">Grand Total</td>
                                        <td class="text-end text-sm font-weight-bolder p-3">Rp {{ number_format($data->total_bayar, 0, ',', '.') }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
