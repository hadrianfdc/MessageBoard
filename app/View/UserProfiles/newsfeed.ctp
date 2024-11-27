
<head>
<?php echo $this->Html->css('UserProfiles/newsfeed');  ?>
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="module" src="https://cdn.jsdelivr.net/npm/emoji-picker-element@^1/index.js"></script> <!--Facebook CDN Link -->
  
<button class="icon-button e-dark-mode-button u-animation-click" id="darkMode" aria-label="Dark Mode"><span class="icon" aria-hidden="true">🌜</span></button>
<div class="common-structure">
  <?php echo $this->element('Nav/navbar'); ?>
  <aside class="side-a">
    <section class="common-section">
      <h2 class="section-title u-hide">User Navigation</h2>
      <ul class="common-list">
        <div class="common-list-item">
        <?php if (!empty($user)): ?>
          <a href="/MessageBoard/user-profile" target="_blank" class="common-list-button">
            <span class="icon">
              <?php if (isset($findMyPic['Posts']['path'])): ?>
                <img class="user-image" src="<?php echo $this->Html->url('/' . $findMyPics[0]['Posts']['path']); ?>" height="36" width="36" alt="">
              <?php endif; ?>
            </span>
            <span class="text"><?php echo $users[0]['User']['full_name']; ?></span>
          </a>
        <?php endif; ?>
        </div>
        <div class="common-list-item">
          <a class="common-list-button" href="/MessageBoard/Messages/index">
            <span class="icon" aria-hidden="true">💬</span>
            <span class="text">Messages</span>
          </a>
        </div>
        <div class="common-list-item">
          <a class="common-list-button" href="/MessageBoard/Users/search">
            <span class="icon">👨&zwj;👦&zwj;👦</span>
            <span class="text">Find</span>
          </a>
        </div>
        <div class="common-list-item">
          <a class="common-list-button" href="/MessageBoard/logins/change_password">
            <span class="icon">🏪</span>
            <span class="text">Change Password</span>
          </a>
        </div>
        <div class="common-list-item">
          <a class="common-list-button" href="#" onclick="confirmLogout()">
            <span class="icon">📺</span>
            <span class="text">Logout</span>
          </a>
        </div>
      </ul>

    </section>
  </aside>
  <main class="main-feed">
    <ul class="main-feed-list">
    <?php if (!empty($findPost)): ?>
        <?php foreach ($findPost as $post): ?>
            <div class="main-feed-item">
                <article class="common-post">
                    <header class="common-post-header u-flex">
                        <!-- Display the user's avatar using the dynamic image path -->
                        <?php 
                            $avatarUrl = !empty($post['images']) ? $post['images'][0] : 'https://assets.codepen.io/65740/internal/avatars/users/default.png';
                        ?>
                        <img src="<?php echo $this->Html->url('/' . $avatarUrl); ?>" class="user-image" width="40" height="40" alt="">
                        <div class="common-post-info">
                            <div class="user-and-group u-flex">
                                <a href="#" target="_blank"><?php echo $post['fullname']; ?></a>
                            </div>
                            <div class="time-and-privacy">
                                <!-- Display the created date -->
                                <time datetime="<?php echo $post['created_date']; ?>">
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
                        <button class="icon-button-2 u-margin-inline-start" aria-label="more options">
                            <span class="icon-menu"></span>
                        </button>
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
  function confirmLogout() {
    var result = confirm('Are you sure you want to logout?');
    if (result) {
      $.ajax({
        type: 'POST',
        url: '<?php echo $this->Html->url(array("controller" => "logins", "action" => "logout")); ?>',
        success: function(data) {
          window.location.href = '<?php echo $this->Html->url(array("controller" => "logins", "action" => "login")); ?>';
        }
      });
    }
  }

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


  // Modal functionality
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

</script>