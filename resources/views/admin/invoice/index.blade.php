@extends('layouts.admin.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
    <div class="d-block mb-4 mb-md-0">
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}"><svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page"></li>
            </ol>
        </nav>
        <h2 class="h4">All Orders </h2>
        <p class="mb-0">Your web analytics dashboard template.</p>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-centered table-nowrap mb-0 rounded">
        <thead class="thead-light">
            <tr>
                <th class="border-0 rounded-start">Country</th>
                <th class="border-0">All</th>
                <th class="border-0 rounded-end">All Change</th>
            </tr>
        </thead>
        <tbody>
            <!-- Item -->
            <tr>
                <td class="border-0">
                    <a href="#" class="d-flex align-items-center">
                        <img class="me-2 image image-small rounded-circle" alt="Image placeholder" src="../../assets/img/flags/united-states-of-america.svg">
                        <div><span class="h6">United States</span></div>
                    </a>
                </td>
                <td class="border-0 font-weight-bold">106</td>
                <td class="border-0 text-danger">
                    <span class="fas fa-angle-down"></span>
                    <span class="font-weight-bold">5</span>
                </td>
            </tr>
            <!-- End of Item -->
            <!-- Item -->
            <tr>
                <td class="border-0">
                    <a href="#" class="d-flex align-items-center">
                        <img class="me-2 image image-small rounded-circle" alt="Image placeholder" src="../../assets/img/flags/canada.svg">
                        <div><span class="h6">Canada</span></div>
                    </a>
                </td>
                <td class="border-0 font-weight-bold">76</td>
                <td class="border-0 text-success">
                    <span class="fas fa-angle-up"></span>
                    <span class="font-weight-bold">17</span>
                </td>
            </tr>
            <!-- End of Item -->
            <!-- Item -->
            <tr>
                <td class="border-0">
                    <a href="#" class="d-flex align-items-center">
                        <img class="me-2 image image-small rounded-circle" alt="Image placeholder" src="../../assets/img/flags/united-kingdom.svg">
                        <div><span class="h6">United Kingdom</span></div>
                    </a>
                </td>
                <td class="border-0 font-weight-bold">147</td>
                <td class="border-0 text-success">
                    <span class="fas fa-angle-up"></span>
                    <span class="font-weight-bold">10</span>
                </td>
            </tr>
            <!-- End of Item -->
            <!-- Item -->
            <tr>
                <td class="border-0">
                    <a href="#" class="d-flex align-items-center">
                        <img class="me-2 image image-small rounded-circle" alt="Image placeholder" src="../../assets/img/flags/france.svg">
                        <div><span class="h6">France</span></div>
                    </a>
                </td>
                <td class="border-0 font-weight-bold">112</td>
                <td class="border-0 text-success">
                    <span class="fas fa-angle-up"></span>
                    <span class="font-weight-bold">3</span>
                </td>
            </tr>
            <!-- End of Item -->

        </tbody>
    </table>
</div>
@endsection
