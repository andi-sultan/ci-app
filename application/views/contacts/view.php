<?php $this->load->view('_partials/head'); ?>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title mt-1">Create your contacts here</h3>
          <a href="<?php echo base_url() ?>contacts/add" class="card-title float-right"><button type="button" class="btn btn-block btn-success btn-sm"><i class="fas fa-plus mr-2"></i>Add Contact</button></a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="contacts-table" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Phone Number</th>
                <th>Edit/Delete</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Phone Number</th>
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
    $("#contacts-table").DataTable({
      "serverSide": true,
      "processing": true,
      "order": [
        [0, "asc"]
      ],
      "ajax": {
        url: '<?php echo base_url() ?>contacts/dataTable',
        type: 'POST'
      },
    })

    $('#contacts-table tbody').on('click', '.delete', function() {
      var id = $(this).attr('contact-id')
      var name = $(this).attr('contact-name')
      $(".modal-body #contacts-id").val(id);
      $(".modal-body #contacts-name").html(name);
      Swal.fire({
        title: 'Are you sure?',
        html: 'You are about to delete contact "' + name.bold() + '". You won\'t be able to revert this!',
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then(function(result) {
        if (result.value) {
          $.ajax({
            type: "POST",
            url: "<?php echo base_url() ?>contacts/delete",
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
                $('#contacts-table').DataTable().ajax.reload();
              })
            }
          })
        }
      })
    })
  });
</script>

<?php $this->load->view('_partials/close') ?>