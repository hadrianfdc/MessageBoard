
<head>
<?php echo $this->Html->css('UserProfiles/user_profiles');  
echo $this->Html->css('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css');
?>

</head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"><!-- For Icons CDN Link -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="module" src="https://cdn.jsdelivr.net/npm/emoji-picker-element@^1/index.js"></script> <!--Facebook CDN Link -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
<button class="icon-button e-dark-mode-button u-animation-click" id="darkMode" aria-label="Dark Mode"><span class="icon" aria-hidden="true">🌜</span></button>
<div id="profile-upper">
    <div id="profile-banner-image">
      <img src="<?php echo $this->Html->url('/' . $findMyPic['Posts']['background_img']); ?>" alt="Banner image">
    </div>
    <div id="profile-d">
      <div id="profile-pic">
        <?php if (!empty($findMyPic['Posts']['path'])): ?>
          <img src="<?php echo $this->Html->url('/' . $findMyPic['Posts']['path']); ?>">
        <?php endif; ?>
        <a href="/MessageBoard/upload_profile_picture"><i class="fa fa-camera" style="font-size:24px; color: white"></i></a>
      </div>
      <div id="u-name"><?php echo $user['User']['full_name']; ?></div>
      <div class="tb" id="m-btns">
        <div class="td">
          <div class="m-btn"><i>📋</i><span>Activity log</span></div>
        </div>
        <div class="td">
            <div class="m-btn"><i>🔒</i><span>Privacy</span></div>
        </div>
      </div>
      <div id="edit-profile"><a href="/MessageBoard/update_background_img"><i class="fa fa-camera" style="font-size:24px"></i></a></div>
    </div>
    <div id="black-grd"></div>
  </div>
