<script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{ asset('admin-asset/js/select2.min.js') }}"></script>
<script src="{{ asset('admin-asset/js/summernote.js') }}"></script>
<script src="{{ asset('admin-asset/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin-asset/js/jquery.dataTables.min.js') }}"></script>

<script>
    $(document).ready( function () {
        $('#dataTable').DataTable();
        $('.select2').select2();
        $('#summernote').summernote();
    } );
  </script>
