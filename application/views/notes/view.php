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
            <tbody>
              <?php foreach ($notes_data as $data) { ?>
                <tr>
                  <td>
                    <b><?php echo substr($data->title, 0, 80) . (strlen($data->title) > 80 ? '...' : '') ?></b><br>
                    <?php echo substr($data->content, 0, 80) . (strlen($data->content) > 80 ? '...' : '') ?>
                  </td>
                  <td><?php echo $data->date_created ?></td>
                  <td><?php echo $data->date_modified ?></td>
                  <td>
                    <div class="col-12">
                      <a href="<?php echo base_url() . 'notes/edit?id=' . $data->id ?>" class="text-lg mr-3" data-toggle="tooltip" title="Edit">
                        <i class="fas fa-pen-square"></i>
                      </a>
                      <a href="<?php echo base_url() ?>notes/delete" class="text-danger text-lg" data-toggle="tooltip" title="Delete">
                        <i class="fas fa-trash"></i>
                      </a>
                    </div>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
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
  $(function() {
    $("#notes-table").DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": "<?php echo base_url() ?>notes/_dataTable"
    });
  });
</script>

<?php $this->load->view('_partials/close') ?>