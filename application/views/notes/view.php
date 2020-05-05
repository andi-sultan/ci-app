<?php $this->load->view('_partials/head'); ?>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title mt-1">Create your notes here</h3>
          <a href="<?php echo base_url() ?>notes/add" class="card-title float-right"><button type="button" class="btn btn-block btn-success btn-sm"><i class="fas fa-plus mr-2"></i>Add Note</button></a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="notes-table" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Title - Content</th>
                <th>Date Created</th>
                <th>Date Modified</th>
                <th>Edit/Delete</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Title - Content</th>
                <th>Date Created</th>
                <th>Date Modified</th>
                <th>Edit/Delete</th>
              </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
<?php $this->load->view('_partials/footer') ?>

<script>
  $(document).ready(function() {
    $("#notes-table").DataTable({
      "serverSide": true,
      "processing": true,
      "order": [
        // order by third column from left
        // (Date Modified) count from 0
        [2, "desc"]
      ],
      "ajax": {
        url: '<?php echo base_url() ?>notes/dataTable',
        type: 'POST'
      },
    })

    $('#notes-table tbody').on('click', '.delete', function() {
      var id = $(this).attr('note-id')
      var title = $(this).attr('note-title')
      $(".modal-body #note-id").val(id);
      $(".modal-body #note-title").html(title);
      Swal.fire({
        title: 'Are you sure?',
        html: 'You are about to delete note "' + title.bold() + '". You won\'t be able to revert this!',
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then(function(result) {
        if (result.value) {
          $.ajax({
            type: "POST",
            url: "<?php echo base_url() ?>notes/delete",
            dataType: "JSON",
            data: {
              id: id
            },
            beforeSend: function(data) {
              $('.btn').prop('disabled', true)
            },
            success: function(data) {
              Swal.fire(
                'Saved!',
                'Your note has been deleted.',
                'success'
              ).then(() => {
                $('.btn').prop('disabled', false)
                $('#notes-table').DataTable().ajax.reload();
              })
            }
          })
        }
      })
    })
  });
</script>

<?php $this->load->view('_partials/close') ?>