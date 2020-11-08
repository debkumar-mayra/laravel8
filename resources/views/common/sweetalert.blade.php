@if(Session::has('Success-sweet'))
    <script type="text/javascript">
        Swal.fire({
        icon: 'success',
        title: 'Success',
        text: '{{ Session::get('Success-sweet') }}',
        showCloseButton: true
       })
    </script>
@endif

@if(Session::has('Error-sweet'))
    <script type="text/javascript">
        Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: '{{ Session::get('Error-sweet') }}',
        showCloseButton: true
       })
    </script>
@endif

@if(Session::has('Info-sweet'))
    <script type="text/javascript">
        Swal.fire({
        icon: 'info',
        title: 'Info',
        text: '{{ Session::get('Info-sweet') }}',
        showCloseButton: true
       })
    </script>
@endif

@if(Session::has('Warning-sweet'))
    <script type="text/javascript">
            Swal.fire({
        icon: 'warning',
        title: 'Warning',
        text: '{{ Session::get('Warning-sweet') }}',
        showCloseButton: true
       })
    </script>
@endif

{{-- <script type="text/javascript">
    Swal.fire({
        icon: 'warning',
        title: 'Success',
        text: 'Thank You',
        showCloseButton: true
        // showCancelButton: true,
       })
</script> --}}