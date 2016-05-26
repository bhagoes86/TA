{!! HTML::script( 'adminlte/plugins/datatables/jquery.dataTables.min.js' ) !!}
{!! HTML::script( 'adminlte/plugins/datatables/dataTables.bootstrap.min.js' ) !!}
<script>
  $( function() {
    $( '.dataTable' ).DataTable( {
      "info": false,
      "lengthChange": false,
      "language": {
        "emptyTable": "Data tidak ditemukan!",
        "paginate": {
          "next": ">",
          "previous": "<",
          "first": "<<",
          "last": ">>"
        },
        "search": "Pencarian:"
      }
    } );
  } );
</script>
