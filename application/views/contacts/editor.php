<?php $this->load->view('_partials/head'); ?>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12 col-lg-8 offset-lg-2">
      <div class="card">
        <form role="form" id="contact-form">
          <input type="hidden" name="id" id="id" value="<?php if (isset($data)) echo $data[0]->id ?>">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                  <label>First Name</label>
                  <input type="text" id="first-name" name="firstName" class="form-control" value="<?php if (isset($data)) echo $data[0]->first_name ?>">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Last Name</label>
                  <input type="text" id="last-name" name="lastName" class="form-control" value="<?php if (isset($data)) echo $data[0]->last_name ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <!-- text input -->
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" id="email" name="email" class="form-control" value="<?php if (isset($data)) echo $data[0]->email ?>">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Phone Number</label>
                  <input type="text" id="phone-number" name="phoneNumber" class="form-control" value="<?php if (isset($data)) echo $data[0]->phone_number ?>">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6">
                <label>Gender</label>
                <div class="form-group clearfix">
                  <div class="icheck-primary icheck-inline">
                    <input type="radio" id="gender-male" name="gender" value="Male" <?php if (isset($data)) echo $data[0]->gender == "Male" ? 'checked' : '' ?>>
                    <label for="gender-male">Male</label>
                  </div>
                  <div class="icheck-primary icheck-inline">
                    <input type="radio" id="gender-female" name="gender" value="Female" <?php if (isset($data)) echo $data[0]->gender == "Female" ? 'checked' : '' ?>>
                    <label for="gender-female">Female</label>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <div class="float-right">
              <button type="submit" class="btn btn-info mr-2">Save</button>
              <a href="<?php echo base_url() ?>contacts" class="btn btn-default ">Close</a>
            </div>
          </div>
          <!-- /.card-footer -->
        </form>
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
    $.validator.setDefaults({
      submitHandler: function() {
        var id = $('#id').val();
        var firstName = $('#first-name').val();
        var lastName = $('#last-name').val();
        var email = $('#email').val();
        var gender = $("input[name='gender']:checked").val();
        var phoneNumber = $('#phone-number').val();

        if (!id) {
          Swal.fire({
              title: 'Are you sure?',
              text: "You are about to save a contact.",
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

        function executeAjax() {
          $.ajax({
            type: "POST",
            url: "<?php echo base_url() ?>contacts/save",
            dataType: "JSON",
            data: {
              id: id,
              first_name: firstName,
              last_name: lastName,
              email: email,
              gender: gender,
              phone_number: phoneNumber
            },
            beforeSend: function(data) {
              if (!id) {
                $('#first-name').prop('disabled', true)
                $('#last-name').prop('disabled', true)
                $('#email').prop('disabled', true)
                $('input[name="gender"]').prop('disabled', true)
                $('#phone-number').prop('disabled', true)
              }
              $('.btn').prop('disabled', true)
              $('a.btn').attr('href', '#')
            },
            success: function(data) {
              if (!id) {
                Swal.fire(
                  'Saved!',
                  'Your contact has been saved.',
                  'success'
                ).then(function() {
                  window.location.href = "<?php echo base_url() ?>contacts";
                })
              } else {
                Swal.fire({
                  toast: true,
                  position: 'top',
                  type: 'success',
                  html: '<h4>Your contact has been saved.</h4>',
                  showConfirmButton: false,
                  timer: 1500,
                  onOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                  }
                }).then(function() {
                  $('#first-name').prop('disabled', false)
                  $('#last-name').prop('disabled', false)
                  $('#email').prop('disabled', false)
                  $('input[name="gender"]').prop('disabled', false)
                  $('#phone-number').prop('disabled', false)
                  $('.btn').prop('disabled', false)
                  $('a.btn').attr('href', '<?php echo base_url() ?>contacts')
                })
              }
            }
          })
        }
      }
    })
    $('#contact-form').validate({
      rules: {
        firstName: {
          required: true
        },
        email: {
          required: true,
          email: true,
        },
        phoneNumber: {
          required: true,
          minlength: 6
        },
        gender: {
          required: true
        }
      },
      messages: {
        email: {
          required: "Please enter a email address",
          email: "Please enter a vaild email address"
        },
        phoneNumber: {
          required: "Please provide a phone number",
          minlength: "Your phonen number must be at least 6 characters long"
        },
      },
      errorElement: 'span',
      errorPlacement: function(error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function(element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function(element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
    })
  })
</script>

<?php $this->load->view('_partials/close') ?>