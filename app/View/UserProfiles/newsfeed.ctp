
<head>
<?php echo $this->Html->css('UserProfiles/newsfeed'); 
  echo $this->Html->css('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css'); //Boostrap for navigation bar
?>

</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="module" src="https://cdn.jsdelivr.net/npm/emoji-picker-element@^1/index.js"></script> <!--Facebook CDN Link -->
  
<?php
function timeAgo($timestamp) {

    $timeDifference = time() - $timestamp;

    if ($timeDifference < 60) {
        return $timeDifference . ' seconds ago';
    } elseif ($timeDifference < 3600) {
        $minutes = floor($timeDifference / 60);
        return $minutes . ' minute' . ($minutes > 1 ? 's' : '') . ' ago';
    } elseif ($timeDifference < 86400) {
        $hours = floor($timeDifference / 3600);
        return $hours . ' hour' . ($hours > 1 ? 's' : '') . ' ago';
    } elseif ($timeDifference < 604800) { // Less than 7 days
        $days = floor($timeDifference / 86400);
        return $days . ' day' . ($days > 1 ? 's' : '') . ' ago';
    } else {
        // Return the original date for anything older than 7 days
        return date('F j \a\t g:i A', $timestamp); 
    }
}
?>



<button class="icon-button e-dark-mode-button u-animation-click" post-data-id="<?php echo $user['User']['user_id']; ?>" id="darkMode" aria-label="Dark Mode">
    <span class="icon" aria-hidden="true"> <i class="fas fa-moon"></i></span>
</button>



