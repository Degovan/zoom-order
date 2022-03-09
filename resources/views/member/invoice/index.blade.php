@extends('layouts.member.app')

@push('style')
    <link rel="stylesheet" href="/vendor/simple-datatables/style.css">
    <link rel="stylesheet" href="/vendor/purescss/degov.css">
@endpush

@section('content')
<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>All Invoice</h3>
                {{-- <p class="text-subtitle text-muted">We use 'simple-datatables' made by @fiduswriter. You can
                    check the full documentation <a
                        href="https://github.com/fiduswriter/Simple-DataTables/wiki">here</a>.</p> --}}
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Invoice</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
        <div class="row">
            <div class="col-md-9">
                <div class="card shadow-none border">
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
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header bg-primary">
                          <p class="text-white">Total due</p>
                          <h2 class="text-white">Rp.219,780</h2>
                          <p class="text-white mt-3">Payment method: </p>
                          <select class="form-select" aria-label="Default select example">
                            <option selected>GO-PAY</option>
                            <option value="1">DANA</option>
                            <option value="2">OVO</option>
                            <option value="3">LinkAja</option>
                          </select>
                          <button class="button w-full box-border btn-custom mt-2 fw-bold">Proceed To Payment</button>
                        </div>
                    </div>
                    <div class="mt-4">
                        <h4>Actions</h4>
                        <a href=""><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                            <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                            <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                          </svg>  Download</a>
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
        
    </script>
@endpush
