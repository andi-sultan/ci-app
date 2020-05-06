<?php $this->load->view('_partials/head'); ?>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12 col-lg-8 offset-lg-2">
      <div class="card">
        <div class="card-body">
          <form role="form">
            <input type="hidden" name="id" id="id" value="<?php if (isset($data)) echo $data[0]->id ?>">
            <div class="row">
              <div class="col-sm-12">
                <!-- text input -->
                <div class="form-group">
                  <label class="text-xl">Title</label>
                  <input class="form-control form-control-lg" type="text" name="title" id="title" placeholder="Enter ..." value="<?php if (isset($data)) echo $data[0]->title ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <!-- textarea -->
                <div class="form-group">
                  <label class="text-lg">Content</label>
                  <textarea class="form-control" name="content" id="content" rows="9" placeholder="Enter ..."><?php if (isset($data)) echo $data[0]->content ?></textarea>
                </div>
              </div>
            </div>
          </form>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <div class="float-right">
            <?php if (!isset($data[0]->id)) { ?>
              <button type="button" class="btn btn-info mr-2" id="save">Save</button>
            <?php } ?>
            <a href="<?php echo base_url() ?>notes" class="btn btn-default ">Close</a>
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
    function save() {
      var id = $('#id').val();
      var title = $('#title').val();
      var content = $('#content').val();

      if (!title.trim() || !content.trim()) {
        if (!title.trim()) $('#title').addClass('is-invalid')
        if (!content.trim()) $('#content').addClass('is-invalid')
        $('.btn').prop('disabled', true)
        $('a.btn').attr('href', '#')
        Swal.fire({
          toast: true,
          position: 'top',
          type: 'error',
          html: '<h4>Please fill all the fields!</h4>',
          showConfirmButton: false,
          timer: 1500,
          onOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
          }
        }).then(function() {
          $('.btn').prop('disabled', false)
          $('a.btn').attr('href', '<?php echo base_url() ?>notes')
        })
      } else {
        confirmNoteDialog()
      }

      function confirmNoteDialog() {
        if (!id) {
          Swal.fire({
              title: 'Are you sure?',
              text: "You are about to save a note.",
              type: 'question',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, save it!'
            })
            .then(function(result) {
              if (result.value) {
                executeAjax()
              }
            })
        } else {
          executeAjax()
        }
      }

      function executeAjax() {
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
            if (!id) {
              $('#title').prop('disabled', true)
              $('#content').prop('disabled', true)
            }
            $('.btn').prop('disabled', true)
            $('a.btn').attr('href', '#')
          },
          success: function(data) {
            if (!id) {
              Swal.fire(
                'Saved!',
                'Your note has been saved.',
                'success'
              ).then(function() {
                window.location.href = "<?php echo base_url() ?>notes";
              })
            } else {
              Swal.fire({
                toast: true,
                position: 'top',
                type: 'success',
                html: '<h4>Your note has been saved.</h4>',
                showConfirmButton: false,
                timer: 1500,
                onOpen: (toast) => {
                  toast.addEventListener('mouseenter', Swal.stopTimer)
                  toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
              }).then(function() {
                $('#title').prop('disabled', false)
                $('#content').prop('disabled', false)
                $('.btn').prop('disabled', false)
                $('a.btn').attr('href', '<?php echo base_url() ?>notes')
              })
            }
          }
        })
      }
    }

    var noteTimeout
    $('#title, #content').on('input', function() {
      if ($('#title').val() !== '') $('body #title').removeClass('is-invalid')
      if ($('#content').val() !== '') $('body #content').removeClass('is-invalid')
      clearTimeout(noteTimeout)
      noteTimeout = setTimeout(function() {
        if ($('#id').val() !== '') save()
      }, 500);
    })

    $('#save').click(function() {
      save()
    })
  })
</script>

<?php $this->load->view('_partials/close') ?>