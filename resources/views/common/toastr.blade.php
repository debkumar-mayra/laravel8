@if(Session::has('Success-toastr'))
    <script type="text/javascript">
            toastr.success('{{ Session::get('Success-toastr') }}')
    </script>
@endif

@if(Session::has('Error-toastr'))
    <script type="text/javascript">
            toastr.error('{{ Session::get('Error-toastr') }}')
    </script>
@endif

@if(Session::has('Info-toastr'))
    <script type="text/javascript">
            toastr.info('{{ Session::get('Info-toastr') }}')
    </script>
@endif

@if(Session::has('Warning-toastr'))
    <script type="text/javascript">
            toastr.warning('{{ Session::get('Warning-toastr') }}')
    </script>
@endif