<div class="common-structure">
  <?php echo $this->element('Nav/navbar'); ?>
  <aside class="side-a">

  <div class="l-cnt">
    <div class="cnt-label">
      <i class="l-i" id="l-i-i"></i>
      <span>Intro</span>
      <div class="lb-action"><i id="editProfileBtn" class="material-icons">✏️</i></div>
    </div>
    <div id="i-box">
      <div id="intro-line" style="color: black;">
          <?php echo htmlspecialchars($userProfileData[0]['UserProfiles']['hobby'], ENT_QUOTES, 'UTF-8'); ?>
      </div>
        <div id="u-occ"></div>
        <?php if (!empty($userProfileData[0]['UserProfiles']['links'])): ?>
            <p class="mb-0"><b><i class="fas fa-link"></i></b> <a style="color: black;" href="<?php echo $userProfileData[0]['UserProfiles']['links']; ?>" >Link</a></p><br>
          <?php endif; ?>

          <?php if (!empty($userProfileData[0]['UserProfiles']['work'])): ?>
            <p class="mb-0"><b><i class="fas fa-briefcase"></i></b> <?php echo $userProfileData[0]['UserProfiles']['work']; ?></p><br>
          <?php endif; ?>

          <?php if (!empty($userProfileData[0]['UserProfiles']['education'])): ?>
            <p class="mb-0"><b><i class="fas fa-graduation-cap"></i></b> <?php echo $userProfileData[0]['UserProfiles']['education']; ?></p><br>
          <?php endif; ?>

          <?php if (!empty($userProfileData[0]['UserProfiles']['gender'])): ?>
            <p class="mb-0"><b><i class="fas fa-venus-mars"></i></b> <?php echo $userProfileData[0]['UserProfiles']['gender']; ?></p><br>
          <?php endif; ?>

          <?php if (!empty($userProfileData[0]['UserProfiles']['location'])): ?>
            <p class="mb-0"><b><i class="fas fa-map-marker-alt"></i></b> From <b style="color: black;"><?php echo $userProfileData[0]['UserProfiles']['location']; ?></b></p><br>
          <?php endif; ?>

          <?php if (!empty($userProfileData[0]['UserProfiles']['relationship'])): ?>
            <p class="mb-0"><b><i class="fas fa-heart"></i></b> In a relationship with <b style="color:black;"><?php echo $userProfileData[0]['UserProfiles']['relationship']; ?></b></p><br>
          <?php endif; ?>

          <?php if (!empty($userProfileData[0]['UserProfiles']['birthdate'])): ?>
            <p class="mb-0"><b><i class="fas fa-birthday-cake"></i></b> <?php echo $userProfileData[0]['UserProfiles']['birthdate']; ?></p><br>
          <?php endif; ?>

          <?php if (!empty($userProfileData[0]['UserProfiles']['date_created'])): ?>
            <p class="mb-0"><b><i class="fas fa-calendar-plus"></i></b> <?php echo date('F j, Y h:i A', strtotime($userProfileData[0]['UserProfiles']['date_created'])); ?></p><br>
          <?php endif; ?>

          <?php if (!empty($userProfileData[0]['UserProfiles']['last_login_time'])): ?>
            <p class="mb-0"><b><i class="fas fa-sign-in-alt"></i></b> <?php echo date('F j, Y h:i A', strtotime($userProfileData[0]['UserProfiles']['last_login_time'])); ?></p><br>
          <?php endif; ?>

        <div class="d-flex flex-column pt-1">
      </div>
    </div>
  </div>
   
  <div class="l-cnt l-mrg">
      <div class="cnt-label">
          <i class="l-i" id="l-i-p"></i>
          <span>Photos</span>
          <div class="lb-action" id="b-i"><i class="material-icons"></i></div>
      </div>
      <div id="photos">
          <div class="tb">
              <?php 
                  $counter = 0;
                  $columns = 2; 
                  foreach ($photoList as $index => $photo): 
                      if ($index % $columns == 0): ?>
                          <div class="row">
                      <?php endif; ?>
                              <div class="column">
                                  <img style="border: solid 3px black; height: 50%:" src="<?php echo $this->Html->url('/' . $photo ); ?>" alt="Photo <?= $index + 1 ?>" />
                              </div>
                      <?php 
                            if (($index + 1) % $columns == 0 || $index + 1 == count($photoList)): ?>
                          </div> 
                       <?php endif; 
                  endforeach;
              ?>
          </div>
      </div>
  </div>



  </aside>
  <main class="main-feed">
    <ul class="main-feed-list">
    <?php if (!empty($findPost)): ?>
        <?php foreach ($findPost as $post): ?>
            <div class="main-feed-item">
                <article class="common-post">
                    <?php if ($post['is_pinned'] == 1): ?>
                      <div><span class="icon">📌</span> <b> Pinned Post </b></div>
                    <?php endif; ?>
                    <header class="common-post-header u-flex">
                        <!-- Display the user's avatar using the dynamic image path -->
                        <?php 
                            $avatarUrl = !empty($post['images']) ? $post['images'][0] : 'https://assets.codepen.io/65740/internal/avatars/users/default.png';
                        ?>
                        <img src="<?php echo $this->Html->url('/' . $avatarUrl); ?>" class="user-image" width="40" height="40" alt="">
                        <div class="common-post-info">
                            <div class="user-and-group u-flex">
                                <a href="#" target="_blank"><?php echo h($post['fullname']); ?></a>
                            </div>
                            <div class="time-and-privacy">
                                <!-- Display the created date -->
                                <time datetime="<?php echo h($post['created_date']); ?>">
                                    <?php echo date('F j \a\t g:i A', strtotime($post['created_date'])); ?>
                                </time>
                                <span class="icon icon-privacy">
                                    <?php 
                                        if ($post['privacy'] == 1) {
                                            echo '🔒 Only Me';
                                        } elseif ($post['privacy'] == 2) {
                                            echo '🌎 Public';
                                        }elseif ($post['privacy'] == 3) {
                                          echo '👥 Friends';
                                      }
                                    ?>
                                </span>
                            </div>
                        </div>
                        <!-- Dropdown Menu of Post -->
                        <button class="icon-button-2 u-margin-inline-start" aria-label="more options" aria-label="more options" onclick="toggleCustomDropdown(event, '<?php echo $post['id']; ?>')">
                            <span class="icon-menu"></span>
                        </button>
                        <!-- Dropdown menu -->
                        <div id="custom-dropdown-menu-<?php echo $post['id']; ?>" class="custom-dropdown-menu">
                            <ul>
                                <li 
                                    class="toggle-pin-post" 
                                    data-post-id="<?php echo $post['id']; ?>" 
                                    data-is-pinned="<?php echo $post['is_pinned']; ?>">
                                    <span class="icon">📌</span>
                                    <?php if ($post['is_pinned'] == 1): ?> Unpin Post
                                    <?php else: ?> Pin Post
                                    <?php endif; ?>
                                </li>
                                <li><span class="icon">🔖</span>
                                  <?php if ($post['is_saved'] == 1): ?> Unsave Post
                                  <?php else: ?> Save Post
                                  <?php endif; ?>
                                </li>
                                <li class="edit-post" data-post-id="<?php echo $post['id']; ?>">
                                  <span class="icon">✏️</span> Edit Post
                                </li>
                                <li class="edit-privacy" data-post-id="<?php echo $post['id']; ?>"><span class="icon"></span> 
                                     <?php 
                                        if ($post['privacy'] == 1) {
                                            echo '🔒 Change Audience (Only Me)';
                                        } elseif ($post['privacy'] == 2) {
                                            echo '🌎 Change Audience (Public)';
                                        }elseif ($post['privacy'] == 3) {
                                          echo '👥 Change Audience (Friends)';
                                      }
                                    ?>
                                </li>
                                <li><span class="icon">💬</span> Who can comment on this post?</li>
                                <li
                                    class="toggle-archieve-post" 
                                    data-post-id="<?php echo $post['id']; ?>" 
                                    data-is-archieve="<?php echo $post['is_archieve']; ?>"
                                    ><span class="icon">📦</span> Move to Archive
                                </li>
                                <li class="toggle-trash-post" 
                                    data-post-id="<?php echo $post['id']; ?>">
                                    <span class="icon">🗑️</span> Move to Trash
                                </li>
                                <li><span class="icon">🔔</span> Get Notified about this Post</li>
                                <li><span class="icon">📸</span> Add to Album</li>
                            </ul>
                        </div>
                        <!-- End Of Dropdown Menu of Post -->
                    </header>
                    <div class="common-post-content common-content">
                        <!-- Display the caption -->
                        <p><?php echo h($post['captions']); ?></p>
                    </div>
                    <?php if (!empty($post['file_paths'])): ?>
                        <div class="image-grid">
                            <?php foreach ($post['file_paths'] as $index => $image): ?>
                                <div class="image-item">
                                    <img src="<?php echo $this->Html->url('/' . $image); ?>" alt="Post Image" class="image">
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <div class="summary u-flex">
                        <div class="reactions">❤️</div>
                        <div class="reactions-total"><?php echo $post['react']; ?></div>
                    </div>
                    <section class="actions-buttons">
                      <ul class="actions-buttons-list u-flex">
                          <button class="actions-buttons-button"><span class="icon">👍</span><span class="text">Like</span></button>
                      </ul>
                    </section>
                </article>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    </ul>
  </main>
  <aside class="side-b">
    <section class="common-section">
      <h2 class="section-title">Sponsored</h2>
      <ul class="common-list">
        <li class="common-list-item">
          <a href="http://bit.ly/2Nd05lW" target="_blank" class="common-list-button is-ads">
            <div class="image"><img src="https://bit.ly/3cY5ncE" width="115" alt=""></div>
            <div class="text">
              <h4 class="ads-title">Export Sketch to HTML with a click</h4>
              <p class="ads-url">animaapp.com</p>
            </div>
          </a>
        </li>
        <li class="common-list-item">
          <a href="http://bit.ly/2Nd05lW" target="_blank" class="common-list-button is-ads">
            <div class="image"><img src="https://cssclasscom.files.wordpress.com/2020/06/14.png?w=300" width="115" alt=""></div>
            <div class="text">
              <h4 class="ads-title">Front-end developers, prepare to be amazed</h4>
              <p class="ads-url">animaapp.com</p>
            </div>
          </a>
        </li>
      </ul>
      <button class="common-more">
        <span class="text">See More</span>
        <span class="icon">🔻</span>
      </button>
    </section>
  </aside>
