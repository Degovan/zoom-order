@push('script')
<script src="/vendor/sweetalert2/sweetalert2.all.min.js"></script>
    @if(session()->has('alert_s'))
    <script>
        Swal.fire({
            icon: 'success',
            text: '{{ session('alert_s') }}',
            timer: 2000
        });
    </script>
    @endif

    @if(session()->has('alert_i'))
    <script>
        Swal.fire({
            icon: 'info',
            text: '{{ session('alert_i') }}',
            timer: 2000
        });
    </script>
    @endif

    @if(session()->has('alert_e'))
    <script>
        Swal.fire({
            icon: 'error',
            text: '{{ session('alert_e') }}',
            timer: 2000
        });
    </script>
    @endif
@endpush