<div class="common-structure">
  <?php echo $this->element('Nav/navbar'); ?>
  <aside class="side-a">
    <section class="common-section">
      <h2 class="section-title u-hide">User Navigation</h2>
      <ul class="common-list">
        <div class="common-list-item">
            <?php if (!empty($user)): ?>
            <a href="/MessageBoard/user-profile" class="common-list-button">
                <span class="icon">
                    <?php if (isset($findMyPic['Posts']['path'])): ?>
                        <img class="user-image" src="<?php echo $this->Html->url('/' . $findMyPics[0]['Posts']['path']); ?>" height="36" width="36" alt="">
                    <?php endif; ?>
                </span>
                <span class="text"><?php echo $users[0]['User']['full_name']; ?></span>
                <?php if ($users[0]['User']['is_online'] == 1): ?>
                    <span style="width: 9px; height: 9px; background-color: #4CAF50; border-radius: 50%; display: inline-block;"></span>
                <?php endif; ?>
            </a>
            <?php endif; ?>
        </div>
        <div class="common-list-item">
            <a class="common-list-button" href="/MessageBoard/Messages/index">
                <span class="icon" style="color: #1877f2;"><i class="fas fa-envelope"></i></span>
                <span class="text">Messages</span>
            </a>
        </div>
        <div class="common-list-item">
            <a class="common-list-button" href="/MessageBoard/Users/search">
                <span class="icon" style="color: #1877f2;"><i class="fas fa-users"></i></span>
                <span class="text">Find</span>
            </a>
        </div>
        <div class="common-list-item">
            <a class="common-list-button" href="#">
                <span class="icon" style="color: #1877f2;"><i class="fas fa-key"></i></span>
                <span class="text">Contact</span>
            </a>
        </div>
        <div class="common-list-item">
            <a class="common-list-button" href="#">
                <span class="icon" style="color: #1877f2;"><i class="fas fa-tv"></i></span>
                <span class="text">Watch</span>
            </a>
        </div>
        <div class="common-list-item">
            <a class="common-list-button" href="#">
                <span class="icon" style="color: #1877f2;"><i class="fas fa-calendar-alt"></i></span>
                <span class="text">Events</span>
            </a>
        </div>
        <div class="common-list-item">
            <a class="common-list-button" href="#">
                <span class="icon" style="color: #1877f2;"><i class="fas fa-bookmark"></i></span>
                <span class="text">Saved</span>
            </a>
        </div>
        <div class="common-list-item">
            <a class="common-list-button" href="#">
                <span class="icon" style="color: #1877f2;"><i class="fas fa-flag"></i></span>
                <span class="text">Pages</span>
            </a>
        </div>
        <div class="common-list-item">
            <a class="common-list-button" href="/MessageBoard/setting">
                <span class="icon" style="color: #1877f2;"><i class="fas fa-cog"></i></span>
                <span class="text">Settings & Privacy</span>
            </a>
        </div>
        <div class="common-list-item">
            <a class="common-list-button">
                <span class="icon" style="background: linear-gradient(90deg, #1877f2, #ff00ff, #00ff00); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"><i class="fas fa-th"></i></span>
                <span class="text" style="flex-grow: 1; text-align: left;">See More</span>
                <span class="icon" style="color: #1877f2;"><i class="fas fa-chevron-down"></i></span>
            </a>
        </div>
    </ul>
    </section>
  </aside>
  <main class="main-feed">
    <ul class="main-feed-list">

    <div class="my-story-section" style="position: relative; overflow: hidden; margin-top: 20px;">
        <div class="story-carousel" style="display: flex; transition: transform 0.5s ease; width: calc(130px * 6 + 15px * 5);">
            <!-- Add Story Item -->
            <div class="story-item" style="position: relative; width: 120px; height: 180px; margin-right: 15px; border-radius: 12px; overflow: hidden; background-color: #f0f0f0; cursor: pointer; transition: transform 0.3s ease; display: flex; flex-direction: column; align-items: center; justify-content: center;" onclick="openAddStoryModal()">
                <div style="position: relative; width: 60px; height: 60px; margin-bottom: 10px;">
                    <img src="<?php echo $this->Html->url('/' . $findMyPic['Posts']['path']); ?>" alt="Add Story" style="width: 100%; height: 100%; border-radius: 50%; border: 3px solid #1877f2; object-fit: cover; background-color: white;"/>
                    <div style="position: absolute; bottom: -5px; right: -5px; width: 20px; height: 20px; border-radius: 50%; background-color: #1877f2; display: flex; align-items: center; justify-content: center;">
                        <span style="font-size: 16px; font-weight: bold; color: white;">+</span>
                    </div>
                </div>
                <!-- Add Story Label -->
                <span style="font-size: 12px; font-weight: bold; color: #555;">Add Story</span>
            </div>

            <!-- Existing Stories -->
            <?php foreach ($organizedMyDaysPost as $story): ?>
            <div class="story-item" style="position: relative; width: 130px; height: 180px; margin-right: 15px; border-radius: 12px; overflow: hidden; border: 2px solid #ccc; background-color: #f0f0f0; cursor: pointer; transition: transform 0.3s ease;">
            <img src="<?php echo $this->Html->url('/' . $story['image_story']); ?>" alt="Story Image" style="width: 100%; height: 100%; object-fit: cover;" onclick="openModal('<?php echo $this->Html->url('/' . $story['image_story']); ?>', '<?php echo $this->Html->url('/' . $story['profile_picture']); ?>', '<?php echo $story['full_name']; ?>', '<?php echo $story['date_created']; ?>')" />
                
                <!-- User info overlay -->
                <div class="story-overlay" style="position: absolute; top: 1px; padding: 5px; text-align: center; border-radius: 5px;">
                    <div style="display: flex; ">
                        <img src="<?php echo $this->Html->url('/' . $story['profile_picture']); ?>" alt="Profile Image" style="width: 35px; height: 35px; border-radius: 50%; border: 3px solid #1877f2;"/>
                    </div>
                </div>

                <!-- User Full Name -->
                <div class="story-fullname" style="position: absolute; bottom: 10px; left: 10px; color: white; font-size: 10px; font-weight: bold;">
                    <?php echo $story['full_name']; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Prev and Next buttons -->
        <button class="prev-btn" onclick="moveCarousel('prev')" style="position: absolute; top: 50%; left: 10px; background-color: rgba(0, 0, 0, 0.5); color: white; padding: 12px; border: none; border-radius: 50%; cursor: pointer; z-index: 1;">&lt;</button>
        <button class="next-btn" onclick="moveCarousel('next')" style="position: absolute; top: 50%; right: 10px; background-color: rgba(0, 0, 0, 0.5); color: white; padding: 12px; border: none; border-radius: 50%; cursor: pointer; z-index: 1;">&gt;</button>
    </div>

    <!-- Modal for Image -->
    <div id="imageModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.9); z-index: 1000; justify-content: center; align-items: center; padding: 20px;">
        <div style="position: relative; background-color: transparent; width: 100%; max-width: 700px; height: 100%; display: flex; flex-direction: column; justify-content: center; align-items: center;">
            <!-- Progress Bar -->
            <div style="position: absolute; top: 20px; width: 100%; height: 5px; background-color: rgba(255, 255, 255, 0.3); border-radius: 10px;">
                <div id="progressBar" style="height: 100%; width: 0%; background-color: #1877f2; border-radius: 10px;"></div>
            </div>
            <div style="position: absolute; top: 35px; left: 20px; display: flex; align-items: center; z-index: 2;">
                <img id="modalProfilePicture" src="" alt="Profile Picture" style="width: 40px; height: 40px; border-radius: 50%; border: 3px solid #1877f2; margin-right: 10px;"/>
                <span id="modalFullName" style="font-size: 18px; font-weight: bold; color: white;"></span>
                <span id="dateCreated" style="font-size: 12px; margin-left: 20px; color: white;"></span>
            </div>
            <!-- Image -->
            <div style="position: relative; text-align: center; width: 100%; height: 100%; display: flex; justify-content: center; align-items: center;">
                <img id="modalImage" src="" alt="Story Image" style="max-width: 100%; max-height: 80%; border-radius: 10px;"/>
            </div>
            <!-- Close Button -->
            <button onclick="closeModal()" style="position: absolute; top: 20px; right: 10px; color: white; border: none; padding: 15px; border-radius: 50%; cursor: pointer; font-size: 24px;">×</button>
            <!-- Countdown Timer -->
            <div id="timerText" style="position: absolute; bottom: 20px; text-align: center; font-size: 14px; color: white; font-weight: bold;">
                <span id="countdown"></span> 
            </div>
        </div>
    </div>



    <div class="m-mrg" id="composer" style="width: 100%; max-width: 600px; margin: 20px auto; padding: 15px; background-color: #fff; border-radius: 8px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
          <div id="c-tabs-cvr" style="border-bottom: 1px solid #ddd; margin-bottom: 10px;">
              <div class="tb" id="c-tabs" style="display: flex; justify-content: space-between; padding: 10px 0;">
                  <div id="makePost" class="td active" style="display: flex; align-items: center; cursor: pointer; font-size: 14px; color: #1c1e21; font-weight: bold; padding: 5px 15px; border-bottom: 2px solid #4267b2;">
                      <i class="fas fa-pencil-alt" style="font-size: 20px; margin-right: 5px;"></i><span>Make Post</span>
                  </div>
                  <div class="td" style="display: flex; align-items: center; cursor: pointer; font-size: 14px; padding: 5px 15px;">
                      <i class="fas fa-camera" style="font-size: 20px; margin-right: 5px; color:green;"></i><span>Photo/Video</span>
                  </div>
                  <div class="td" style="display: flex; align-items: center; cursor: pointer; font-size: 14px; padding: 5px 15px;">
                      <i class="fas fa-video" style="font-size: 20px; margin-right: 5px; color:red;"></i><span>Live Video</span>
                  </div>
                  <div class="td" style="display: flex; align-items: center; cursor: pointer; font-size: 14px; padding: 5px 15px;">
                      <i class="fas fa-calendar-alt" style="font-size: 20px; margin-right: 5px; color:orange;"></i><span>Life Event</span>
                  </div>
              </div>
          </div>
          <div id="c-c-main" style="display: flex; align-items: center; padding: 10px 0;">
              <div class="tb" style="display: flex; width: 100%; align-items: center;">
                  <div class="td" id="p-c-i" style="width: 40px; height: 40px; margin-right: 15px; border-radius: 50%; overflow: hidden;">
                      <img src="<?php echo $this->Html->url('/' . $findMyPic['Posts']['path']); ?>" alt="Profile pic" style="width: 100%; height: 100%; object-fit: cover;">
                  </div>
                  <div class="td" id="c-inp" style="flex-grow: 1;">
                      <input type="text" id="whats-on-your-mind" placeholder="What's on your mind?" style="width: 100%; padding: 10px 15px; border-radius: 18px; border: 1px solid #ddd; font-size: 14px; outline: none;">
                  </div>
              </div>
          </div>
    </div>




    <?php if (!empty($findPost)): ?>
        <?php foreach ($findPost as $post): ?>
          <?php if ($post['is_shared'] == 1 && !empty($post['shared_id']) && !empty($post['sharer_full_name'])): ?>
            <?php echo $this->element('facebook_share'); ?>
             <!-- If the post is shared, wrap it inside a new div with a Facebook-style shared post -->
             <div class="shared-post">
                    <header class="common-post-header u-flex">
                        <?php 
                            $sharerImage = !empty($post['sharer_images']) ? $post['sharer_images'][0] : 'https://assets.codepen.io/65740/internal/avatars/users/default.png';
                        ?>
                        <img src="<?php echo $this->Html->url('/' . $sharerImage); ?>" class="user-image" width="40" height="40" alt="">
                        <div class="common-post-info">
                            <div class="user-and-group u-flex">
                                <?php if($post['sharer_id'] == $user_id): ?>
                                    <a href="/MessageBoard/user-profile"><?php echo $post['sharer_full_name']; ?></a>
                                <?php else: ?>
                                    <a href="/MessageBoard/user-profiles-of/<?php echo $post['sharer_id']; ?>"><?php echo $post['sharer_full_name']; ?></a>
                                <?php endif; ?>
                            </div>
                            <div class="time-and-privacy">
                                <?php if ($post['is_online'] == 1 && $post['sharer_id'] == $user_id): ?>
                                    <span style="width: 9px; height: 9px; background-color: #4CAF50; border-radius: 50%; display: inline-block;"></span>
                                <?php endif; ?>   
                                <time datetime="<?php echo $post['created_date']; ?>">
                                    <?php echo timeAgo(strtotime($post['date_shared'])); ?>
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
                                        <a href="/MessageBoard/user-profiles-of/<?php echo $post['user_id']; ?>"><?php echo $post['fullname']; ?></a>
                                    </div>
                                    <div class="time-and-privacy">
                                        <time datetime="<?php echo $post['created_date']; ?>">
                                            <?php echo timeAgo(strtotime($post['created_date'])); ?>
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
                                          echo '<a> <span class="text">' . 
                                              htmlspecialchars($post['recent_reactor']) . 
                                              ' reacted ' . 
                                              htmlspecialchars($post['other_reaction']) . 
                                              ' and ' . 
                                              ($totalReactions - 1) . 
                                              ' others </span> </a>';
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
                    </div>
                    <section class="actions-buttons">
                        <ul class="actions-buttons-list u-flex">
                            <li style="list-style-type: none;" class="actions-buttons-item">
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
                              <button class="actions-buttons-button comment-button" data-post-id="<?php echo $post['id']; ?>">
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

          <?php else: ?>

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
                                <?php if($post['user_id'] == $user_id): ?>
                                    <a href="/MessageBoard/user-profile"><?php echo $post['fullname']; ?></a>
                                <?php else: ?>
                                    <a href="/MessageBoard/user-profiles-of/<?php echo $post['user_id']; ?>"><?php echo $post['fullname']; ?></a>
                                <?php endif; ?>
                            </div>
                            <div class="time-and-privacy"> 
                                <?php if ($post['is_online'] == 1): ?>
                                    <span style="width: 9px; height: 9px; background-color: #4CAF50; border-radius: 50%; display: inline-block;"></span>
                                <?php endif; ?>                  
                                <!-- Display the created date -->
                                <time datetime="<?php echo $post['created_date']; ?>" style="content: none;">
                                    <?php echo timeAgo(strtotime($post['created_date'])); ?>
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
                              <?php if($user_id == $post['user_id']): ?>
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
                              echo '<a href="javascript:void(0)" data-post-id="' . $post['id'] . '" class="showReactionsModal"> 
                                      <span class="text">' . 
                                          htmlspecialchars($post['recent_reactor']) . 
                                          ' reacted ' . 
                                          htmlspecialchars($post['other_reaction']) . 
                                          ' and ' . 
                                          ($totalReactions - 1) . 
                                          ' others </span> 
                                    </a>';
                            }if($totalReactions == 1){
                                echo $totalReactions; 
                            }
                          ?>
                        </div>
                         <!-- ---------- This line is for shared post ----------------- -->
                        <div class="total-comments u-margin-inline-start">
                            <a href="#" class="view-shares" 
                              data-post-id="<?php echo $post['id']; ?>" 
                              data-post-title="<?php echo htmlspecialchars($post['captions'], ENT_QUOTES, 'UTF-8'); ?>">
                                <?php echo $post['total_number_of_shared_post']; ?> Shares
                            </a>
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
                          <button class="actions-buttons-button comment-button" data-post-id="<?php echo $post['id']; ?>">
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
        <h2 class="section-title" style="font-size: 18px; font-weight: bold; color: #333; margin-bottom: 20px;">Friend List</h2>
        
        <!-- Friend List -->
        <ul class="common-list" style="list-style-type: none; padding: 0;">
            <?php foreach ($friendsData as $friend): ?>
            <li class="common-list-item" style="display: flex; align-items: center; padding: 10px; border-bottom: 1px solid #e0e0e0; margin-bottom: 10px;">
                <div class="friend-avatar" style="width: 40px; height: 40px; border-radius: 50%; overflow: hidden; margin-right: 10px;">
                   <a href="/MessageBoard/user-profiles-of/<?php echo $friend['user_id']; ?>"> 
                      <img src="<?php echo $this->Html->url('/' . $friend['profile_picture']); ?>" alt="Friend Avatar" style="width: 100%; height: 100%; object-fit: cover;">
                   </a>
                </div>
                <div class="friend-info" style="flex-grow: 1;">
                <a href="/MessageBoard/user-profiles-of/<?php echo $friend['user_id']; ?>" style="font-size: 14px; margin: 0; font-weight: bold; color: #333;"><?php echo $friend['full_name']; ?></a>
                  <?php if ($friend['is_online'] == 1): ?>
                      <p style="font-size: 12px; color: #777; display: flex; align-items: center; margin: 0;">
                          <span style="width: 8px; height: 8px; background-color: #4CAF50; border-radius: 50%; margin-right: 5px; display: inline-block;"></span>
                          Online
                      </p>
                  <?php else: ?>
                      <p style="font-size: 12px; color: #777; display: flex; align-items: center; margin: 0;">
                          <span style="width: 8px; height: 8px; background-color: #9e9e9e; border-radius: 50%; margin-right: 5px; display: inline-block;"></span>
                          Offline
                      </p>
                  <?php endif; ?>
                </div>
            </li>
            <?php endforeach; ?>
        </ul>
        
        <!-- See More Button -->
        <button class="common-more" id="seeMoreBtn" style="background-color: #1877f2; color: white; font-size: 14px; padding: 8px 15px; border: none; border-radius: 5px; width: 100%; cursor: pointer; display: flex; justify-content: center; align-items: center;">
            <span class="text" style="margin-right: 8px;">See More</span>
            <span class="fas fa-arrow-down" style="font-size: 14px; color: white;"></span>
        </button>
      </section>
    </aside>