</div>
<?php echo $this->element('modal_edit_profile'); ?>

<script>

 // <!-- Dropdown Menu of Post -->
 function toggleCustomDropdown(event, postId) {
        var dropdown = document.getElementById('custom-dropdown-menu-' + postId);
        event.stopPropagation();
        dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
    }

    // Close dropdown if clicked outside
    document.addEventListener('click', function(event) {
        var dropdowns = document.querySelectorAll('.custom-dropdown-menu');
        dropdowns.forEach(function(dropdown) {
            if (!dropdown.contains(event.target) && !dropdown.previousElementSibling.contains(event.target)) {
                dropdown.style.display = 'none';
            }
        });
    });

    // Close dropdowns on scroll
    window.addEventListener('scroll', function() {
        var dropdowns = document.querySelectorAll('.custom-dropdown-menu');
        dropdowns.forEach(function(dropdown) {
            dropdown.style.display = 'none';
        });
    });
    // <!-- END OF Dropdown Menu of Post -->

    //--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------

  document.addEventListener('DOMContentLoaded', function () {

    const uploadImages = document.getElementById('uploadImages');
    const uploadIcon = document.getElementById('click_icon');
    const imagePreviewContainer = document.getElementById('imagePreviewContainer');
    const form = uploadImages.closest('form');

    if (!uploadImages || !imagePreviewContainer) {
        console.error('Required elements not found in the DOM.');
        return;
    }

    const maxImages = 5;
    let selectedFiles = [];

    uploadIcon.addEventListener('click', function () {
        uploadImages.click();
    })

    uploadImages.addEventListener('change', function () {

          const files = Array.from(this.files);
          console.log(selectedFiles);
          if (selectedFiles.length + files.length > maxImages) {
              alert(`You can only upload up to ${maxImages} images.`);
              this.value = '';
              return;
          }

          files.forEach((file) => {
              if (file.type.startsWith('image/')) {
                  const reader = new FileReader();

                  reader.onload = function (e) {
                      const imageWrapper = document.createElement('div');
                      imageWrapper.classList.add('image-preview');

                      const image = document.createElement('img');
                      image.src = e.target.result;
                      image.alt = `Preview`;
                      image.style.width = '100%';
                      image.style.height = '100%';
                      image.style.objectFit = 'cover';

                      const removeBtn = document.createElement('span');
                      removeBtn.textContent = '×';
                      removeBtn.classList.add('remove-btn');

                      // Remove image on click
                      removeBtn.addEventListener('click', function () {
                          const index = selectedFiles.indexOf(file);
                          if (index !== -1) selectedFiles.splice(index, 1); 
                          imageWrapper.remove();
                      });

                      imageWrapper.appendChild(image);
                      imageWrapper.appendChild(removeBtn);
                      imagePreviewContainer.appendChild(imageWrapper);

                      selectedFiles.push(file);
                  };

                  reader.readAsDataURL(file);
              }
          });

          this.value = '';
      });
      form.addEventListener('submit', function (event) {
          const postText = document.getElementById('postText').value;
          const fileInput = uploadImages;
          const dataTransfer = new DataTransfer();
          if (postText.trim() === '' && selectedFiles.length === 0) {
              event.preventDefault();
              alert('Please write something before posting.');
          }
          selectedFiles.forEach(file => {
              dataTransfer.items.add(file);
          });
          fileInput.files = dataTransfer.files;
      });
  });

