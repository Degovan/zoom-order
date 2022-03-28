@extends('layouts.member.blank')

@push('style')
    <link rel="stylesheet" href="/vendor/simple-datatables/style.css">
    <link rel="stylesheet" href="/vendor/purescss/degov.css">
@endpush
@section('content')
<div class="row">
    <div class="col-md-7 mx-auto">
        <div class="card shadow-none border">
                <div id="contentToPrint">
                  <div class="card-body">
                      <div class="row justify-content-between">
                          <div class="col-md-7">
                            <h1>Invoice #22020 <span class="badge bg-danger">UNPAID</span></h1>
        
                          </div>
                          <div class="col-md-4">
                              <div class="row">
                                  <div class="col-md-5">
                                      <p class="fw-bold">Invoice date</p>
                                  </div>
                                  <div class="col-md-4">
                                      <p>08-09-2020</p>
                                  </div>
                              </div>
                              <div class="row mt-2">
                                  <div class="col-md-5">
                                      <p class="fw-bold">Due Date</p>
                                  </div>
                                  <div class="col-md-5">
                                      <p>Monday, May 11th 2022</p>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="row mt-4">
                          <div class="col-md-8">
                              <div class="text-wrapper">
                                  <h3>Pay to:</h3>
                                  <p class="mt-3">
                                      PT. Furqan digital indonesia
                                  </p> 
                                  <p>NPWP : 00.000.000.0000.000</p>
                                  <p >Jl. Rowosari RT 04 RW 05. Meteseh, Kec Boja, Kabupaten Kendal, Jawa Tengah</p>
                              </div>
                          </div>
                          <div class="col-md-4">
                                  <h3>Invoiced to : </h3>
                                  <p class="mt-3">-</p>
                                  <p class="mt-2 fw-normal">Mohammad Sahrullah</p>
                                  <p class="max-w-2xl ml-0">Kembang - Duko Kembang RT 07 RW 08, Bondowoso, JAWA TIMUR, 60892 Indonesia</p>
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
                                      <td>Zoom Meeting 1 Hari Full Day</td>
                                      <td>Rp.180.000</td> 
                                  </tr>
                                  <tr>
                                      <td>Pajak</td>
                                      <td>Rp.19.000</td> 
                                  </tr>
                              </tbody>
                          </table>
                      </div>
                      <div class="row justify-content-end">
                          <div class="col-md-7">
                          
                          </div>
                          <div class="col-md-8">
                            <table class="table table-borderless">
                              <tbody>
                                <tr>
                                  <th scope="row" class="text-right">Subtotal</th>
                                  <th class="text-right fw-normal">Rp.199,800-</th>
                                </tr>
                                <tr>
                                  <th scope="row" class="text-right">PPN 10%</th>
                                  <th class="text-right fw-normal">Rp.19,980-</th>
                                </tr>
                                <tr>
                                  <th scope="row" class="text-right">Credit</th>
                                  <th class="text-right fw-normal">Rp.0</th>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <div class="row justify-content-end bg-custom-light border">
                          <div class="col-md-7">
                          
                          </div>
                          <div class="col-md-8">
                            <table class="table table-borderless">
                              <tbody>
                                <tr>
                                  <th scope="row" class="text-right">Total</th>
                                  <th class="text-right fw-normal">Rp.219,780-</th>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <p class="mt-5">* indicated a taxed item</p>
                        <div class="table-wrapper mt-5">
                          <h4 class="fw-bold">Transactions</h4>
                          <table class="table mt-3">
                              <thead>
                                  <td class="fw-bold">Transactions date</td>
                                  <td class="fw-bold">Gateway</td>
                                  <td class="fw-bold">Transactions ID</td>
                                  <td class="fw-bold">Amout</td>
                              </thead>
                              <tbody>
                                  <tr>
                                      <td>-</td>
                                      <td>-</td>
                                      <td>-</td>
                                      <td>-</td> 
                                  </tr>
                              </tbody>
                          </table>
                      </div>
                        <div class="row justify-content-end bg-custom-light border">
                          <div class="col-md-7">
                          
                          </div>
                          <div class="col-md-8">
                            <table class="table table-borderless">
                              <tbody>
                                <tr>
                                  <th scope="row" class="text-right">Balance</th>
                                  <th class="text-right fw-normal">Rp.219,780-</th>
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
    @endsection
    @push('script')
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.debug.js"></script>
    <script src="/vendor/simple-datatables/simple-datatables.js"></script>
        <script> 
            var elementHTML = document.querySelector('#contentToPrint');
    
    html2canvas(elementHTML, {
      useCORS: true,
      onrendered: function(canvas) {
        var pdf = new jsPDF('p', 'pt', 'letter');
    
        var pageHeight = 980;
        var pageWidth = 980;
        for (var i = 0; i <= elementHTML.clientHeight / pageHeight; i++) {
          var srcImg = canvas;
          var sX = 0;
          var sY = pageHeight * i; // start 1 pageHeight down for every new page
          var sWidth = pageWidth;
          var sHeight = pageHeight;
          var dX = 0;
          var dY = 0;
          var dWidth = pageWidth;
          var dHeight = pageHeight;
    
          window.onePageCanvas = document.createElement("canvas");
          onePageCanvas.setAttribute('width', pageWidth);
          onePageCanvas.setAttribute('height', pageHeight);
          var ctx = onePageCanvas.getContext('2d');
          ctx.drawImage(srcImg, sX, sY, sWidth, sHeight, dX, dY, dWidth, dHeight);
    
          var canvasDataURL = onePageCanvas.toDataURL("image/png", 1.0);
          var width = onePageCanvas.width;
          var height = onePageCanvas.clientHeight;
    
          if (i > 0) // if we're on anything other than the first page, add another page
            pdf.addPage(612, 864); // 8.5" x 12" in pts (inches*72)
    
          pdf.setPage(i + 1); // now we declare that we're working on that page
          pdf.addImage(canvasDataURL, 'PNG', 20, 40, (width * .62), (height * .62)); // add content to the page
        }
        
      // Save the PDF
        pdf.save('invoice.pdf');
      }
    });
          
        </script>
@endpush    