<div class="modal modal-default" id="delete-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Anda yakin ingin menghapus data ini?</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal" id="delete-modal-confirm">Ya</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  function deleteModal (x) {
    var href = x.getAttribute('data-href');
    console.log(href);
    $('#delete-modal').modal({ backdrop: 'static', keyboard: false })
    .one('click', '#delete-modal-confirm', function (e) {
      window.location.href = href;
    });

  }
</script>