//--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------

  // Modal functionality Creating Post
  const openModalBtn = document.getElementById('openModalBtn');
  const closeModalBtn = document.getElementById('closeModalBtn');
  const createPostModal = document.getElementById('createPostModal');
  const cancelPostBtn = document.getElementById('cancelPostBtn');

  // Open Modal
  openModalBtn.addEventListener('click', () => {
      createPostModal.style.display = 'flex';
  });

  // Close Modal
  closeModalBtn.addEventListener('click', () => {
      createPostModal.style.display = 'none';
  });

  cancelPostBtn.addEventListener('click', () => {
      createPostModal.style.display = 'none';
  });

  //--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------

   // JavaScript to handle modal User Details
   document.getElementById('editProfileBtn').addEventListener('click', function () {
    document.getElementById('editProfileModal').style.display = 'block';
  });

  document.getElementById('close-ModalBtn').addEventListener('click', function () {
    document.getElementById('editProfileModal').style.display = 'none';
  });
  window.addEventListener('click', function (event) {
    const modal = document.getElementById('editProfileModal');
    if (event.target === modal) {
      modal.style.display = 'none';
    }
  });

  //--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------

  //Pin and Unpin Post
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.toggle-pin-post').forEach(function (element) {
        element.addEventListener('click', function () {
            const postId = this.getAttribute('data-post-id');
            const isPinned = this.getAttribute('data-is-pinned');

            // Toggle isPinned value
            const newPinnedStatus = isPinned === '1' ? 0 : 1;

            // Send the data to the controller
            fetch('/MessageBoard/togglePin', {
                method: 'POST',
                body: JSON.stringify({
                    post_id: postId,
                    is_pinned: newPinnedStatus
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.reload();
                } else {
                    alert('Failed to toggle pin status.');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
});

//--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------

  //ARCHIEVE Post
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.toggle-archieve-post').forEach(function (element) {
        element.addEventListener('click', function () {
            const postId = this.getAttribute('data-post-id');
            const isArchieve = this.getAttribute('data-is-archieve');

            // Toggle isArchieve value
            const newArchieveStatus = isArchieve === '1' ? 0 : 1;

            // Send the data to the controller
            fetch('/MessageBoard/toggleArchieve', {
                method: 'POST',
                body: JSON.stringify({
                    post_id: postId,
                    is_archieve: newArchieveStatus
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.reload();
                } else {
                    alert('Failed to toggle pin status.');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
});

//--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------

  //Move to trash Post
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.toggle-trash-post').forEach(function (element) {
        element.addEventListener('click', function () {
            const postId = this.getAttribute('data-post-id');

            // Send the data to the controller
            fetch('/MessageBoard/toggleTrash', {
                method: 'POST',
                body: JSON.stringify({
                    post_id: postId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.reload();
                } else {
                    alert('Failed to move to trash.');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
});

//--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------

// Get references to the modal and its components
const editPostModal = document.getElementById('editPostModal');
const closeEditModalBtn = document.getElementById('closeEditModalBtn');
const cancelEditPostBtn = document.getElementById('cancelEditPostBtn');
const postTextArea = document.getElementById('postEditText'); 
const postID = document.getElementById('postEditID'); 
const privacySelector = document.getElementById('privacyEditSelector'); 
const imagePreviewContainer = document.getElementById('imageEditPreviewContainer'); 

// Open Edit Modal for a specific post
document.querySelectorAll('.edit-post').forEach((button) => {
    button.addEventListener('click', async function () {
        const postId = this.getAttribute('data-post-id');
        
        try {
            const response = await fetch(`/MessageBoard/UserProfiles/getPostDetails/${postId}`);
            const postDetails = await response.json();

            if (response.ok && postDetails.success) {

                postTextArea.value = postDetails.data.captions;
                privacySelector.value = postDetails.data.privacy;
                postID.value = postDetails.data.id;

                // Clear previous image previews
                imagePreviewContainer.innerHTML = '';

                // Parse file_paths into an array
                const filePaths = JSON.parse(postDetails.data.file_paths);

                // Add new image previews
                    if (Array.isArray(filePaths)) {
                        filePaths.forEach((filePath, index) => {
                          const imageWrapper = document.createElement('div');
                          imageWrapper.classList.add('image-preview');
                          console.log('filePath:', filePath);
                          const img = document.createElement('img');
                          img.src = filePath;
                          img.alt = 'Existing Image';
                          img.style.width = '100px';
                          img.style.height = '100px';
                          img.style.objectFit = 'cover';
                          img.style.borderRadius = '8px';

                          const removeBtn = document.createElement('span');
                          removeBtn.textContent = '×';
                          removeBtn.classList.add('remove-btn');

                          // Remove existing image on click
                          removeBtn.addEventListener('click', function () {
                              filePaths.splice(index, 1); // Remove from filePaths array
                              imageWrapper.remove(); // Remove from UI
                          });

                          imageWrapper.appendChild(img);
                          imageWrapper.appendChild(removeBtn);
                          imagePreviewContainer.appendChild(imageWrapper);
                      });
                  }

                // Display the modal
                editPostModal.style.display = 'flex';
            } else {
                alert('Failed to load post details. Please try again.');
            }
        } catch (error) {
            console.error('Error fetching post details:', error);
            alert('An error occurred while fetching the post details.');
        }
    });
});

// Close Edit Modal
closeEditModalBtn.addEventListener('click', () => {
    editPostModal.style.display = 'none';
});

cancelEditPostBtn.addEventListener('click', () => {
    editPostModal.style.display = 'none';
});
//--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------
// [EDIT] Image upload and preview logic
document.addEventListener('DOMContentLoaded', function () {
    const uploadImages = document.getElementById('uploadEditImages');
    const uploadIcon = document.getElementById('click_edit_icon');
    const imagePreviewContainer = document.getElementById('imageEditPreviewContainer');
    const form = uploadImages.closest('form');

    const maxImages = 5;
    let selectedFiles = [];

    // Simulate clicking the hidden file input
    uploadIcon.addEventListener('click', function () {
        uploadImages.click();
    });

    // Handle file input changes
    uploadImages.addEventListener('change', function () {
        const files = Array.from(this.files);

        if (selectedFiles.length + files.length > maxImages) {
            alert(`You can only upload up to ${maxImages} images.`);
            this.value = '';
            return;
        }

        files.forEach((file) => {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    const imageWrapper = document.createElement('div');
                    imageWrapper.classList.add('image-preview');

                    const image = document.createElement('img');
                    image.src = e.target.result;
                    image.alt = 'Preview';
                    image.style.width = '100px';
                    image.style.height = '100px';
                    image.style.objectFit = 'cover';
                    image.style.borderRadius = '8px';

                    const removeBtn = document.createElement('span');
                    removeBtn.textContent = '×';
                    removeBtn.classList.add('remove-btn');

                    // Remove image on click
                    removeBtn.addEventListener('click', function () {
                        const index = selectedFiles.indexOf(file);
                        if (index !== -1) selectedFiles.splice(index, 1);
                        imageWrapper.remove();
                    });

                    imageWrapper.appendChild(image);
                    imageWrapper.appendChild(removeBtn);
                    imagePreviewContainer.appendChild(imageWrapper);

                    selectedFiles.push(file);
                };

                reader.readAsDataURL(file);
            }
        });

        this.value = '';
    });

    // Handle form submission
    form.addEventListener('submit', function (event) {
            const postText = postTextArea.value.trim();
            const dataTransfer = new DataTransfer();

            if (postText === '' && selectedFiles.length === 0) {
                event.preventDefault();
                alert('Please write something before posting.');
                return;
            }

            selectedFiles.forEach((file) => {
                dataTransfer.items.add(file);
            });

            uploadImages.files = dataTransfer.files;
        });
    });

    //--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------
document.querySelectorAll('.edit-privacy').forEach((button) => {
    button.addEventListener('click', async function () {
        const postId = this.getAttribute('data-post-id');

        try {
            const response = await fetch(`/MessageBoard/UserProfiles/getPostDetails/${postId}`);
            const postDetails = await response.json();

            if (response.ok && postDetails.success) {
                // Set the privacy option in the modal based on current privacy
                const privacyValue = postDetails.data.privacy;

                // Set the radio buttons based on the current privacy
                document.querySelector(`#public`).checked = privacyValue == 2;
                document.querySelector(`#friends`).checked = privacyValue == 3;
                document.querySelector(`#onlyMe`).checked = privacyValue == 1;

                // Show the modal
                document.getElementById('changePrivacyModal').style.display = 'flex';

                // Close the modal when clicking on the close button
                document.getElementById('closePrivacyModal').addEventListener('click', function () {
                    document.getElementById('changePrivacyModal').style.display = 'none';
                });

                // Handle the form submission
                document.getElementById('privacyForm').addEventListener('submit', async (e) => {
                    e.preventDefault();

                    const selectedPrivacy = document.querySelector('input[name="privacy"]:checked').value;

                    const updateResponse = await fetch(`/MessageBoard/UserProfiles/updatePostPrivacy`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            post_id: postId,
                            privacy: selectedPrivacy
                        })
                    });

                    const updateResult = await updateResponse.json();
                    if (updateResult.success) {
                        window.location.reload();
                        document.getElementById('changePrivacyModal').style.display = 'none';
                    } else {
                        alert('Failed to update privacy');
                    }
                });
            } else {
                alert('Failed to load post details.');
            }
        } catch (error) {
            console.error('Error fetching post details:', error);
            alert('An error occurred while fetching the post details.');
        }
    });
});




</script>