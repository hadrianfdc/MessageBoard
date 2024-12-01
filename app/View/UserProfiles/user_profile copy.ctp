<?php
$this->Html = $this->loadHelper('Html');
$this->loadHelper('Url');
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <?php echo $this->Html->css('UserProfiles/user_profiles');  ?>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
  <!--------- Added a new cdn Ajax -----------> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <?php

  echo $this->Html->css('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css');
  echo $this->fetch('script');

  echo $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css');
  echo $this->Html->css('https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css');
  echo $this->Html->css('https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css');

  echo $this->fetch('https://code.jquery.com/jquery-3.2.1.slim.min.js');
  echo $this->fetch('https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js');
  echo $this->fetch('https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js');

  echo $this->Html->script('https://cdn.jsdelivr.net/npm/sweetalert2@11');

  ?>

  <title>User Profile</title>
</head>

<body>
<div class="common-structure">
<?php echo $this->element('Nav/navbar'); ?>

    <script>
      function confirmLogout() {
        Swal.fire({
          title: 'Are you sure?',
          text: 'You will be logged out!',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, logout!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              type: 'POST',
              url: '<?php echo $this->Html->url(array("controller" => "logins", "action" => "logout")); ?>',
              success: function(data) {
                window.location.href = '<?php echo $this->Html->url(array("controller" => "logins", "action" => "login")); ?>';
              }
            });
          }
        });
      }

      <?php
      if (isset($success)) {
        if ($success === true) {
          echo "console.log('Success!');";
          echo "Swal.fire({
                title: 'Success!',
                text: 'Post what's on your mind successfully!',
                icon: 'success',
                confirmButtonText: 'Okay',
                allowOutsideClick: false,
                customClass: {
                    confirmButton: 'custom-okay-button'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '" . $this->Html->url(array('controller' => 'Userprofiles', 'action' => 'user_profile')) . "';
                }
            });";
        } elseif ($success === false) {
          echo "console.log('Error!');";
          echo "Swal.fire('Error!', 'Something wrong. Please try again.', 'error');";
        } else {
          echo "console.log('Unknown status: " . $success . "');";
        }
      }
      ?>
    </script>
  </nav>

  <section style="background-color: #B4D4FF; height: 60vh;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-md-9 col-lg-7 col-xl-5">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-4">
              <div class="d-flex text-black">
                <div class="flex-shrink-0">
                  <div class="rounded-circle overflow-hidden" style="width: 150px; height: 150px;">
                    <?php if (!empty($imageRecord)) : ?>
                      <img src="<?php echo $this->Html->url('/' . $imageRecord['Posts']['path']); ?>" alt="Uploaded Image" class="w-100 h-100" id="uploadedImage">
                    <?php else : ?>
                      <div class="d-flex justify-content-center align-items-center w-100 h-100 bg-secondary text-white">No image uploaded</div>
                    <?php endif; ?>
                  </div>
                </div>


                <div class="flex-grow-1 ms-1">
                  <?php foreach ($userProfileData as $key => $profile) : ?>
                    <h5 class="mb-1">Name: <?php echo h($profile['UserProfiles']['full_name']); ?></h5>
                    <p class="mb-0"><b>Birthday:</b> <?php echo date('F j, Y', strtotime($profile['UserProfiles']['birthdate'])); ?></p>
                    <p class="mb-0"><b> Gender: </b> <?php echo h($profile['UserProfiles']['gender']); ?></p>
                    <p class="mb-0"><b>Joined:</b> <?php echo date('F j, Y h:i A', strtotime($profile['UserProfiles']['date_created'])); ?></p>
                    <p class="mb-0"><b> Last time login: </b> <?php echo date('F j, Y h:i A', strtotime($profile['UserProfiles']['last_login_time'])); ?></p>
                    <div class="d-flex flex-column pt-1">
                      <button style="font-size: 12px;" type="button" class="btn btn-outline-primary mb-1" data-bs-toggle="modal" data-bs-target="#editProfileDetailsModal">Edit Profile Details</button>
                      <a style="font-size: 12px;" href="/MessageBoard/upload_profile_picture" class="btn btn-primary">Update profile picture</a>
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>

              <div class="flex-grow-1 ms-1">
                <?php foreach ($userProfileData as $key => $profile) : ?>
                  <h5 class="mb-1">Hobby</h5>
                  <p class="mb-0" id="costumText"><?php echo h($profile['UserProfiles']['hobby']); ?></p>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="wrapper">
    <form method="post" id="postForm">
      <div class="textarea-group">
      <textarea name="captions" maxlength="500" required></textarea>
        <div class="bar"></div>
        <label>What's on your mind? Enter in the space below.</label>
      </div>
      <p id="char-count"></p>
      <div class="form-group">
        <button type="submit" class="btn btn-primary"> Post </button>
      </div>
    </form>
  </div>

  <div class="news-feed">
    <h3>My Post</h3>
    <?php foreach ($profilePost as $key => $profilepost) : ?>
      <div class="post">
        <h5><?php echo h($profilepost['ProfilePost']['fullname']); ?></h5>
        <p><?php echo h($profilepost['ProfilePost']['captions']); ?></p>
        <p class="created-date">Created: <?php echo date('M d, Y H:i', strtotime($profilepost['ProfilePost']['created_date'])); ?></p>
        <?php if (!empty($profilepost['ProfilePost']['updated_date'])) : ?>
          <p class="updated-date">Updated: <?php echo date('M d, Y H:i', strtotime($profilepost['ProfilePost']['updated_date'])); ?></p>
        <?php endif; ?>

      </div>
    <?php endforeach; ?>
  </div>



  <!--------------------------------------- Modal for editing profile details ----------------------------------------->
  <div class="modal fade" id="editProfileDetailsModal" tabindex="-1" role="dialog" aria-labelledby="editProfileDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editProfileDetailsModalLabel">Edit Profile Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-----------------------------------------Form for editing profile details ----------------------------------------->
          <form method="post" action="<?php echo $this->Html->url(array('controller' => 'UserProfiles', 'action' => 'editDetails')); ?>" enctype="multipart/form-data">

            <div class="mb-3">
              <label for="full_name" class="form-label">Full Name:</label>
              <input style="font-size: 12px;" type="text" class="form-control" id="full_name" name="full_name" value="<?php echo isset($profile['UserProfiles']['full_name']) ? h($profile['UserProfiles']['full_name']) : ''; ?>">
            </div>

            <div class="mb-3">
              <label for="birthdate" class="form-label">Birthday:</label>
              <input style="font-size: 12px;" type="text" class="form-control" id="birthdate" name="birthdate" value="<?php echo date('Y-m-d', strtotime($profile['UserProfiles']['birthdate'])); ?>">
            </div>

            <div class="mb-3">
              <label class="form-label">Gender:</label>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="male" value="Male" <?php echo ($profile['UserProfiles']['gender'] == 'Male') ? 'checked' : ''; ?>>
                <label class="form-check-label" for="male">Male</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="female" value="Female" <?php echo ($profile['UserProfiles']['gender'] == 'Female') ? 'checked' : ''; ?>>
                <label class="form-check-label" for="female">Female</label>
              </div>
            </div>

            <div class="mb-3">
              <label for="hobby" class="form-label">Hobby:</label>
              <textarea style="font-size: 12px;" class="form-control" id="hobby" name="hobby" rows="5" maxlength="500"><?php echo isset($profile['UserProfiles']['hobby']) ? h($profile['UserProfiles']['hobby']) : ''; ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Save Changes</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!--------------------- Modal for hovering Profile Photo -------------------------------------------------------->
  <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content bg-transparent border-0">
        <div class="modal-body p-0">
          <img src="" alt="Uploaded Image" class="img-fluid rounded" id="modalImage" style="width: 80%; height: 80%; border:6px solid #495057;">
        </div>
      </div>
    </div>
  </div>

