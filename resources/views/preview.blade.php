<!DOCTYPE html>
<html lang="en, id">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
      A Simple Invoice Template Responsive and clean with HTML CSS SCSS
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
