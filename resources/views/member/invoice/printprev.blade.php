{{-- @extends('layouts.member.print')

@push('style')
    <link rel="stylesheet" href="/vendor/simple-datatables/style.css">
    <link rel="stylesheet" href="/vendor/purescss/degov.css">
@endpush

@section('content')
@php
$total = ($invoice->items->cost - $invoice->items->discount);
@endphp
<div class="main-content container-fluid">
    <div class="row">
        <div class="col-md-9">
            <div class="card shadow-none border">
                <div class="card-body">
                    <div class="row justify-content-between">
                        <div class="col-md-7">
                            <h1>Invoice #{{ $invoice->code }} <span class="badge" id="invoice-status">{{ $invoice->status }}</span></h1>
                        </div>
                        <div class="col-md-5">
                            <div class="row">
                                <div class="col-md-5">
                                    <p class="fw-bold">Invoice date</p>
                                </div>
                                <div class="col-md-4">
                                    <p>{{ $invoice->created_at->format('d/m/Y') }}</p>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-5">
                                    <p class="fw-bold">Due Date</p>
                                </div>
                                <div class="col-md-5">
                                    <p>{{ $invoice->due->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-7">
                            <div class="text-wrapper">
                                <h3>Pay to:</h3>
                                <p class="mt-3">PT. Furqan digital indonesia</p>
                                <p>NPWP : 00.000.000.0000.000</p>
                                <p >Jl. Rowosari RT 04 RW 05. Meteseh, Kec Boja, Kabupaten Kendal, Jawa Tengah</p>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <h3>Invoiced to : </h3>
                            <p class="mt-3">{{ $invoice->user->institution }}</p>
                            <p class="fw-normal">{{ $invoice->user->name }}</p>
                            <p class="max-w-2xl ml-0">{{ $invoice->user->full_address }}</p>
                        </div>
                    </div>

                    <div class="table-wrapper mt-5">
                        <h4 class="fw-bold">Invoice Item</h4>
                        <table class="table mt-3">
                            <thead>
                                <td class="fw-bold">Decription</td>
                                <td class="fw-bold">Amount</td>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $invoice->items->title }}</td>
                                    <td>@money($total)</td>
                                </tr>
                                <tr>
                                    <td>Paket</td>
                                    <td>{{ $invoice->items->packets }} paket</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="row justify-content-end">
                        <div class="col-md-8">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th scope="row" class="text-right">Total</th>
                                        <th>@money($total * $invoice->items->packets)</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection

@push('script')
<script src="/vendor/simple-datatables/simple-datatables.js"></script>
<script>
const status = document.getElementById('invoice-status');

switch(status.innerText.toLowerCase()) {
    case 'unpaid':
            status.classList.add('bg-danger');
        break;
    case 'active':
            status.classList.add('bg-success');
        break;
    case 'complete':
            status.classList.add('bg-info');
        break;
}

window.print()
</script>
@endpush --}}


<!DOCTYPE html>
<html lang="en, id">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
        Invoice #{{ $invoice->code }}
    </title>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="assets/css/invoice.css" />
  </head>
  <body>
    @php
    $total = ($invoice->items->cost - $invoice->items->discount);
    @endphp
    <section class="wrapper-invoice">
      <!-- switch mode rtl by adding class rtl on invoice class -->
      <div class="invoice">
        <div class="invoice-information">
          <h1><b>INVOICE</b></h1>
          <p>#{{ $invoice->code }}</p>
          <span class="badge" id="invoice-status">{{ $invoice->status }}</span>
          <br />
          <table class="table-date">
            <tr>
              <td>Date:</td>
              <td>{{ $invoice->created_at->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <td>Due Date:</td>
                <td>{{ $invoice->due->diffForHumans() }}</td>
              </tr>
            <tr>
              <td><b>Balance Due:</b></td>
              <td><b>IDR 0.00</b></td>
            </tr>
          </table>
        </div>
        <!-- logo brand invoice -->
        <div class="invoice-logo-brand">
          <!-- <h2>Tampsh.</h2> -->
          <img
            src="{{asset('invoice/img/RapatVirtual.png')}}"
            alt="RapatVirtual (Logo Horizontal)"
          />
        </div>
        <!-- invoice head -->
        <div class="invoice-head">
          <div class="head client-info">
            <p><b>PT. Rapat Virtual</b></p>
            <p>Pondok Ungu Permai Blok LL 1 No 26</p>
            <p>Bekasi Utara, Kota Bekasi</p>
            <p>NPWP: 63.509.570.6-407.000</p>
            <p>Telp. 0877-3249-8274</p>
          </div>
          <br />
          <div class="head client-data">
            <p><b>Bill to :</b></p>
            <p><b>{{ $invoice->user->name }}</b></p>
            <p>{{ $invoice->user->institution }}</p>
            <p>
                {{ $invoice->user->full_address }}
            </p>
          </div>
        </div>
        <!-- invoice body-->
        <div class="invoice-body">
          <table class="table">
            <thead>
              <tr>
                <th>Item</th>
                <th>Quantity</th>
                <th>Rate</th>
                <th>Amount</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <b>{{ $invoice->items->title }}</b> <br />
                  Pilih Kapasitas: 500 Attendee
                </td>
                <td>{{ $invoice->items->packets }}</td>
                <td>IDR 549.900.00</td>
                <td>IDR 749.900.00</td>
              </tr>
              <tr>
                <td>
                  <b>Sewa Zoom Webinar Harian</b> <br />
                  Pilih Kapasitas: 1000 Attendee
                </td>
                <td>1</td>
                <td>IDR 549.900.00</td>
                <td>IDR 749.900.00</td>
              </tr>
            </tbody>
          </table>
          <div class="flex-table">
            <div class="flex-column">
                <img src="{{ asset('invoice/image/sign.jpeg')}}" class="signature" alt="" />
            </div>
            <div class="flex-column">
              <table class="table-subtotal">
                <tbody>
                  <tr>
                    <td>Subtotal :</td>
                    <td>IDR @money($total * $invoice->items->packets)</td>
                  </tr>
                  <tr>
                    <td>Tax (0%) :</td>
                    <td>IDR 0.00</td>
                  </tr>
                  <tr>
                    <td>Amount :</td>
                    <td>IDR @money($total * $invoice->items->packets)</td>
                  </tr>
                  <tr>
                    <td>Amount Paid :</td>
                    <td>IDR @money($total * $invoice->items->packets)</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- invoice footer -->
      </div>
    </section>
    <script>
        const status = document.getElementById('invoice-status');

        switch(status.innerText.toLowerCase()) {
            case 'unpaid':
                    status.classList.add('bg-danger');
                break;
            case 'active':
                    status.classList.add('bg-success');
                break;
            case 'complete':
                    status.classList.add('bg-info');
                break;
        }

        window.print()
    </script>
  </body>
</html>