</div>
<?php echo $this->element('Actions/modal_search_friend'); ?>
<?php echo $this->element('modal_edit_profile'); ?>

<script>


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
  const makePost = document.getElementById('makePost');
  const whatsOnYourMind = document.getElementById('whats-on-your-mind');
  const closeModalBtn = document.getElementById('closeModalBtn');
  const createPostModal = document.getElementById('createPostModal');
  const cancelPostBtn = document.getElementById('cancelPostBtn');

  // Open Modal
  openModalBtn.addEventListener('click', () => {
      createPostModal.style.display = 'flex';
  });
   // Open Modal
  makePost.addEventListener('click', () => {
      createPostModal.style.display = 'flex';
  });
  // Open Modal
  whatsOnYourMind.addEventListener('click', () => {
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
//--------------------------------------------------------------------------------------------------//--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------

////// FOR STORY AND MY DAYS

let currentIndex = 0;

function moveCarousel(direction) {
    const carousel = document.querySelector('.story-carousel');
    const stories = document.querySelectorAll('.story-item');
    const totalStories = stories.length;
    const storyWidth = 120; 
    const storyMargin = 15; 
    const itemWidthWithMargin = storyWidth + storyMargin;

    if (direction === 'next') {
        currentIndex = (currentIndex + 1) % totalStories;
    } else {
        currentIndex = (currentIndex - 1 + totalStories) % totalStories;
    }


    const newTransformValue = -(currentIndex * itemWidthWithMargin); 
    carousel.style.transform = `translateX(${newTransformValue}px)`;
}


const storyItems = document.querySelectorAll('.story-item');
storyItems.forEach(item => {
    item.addEventListener('mouseenter', () => {
        item.style.transform = 'scale(1.05)';
    });
    item.addEventListener('mouseleave', () => {
        item.style.transform = 'scale(1)';
    });
});



</script>