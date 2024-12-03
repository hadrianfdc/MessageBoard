
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
          <?php if ($post['is_shared'] == 1 && !empty($post['shared_id']) && !empty($post['sharer_full_name'])): ?>
            <?php echo $this->element('facebook_share'); ?>
             <!-- If the post is shared-->
             <div class="shared-post">
                    <header class="common-post-header u-flex">
                        <?php 
                            $sharerImage = !empty($post['sharer_images']) ? $post['sharer_images'][0] : 'https://assets.codepen.io/65740/internal/avatars/users/default.png';
                        ?>
                        <img src="<?php echo $this->Html->url('/' . $sharerImage); ?>" class="user-image" width="40" height="40" alt="">
                        <div class="common-post-info">
                            <div class="user-and-group u-flex">
                                <a href="#" target="_blank"><?php echo $post['sharer_full_name']; ?></a>
                            </div>
                            <div class="time-and-privacy">
                                <time datetime="<?php echo $post['created_date']; ?>">
                                    <?php echo date('F j \a\t g:i A', strtotime($post['date_shared'])); ?>
                                </time>
                                <span class="icon icon-privacy">
                                    <?php 
                                        if ($post['privacy'] == 1) {
                                            echo '🔒 Only Me';
                                        } elseif ($post['privacy'] == 2) {
                                            echo '🌎 Public';
                                        } elseif ($post['privacy'] == 3) {
                                            echo '👥 Friends';
                                        }
                                    ?>
                                </span>
                            </div>
                        </div>
                        <!-- Dropdown Menu of Post -->
                        <button class="icon-button-2 u-margin-inline-start" aria-label="more options" onclick="toggleCustomDropdown(event, '<?php echo $post['id']; ?>')">
                            <span class="icon-menu"></span>
                        </button>
                         <!-- Dropdown menu -->
                         <div id="custom-dropdown-menu-<?php echo $post['id']; ?>" class="custom-dropdown-menu">
                            <ul>
                              <?php if($user_id == $post['user_id'] || $user_id == $post['sharer_id']): ?>
                                <li><span class="icon">🔖</span>
                                  <?php if ($post['is_saved'] == 1): ?> Unsave Post
                                  <?php else: ?> Save Post
                                  <?php endif; ?>
                                </li>
                                <li class="edit-post" data-post-id="<?php echo $post['id']; ?>" data-is-shared="1">
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
                                <?php else: ?>
                                  <li>
                                    <span class="icon" style="
                                        display: inline-block; width: 24px; 
                                        height: 24px; line-height: 24px; 
                                        border-radius: 50%; background-color: #1877f2; 
                                        color: white; text-align: center; 
                                        font-size: 18px; font-weight: bold;
                                    ">+</span> Interested
                                </li>
                                <li>
                                    <span class="icon" style="
                                        display: inline-block; width: 24px; 
                                        height: 24px; line-height: 24px; 
                                        border-radius: 50%; background-color: #f02849; 
                                        color: white; text-align: center; 
                                        font-size: 18px; font-weight: bold;
                                    ">−</span> Not Interested
                                </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </header>
                    <div class="common-post-content common-content">
                        <?php 
                        $caption = $post['sharer_caption']; 
                        $postId = $post['id']; 
                        if (strlen($caption) > 100) {
                            $truncatedCaption = substr($caption, 0, 100);
                            echo '<p id="truncated-caption-' . $postId . '">' . h($truncatedCaption) . '... 
                                    <a href="#" class="see-more" onclick="toggleCaption(' . $postId . '); return false;" style="font-size: 14px;">See more</a>
                                  </p>';
                            echo '<p id="full-caption-' . $postId . '" style="display: none;">' . h($caption) . ' 
                                    <a href="#" class="see-less" onclick="toggleCaption(' . $postId . '); return false;" style="font-size: 14px;">See less</a>
                                  </p>';
                        } else {
                            echo '<p>' . h($caption) . '</p>';
                        }
                        ?>
                    </div> <?php if ($post['sharer_caption'] != NULL || !empty($post['sharer_caption'])): ?> <br> <?php endif; ?>
                    <div class="main-feed-item shared-facebook-post">
                        <article class="common-post" style="border: 1px solid #ccc;">
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
                                        <time datetime="<?php echo $post['created_date']; ?>">
                                            <?php echo date('F j \a\t g:i A', strtotime($post['created_date'])); ?>
                                        </time>
                                        <span class="icon icon-privacy">
                                            <?php 
                                                if ($post['original_privacy'] == 1) {
                                                    echo '🔒 Only Me';
                                                } elseif ($post['original_privacy'] == 2) {
                                                    echo '🌎 Public';
                                                } elseif ($post['original_privacy'] == 3) {
                                                    echo '👥 Friends';
                                                }
                                            ?>
                                        </span>
                                    </div>
                                </div>
                            </header>
                            <div class="common-post-content common-content">
                                <?php 
                                $caption = $post['captions']; 
                                $postId = $post['id']; 
                                if (strlen($caption) > 100) {
                                    $truncatedCaption = substr($caption, 0, 100);
                                    echo '<p id="truncated-caption-' . $postId . '">' . h($truncatedCaption) . '... 
                                            <a href="#" class="see-more" onclick="toggleCaption(' . $postId . '); return false;" style="font-size: 14px;">See more</a>
                                          </p>';
                                    echo '<p id="full-caption-' . $postId . '" style="display: none;">' . h($caption) . ' 
                                            <a href="#" class="see-less" onclick="toggleCaption(' . $postId . '); return false;" style="font-size: 14px;">See less</a>
                                          </p>';
                                } else {
                                    echo '<p>' . h($caption) . '</p>';
                                }
                                ?>
                            </div>
                            <?php if (!empty($post['file_paths'])): ?>
                                <div class="image-grid">
                                    <?php foreach ($post['file_paths'] as $index => $image): ?>
                                        <div class="image-item">
                                            <img src="<?php echo $this->Html->url('/' . $image); ?>" alt="Post Image" class="image">
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <br>
                            <?php endif; ?>
                            <div class="summary u-flex">
                                <div class="reactions">
                                <?php
                                    // Decode the JSON data
                                    $reactions = json_decode($post['react'], true);
                                    $totalReactions = array_sum($reactions);
                                    // Check and display icons based on the values
                                    if ($reactions['Like'] > 0) {
                                      echo '<i class="fas fa-thumbs-up" style="color: blue;"></i>';
                                    }
                                    if ($reactions['Love'] > 0) {
                                      echo '<i class="fas fa-heart" style="color: red;"></i>';
                                    }
                                    if ($reactions['Care'] > 0) {
                                        echo '<i class="care-icon">🤗</i>';
                                    }
                                    if ($reactions['Haha'] > 0) {
                                        echo '<i class="fas fa-laugh" style="color: #f4d03f;"></i>';
                                    }
                                    if ($reactions['Wow'] > 0) {
                                        echo '<i class="fas fa-surprise" style="color: #f39c12;"></i>';
                                    }
                                    if ($reactions['Sad'] > 0) {
                                        echo '<i class="fas fa-sad-tear" style="color: #3498db;"></i>';
                                    }
                                    if ($reactions['Angry'] > 0) {
                                        echo '<i class="fas fa-angry" style="color: #e74c3c;"></i>';
                                    }
                                ?>
                                </div>
                                <div class="reactions-total">
                                <?php 
                                  if ($totalReactions > 1 ) { 
                                      echo '<span class="text">' . 
                                          htmlspecialchars($post['recent_reactor']) . 
                                          ' reacted ' . 
                                          htmlspecialchars($post['other_reaction']) . 
                                          ' and ' . 
                                          ($totalReactions - 1) . 
                                          ' others </span>';
                                  }if($totalReactions == 1){
                                      echo $totalReactions; 
                                  }
                                  ?>
                                </div>
                                <div class="total-comments u-margin-inline-start">
                                  <a> <?php echo $post['total_number_of_shared_post']; ?> Shares</a>
                                </div>
                            </div>
                        </article>
                        <section class="actions-buttons">
                                <ul class="actions-buttons-list u-flex">
                                    <li style="list-style-type: none;" class="actions-buttons-item">
                                        <button class="actions-buttons-button toggle-reactions" data-post-id="<?php echo $post['id']; ?>">
                                            <span class="icon"><i class="fas fa-thumbs-up" style="font-weight:normal;"></i> Like</span>
                                        </button>
                                    </li>
                                    <li style="list-style-type: none;" class="actions-buttons-item">
                                        <button class="actions-buttons-button">
                                            <span class="icon">💬</span>
                                            <span class="text">Comment</span>
                                        </button>
                                    </li>
                                    <li style="list-style-type: none;" class="actions-buttons-item">
                                        <button data-post-id="<?php echo $post['id']; ?>" class="actions-buttons-button share-button">
                                            <span class="icon">🔗</span>
                                            <span class="text">Share</span>
                                        </button>
                                    </li>
                                </ul>
                            </section>
                    </div>
                </div>

          <?php else: ?>
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
                        <?php 
                        $caption = $post['captions']; 
                        $postId = $post['id']; 
                        if (strlen($caption) > 100) {
                            $truncatedCaption = substr($caption, 0, 100);
                            echo '<p id="truncated-caption-' . $postId . '">' . h($truncatedCaption) . '... 
                                    <a href="#" class="see-more" onclick="toggleCaption(' . $postId . '); return false;" style="font-size: 14px;">See more</a>
                                  </p>';
                            echo '<p id="full-caption-' . $postId . '" style="display: none;">' . h($caption) . ' 
                                    <a href="#" class="see-less" onclick="toggleCaption(' . $postId . '); return false;" style="font-size: 14px;">See less</a>
                                  </p>';
                        } else {
                            echo '<p>' . h($caption) . '</p>';
                        }
                        ?>
                    </div>
                    <?php if (!empty($post['file_paths'])): ?>
                        <div class="image-grid">
                            <?php foreach ($post['file_paths'] as $index => $image): ?>
                                <div class="image-item">
                                    <img src="<?php echo $this->Html->url('/' . $image); ?>" alt="Post Image" class="image">
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <br>
                    <?php endif; ?>
                    <div class="summary u-flex">
                    <div class="reactions">
                    <?php
                            // Decode the JSON data
                            $reactions = json_decode($post['react'], true);
                            $totalReactions = array_sum($reactions);
                            // Check and display icons based on the values
                            if ($reactions['Like'] > 0) {
                              echo '<i class="fas fa-thumbs-up" style="color: blue;"></i>';
                            }
                            if ($reactions['Love'] > 0) {
                              echo '<i class="fas fa-heart" style="color: red;"></i>'; // Heart icon in red
                            }
                            if ($reactions['Care'] > 0) {
                                echo '<i class="care-icon">🤗</i>'; // Care icon
                            }
                            if ($reactions['Haha'] > 0) {
                                echo '<i class="fas fa-laugh" style="color: #f4d03f;"></i>'; // Haha icon in yellow
                            }
                            if ($reactions['Wow'] > 0) {
                                echo '<i class="fas fa-surprise" style="color: #f39c12;"></i>'; // Wow icon in orange
                            }
                            if ($reactions['Sad'] > 0) {
                                echo '<i class="fas fa-sad-tear" style="color: #3498db;"></i>'; // Sad icon in blue
                            }
                            if ($reactions['Angry'] > 0) {
                                echo '<i class="fas fa-angry" style="color: #e74c3c;"></i>'; // Angry icon in red
                            }
                            ?>
                        </div>
                        <div class="reactions-total">
                        <?php 
                            if ($totalReactions > 1) { 
                              echo '
                                      <span style="text-decoration: none; cursor: pointer;" data-post-id="' . $post['id'] . '" class="showReactionsModal" class="text">' . 
                                          htmlspecialchars($post['recent_reactor']) . 
                                          ' reacted ' . 
                                          htmlspecialchars($post['other_reaction']) . 
                                          ' and ' . 
                                          ($totalReactions - 1) . 
                                          ' others </span> ';
                            }if($totalReactions == 1){
                                echo $totalReactions; 
                            }
                          ?>
                        </div>
                    </div>
                    <section class="actions-buttons">
                      <ul class="actions-buttons-list u-flex">
                        <li style="list-style-type: none; position: relative;" class="actions-buttons-item">
                          <button class="actions-buttons-button toggle-reactions" data-post-id="<?php echo $post['id']; ?>">
                          <?php 
                            if ($post['my_reaction'] == 1){
                              echo '<span class="icon" style="filter: none;"><i class="fas fa-thumbs-up" style="color: blue;"></i> Like</span>';
                            }elseif($post['my_reaction'] == 2){
                              echo '<span class="icon" style="filter: none;"><i class="fas fa-heart" style="color: red;"></i> Love </span>';
                            }elseif($post['my_reaction'] == 3){
                              echo '<span class="icon" style="filter: none;">🤗 Care </span>';
                            }elseif($post['my_reaction'] == 4){
                              echo '<span class="icon" style="filter: none;"><i class="fas fa-laugh" style="color: #f4d03f;"></i> Haha </span>';
                            }elseif($post['my_reaction'] == 5){
                              echo '<span class="icon" style="filter: none;"><i class="fas fa-surprise" style="color: #f39c12;"></i> Wow</span>';
                            }elseif($post['my_reaction'] == 6){
                              echo '<span class="icon" style="filter: none;"><i class="fas fa-sad-tear" style="color: #3498db;"></i> Sad</span>';
                            }elseif($post['my_reaction'] == 7){
                              echo '<span class="icon" style="filter: none;"><i class="fas fa-angry" style="color: #e74c3c;"></i> Angry</span>';
                            }else{
                              echo '<span class="icon"><i class="far fa-thumbs-up"></i> Like </span>';
                            }
                            ?>
                          </button>
                          <!-- Reactions Pop-up -->
                          <div class="reactions-popup" id="reactions-popup-<?php echo $post['id']; ?>">
                              <button data-post-id="<?php echo $post['id']; ?>" data-user-id="<?php echo $post['reactor']; ?>" data-reaction="1" class="reaction-item">👍</button>
                              <button data-post-id="<?php echo $post['id']; ?>" data-user-id="<?php echo $post['reactor']; ?>" data-reaction="2" class="reaction-item">❤️</button>
                              <button data-post-id="<?php echo $post['id']; ?>" data-user-id="<?php echo $post['reactor']; ?>" data-reaction="3" class="reaction-item">🤗</button>
                              <button data-post-id="<?php echo $post['id']; ?>" data-user-id="<?php echo $post['reactor']; ?>" data-reaction="4" class="reaction-item">😂</button>
                              <button data-post-id="<?php echo $post['id']; ?>" data-user-id="<?php echo $post['reactor']; ?>" data-reaction="5" class="reaction-item">😮</button>
                              <button data-post-id="<?php echo $post['id']; ?>" data-user-id="<?php echo $post['reactor']; ?>" data-reaction="6" class="reaction-item">😢</button>
                              <button data-post-id="<?php echo $post['id']; ?>" data-user-id="<?php echo $post['reactor']; ?>" data-reaction="7" class="reaction-item">😡</button>
                          </div>
                        </li>
                        <li style="list-style-type: none;" class="actions-buttons-item">
                          <button class="actions-buttons-button">
                            <span class="icon">💬</span>
                            <span class="text">Comment</span>
                          </button>
                        </li>
                        <li style="list-style-type: none;" class="actions-buttons-item">
                          <button data-post-idgfdgdfg="<?php echo $post['id']; ?>" class="actions-buttons-button share-button">
                            <span class="icon">🔗</span>
                            <span class="text">Share</span>
                          </button>
                        </li>
                      </ul>
                    </section>
                </article>
            </div>
            <!--------------------------------------- [START] Modal for Share Modal ----------------------------------------->
            <!-- Share Modal for each post -->
            <div id="share-modal-<?php echo $post['id']; ?>" class="share-modal">
                <div class="share-modal-content">
                    <button class="close-modal" id="close-modal-<?php echo $post['id']; ?>">&times;</button>
                    <h2>Share this Post</h2>
                    <ul class="share-options">
                        <li><button data-post-id="<?php echo $post['id']; ?>" class="share-option"><i class="fas fa-edit"></i> Share to Facebook</button></li>
                        <li><button data-post-id="<?php echo $post['id']; ?>" class="share-option"><i class="fas fa-camera-retro"></i> Share to your story now</button></li>
                        <li><button data-post-id="<?php echo $post['id']; ?>" class="share-option"><i class="fas fa-user-friends"></i> Share to a friend's profile</button></li>
                        <li><button data-post-id="<?php echo $post['id']; ?>" class="share-option"><i class="fas fa-users"></i> Share in a Group</button></li>
                        <li><button data-post-id="<?php echo $post['id']; ?>" class="share-option"><i class="fas fa-envelope"></i> Share as Message</button></li>
                        <li><button data-post-id="<?php echo $post['id']; ?>" class="share-option"><i class="fas fa-link"></i> Copy Link</button></li>
                    </ul>
                </div>
            </div>
            <!--------------------------------------- [END] Modal for Share Modal ----------------------------------------->
            <?php endif; ?>
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

</script>