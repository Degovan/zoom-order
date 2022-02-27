@push('script')
<script src="/vendor/sweetalert2/sweetalert2.all.min.js"></script>
    @if(session()->has('alert_s'))
    <script>
        Swal.fire({
            icon: 'success',
            text: '{{ session('alert_s') }}',
            timer: 1500
        });
    </script>
    @endif
@endpush
