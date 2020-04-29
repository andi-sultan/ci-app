<?php $this->load->view('_partials/head'); ?>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12 col-lg-8 offset-lg-2">
      <div class="card">
        <div class="card-body">
          <form role="form">
            <input type="hidden" name="id" id="id" value="<?php echo isset($data) ? $data[0]->id : '' ?>">
            <div class="row">
              <div class="col-sm-12">
                <!-- text input -->
                <div class="form-group">
                  <label class="text-xl">Title</label>
                  <input class="form-control form-control-lg" type="text" name="title" id="title" placeholder="Enter ..." value="<?php echo isset($data) ? $data[0]->title : '' ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <!-- textarea -->
                <div class="form-group">
                  <label class="text-lg">Content</label>
                  <textarea class="form-control" name="content" id="content" rows="9" placeholder="Enter ..."><?php echo isset($data) ? $data[0]->content : '' ?></textarea>
                </div>
              </div>
            </div>
          </form>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <div class="float-right">
            <button type="button" class="btn btn-info mr-2" id="save">Save</button>
            <a href="<?php echo base_url() ?>notes" class="btn btn-default ">Cancel</a>
          </div>
        </div>
        <!-- /.card-footer -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col-->
  </div>
  <!-- ./row -->
</section>
<!-- /.content -->
<?php $this->load->view('_partials/footer') ?>

<script>
  $(document).ready(function() {
    $('#save').click(function() {
      var id = $('#id').val();
      var title = $('#title').val();
      var content = $('#content').val();
      $.ajax({
        type: "POST",
        url: "<?php echo base_url() ?>notes/save",
        dataType: "JSON",
        data: {
          id: id,
          title: title,
          content: content
        },
        beforeSend: function(data) {
          $('#save').html('Loading...')
          $('#save').prop('disabled', true)
          $('#title').prop('disabled', true)
          $('#content').prop('disabled', true)
        },
        success: function(data) {
          alert('Success')
          $('#save').html('Save')
          $('#save').prop('disabled', false)
          $('#title').prop('disabled', false)
          $('#content').prop('disabled', false)
        }
      })
    })
  })
</script>

<?php $this->load->view('_partials/close') ?>