
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