</div>

  <script>
    // JavaScript to handle image hover and modal display
    document.addEventListener("DOMContentLoaded", function() {
      const uploadedImage = document.getElementById('uploadedImage');
      const modalImage = document.getElementById('modalImage');

      uploadedImage.addEventListener('mouseenter', function() {
        const imagePath = this.getAttribute('src');
        modalImage.setAttribute('src', imagePath);
        $('#imageModal').modal('show');
      });

      uploadedImage.addEventListener('mouseleave', function() {
        $('#imageModal').modal('hide');
      });
    });

    $(document).ready(function() {
      $('#postForm').submit(function(e) {
        e.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
          type: 'POST',
          url: 'post_whats_on_your_mind',
          data: formData,
          success: function(response) {
            console.log('Data is posted successfully!');

            Swal.fire({
              title: 'Success!',
              text: 'Post whats on your mind successfully!',
              icon: 'success',
              confirmButtonText: 'Okay',
              allowOutsideClick: false,
              customClass: {
                confirmButton: 'custom-okay-button'
              }
            }).then((result) => {
              if (result.isConfirmed) {
                window.location.href = '<?php echo $this->Html->url(array('controller' => 'Userprofiles', 'action' => 'user_profile')); ?>';
              }
            });
          },
          error: function(xhr, status, error) {
            console.log('Error posting data:', error);
          }
        })

      })

    })

    $(document).ready(function(){
    $('textarea[name="captions"]').on('input', function() {
        var maxLength = $(this).attr('maxlength');
        var currentLength = $(this).val().length;
        var remaining = maxLength - currentLength;
        $('#char-count').text(remaining + ' characters remaining');
    });
});

    //See the cdn
    $('textarea').on('keyup', function() {
      autosize($(this));

      //force label to stay at the top if there is text in the form
      if ($(this).val().length > 0) {
        $(this).addClass('contains-text');
      }
    })

    //focus in textarea if clicked on the label
    $('.textarea-group label').on('click tap', function() {
      $(this).siblings('textarea').focus();
    })
  </script>


  <script>
    $(function() {
      $('#birthdate').datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        beforeShow: function(input, inst) {
          var datepicker = inst.dpDiv;
          setTimeout(function() {
            var header = datepicker.find('.ui-datepicker-title'),
              year = header.find('.ui-datepicker-year'),
              month = header.find('.ui-datepicker-month');
            year.attr('size', '5').css('overflow', 'auto');
            month.attr('size', '5').css('overflow', 'auto');
          }, 0);
        }
      });
    });
  </script>

  <script>
    $(document).ready(function() {
      // Check if success flag is set
      <?php if ($success) : ?>
        swal("Success", "User profile updated successfully.", "success");
      <?php endif; ?>

      // Check if error flag is set
      <?php if ($error) : ?>
        swal("Error", "Error updating user profile.", "error");
      <?php endif; ?>
    });
  </script>


  <script>
    $(document).ready(function() {
      $('.edit-profile-btn').on('click', function() {
        var fullName = $('#full_name').val();
        $('#editProfileForm #full_name').val(fullName);
      });

      $('#editProfileForm').submit(function(e) {
        e.preventDefault();

        $.ajax({
          type: "PUT",
          url: "<?php echo $this->Html->url(array('controller' => 'UserProfiles', 'action' => 'editDetails')); ?>",
          data: $('#editProfileForm').serialize(),
          success: function(response) {

            $('#editProfileModal').modal('hide');

          },
          error: function(xhr, status, error) {

          }
        });
      });
    });
  </script>


</body>

</html>