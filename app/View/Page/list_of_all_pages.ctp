
<head>
<?php echo $this->Html->css('UserProfiles/newsfeed'); 
  echo $this->Html->css('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css'); //Boostrap for navigation bar
?>

</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="module" src="https://cdn.jsdelivr.net/npm/emoji-picker-element@^1/index.js"></script> <!--Facebook CDN Link -->



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
            <a class="common-list-button" href="/MessageBoard/events">
                <span class="icon" style="color: purple;"><i class="fas fa-calendar-alt"></i></span>
                <span class="text">Events</span>
            </a>
        </div>
        <div class="common-list-item">
            <a class="common-list-button" href="#">
                <span class="icon" style="color: violet;"><i class="fas fa-bookmark"></i></span>
                <span class="text">Saved</span>
            </a>
        </div>
        <div class="common-list-item">
            <a class="common-list-button" href="#">
                <span class="icon" style="color: darkblue;"><i class="fas fa-gamepad"></i></span>
                <span class="text">Gaming</span>
            </a>
        </div>
        <div class="common-list-item">
            <a class="common-list-button" href="/MessageBoard/list_of_page">
                <span class="icon" style="color: #1877f2;"><i class="fas fa-flag"></i></span>
                <span class="text">Pages</span>
            </a>
        </div>
        <div class="common-list-item">
            <a class="common-list-button" href="/MessageBoard/setting">
                <span class="icon" style="color: grey;"><i class="fas fa-question-circle"></i></span>
                <span class="text">Help & Support</span>
            </a>
        </div>
        <div class="common-list-item">
            <a class="common-list-button" href="/MessageBoard/setting">
                <span class="icon" style="color: grey;"><i class="fas fa-cog"></i></span>
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

    <div style="max-width: 800px; margin: 0 auto; padding: 20px; font-family: Arial, sans-serif;">
        <!-- Header Section with Create Page Button -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h1 style="font-size: 24px; margin: 0;">Discover Pages</h1>
            <a href="/MessageBoard/page" 
            style="text-decoration: none; padding: 10px 20px; background: #1877f2; color: white; border-radius: 5px; font-size: 14px; font-weight: bold; cursor: pointer;">
                + Create Page
            </a>
        </div>
        <div>
            <?php foreach ($pages as $page): ?>
                <div id="pageCardDiv" style="border: 1px solid #ddd; border-radius: 8px; margin-bottom: 20px; overflow: hidden; background: #fff;">
                    <!-- Cover Photo -->
                    <?php if (!empty($page['Page']['cover_photo'])): ?>
                        <img src="<?php echo $page['Page']['cover_photo'] ; ?>" alt="Cover Photo" style="width: 100%; height: 150px; object-fit: cover;">
                    <?php else: ?>
                        <div style="width: 100%; height: 150px; background: #ddd; display: flex; justify-content: center; align-items: center; color: #888;">
                            No Cover Photo
                        </div>
                    <?php endif; ?>

                    <div style="padding: 15px;">
                        <!-- Profile Picture and Name -->
                        <div style="display: flex; gap: 15px; align-items: center;">
                            <a href="/MessageBoard/view_page/<?php echo h($page['Page']['id']); ?>"> 
                                <img src="<?php echo h($page['Page']['profile_picture']); ?>" alt="Page Profile" style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover;">
                            </a>
                            <div>
                                <a href="/MessageBoard/view_page/<?php echo h($page['Page']['id']); ?>"> 
                                    <h2 style="margin: 0; font-size: 18px; color: #333;"><?php echo h($page['Page']['name']); ?></h2>
                                </a>
                                <p style="margin: 5px 0; font-size: 14px; color: #666;"><?php echo h($page['Page']['category'] ?? 'No Category'); ?></p>
                            </div>
                        </div>

                        <!-- Description -->
                        <?php if (!empty($page['Page']['description'])): ?>
                            <p style="margin: 15px 0; font-size: 14px; color: #666;"><?php echo h($page['Page']['description']); ?></p>
                        <?php endif; ?>

                        <!-- Created By and Date -->
                        <p style="margin: 10px 0; font-size: 12px; color: #888;">
                                <?php echo h(date('F j, Y', strtotime($page['Page']['created_at']))); ?>
                        </p>

                         <!-- Actions -->
                        <div style="display: flex; gap: 10px;">
                            <?php if ($page['Page']['isLiked']): ?>
                                <button class="likeButton" 
                                        data-page-id="<?php echo h($page['Page']['id']); ?>" 
                                        style="padding: 8px 15px; font-size: 14px; border: none; border-radius: 5px; cursor: pointer; background: #1877f2; color: white;">
                                    Unfollow
                                </button>
                            <?php else: ?>
                                <button class="likeButton" 
                                        data-page-id="<?php echo h($page['Page']['id']); ?>" 
                                        style="padding: 8px 15px; font-size: 14px; border: none; border-radius: 5px; cursor: pointer; background: #1877f2; color: white;">
                                    Like
                                </button>
                            <?php endif; ?>
                            <button style="padding: 8px 15px; font-size: 14px; border: none; border-radius: 5px; cursor: pointer; background: #42b72a; color: white;">Message</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>


    </ul>
  </main>
  <aside class="side-b">
    
    <section class="common-section">
        <h2 class="section-title">Sponsored</h2>
        <ul class="common-list" id="ads-list">
            <!-- Ad items will be dynamically inserted here -->
        </ul>
        <button class="common-more">
            <span class="text">See More</span>
            <span class="icon">🔻</span>
        </button>
    </section>


    <section class="common-section">
        <?php if (!empty($BirthdayCelebrant)): ?>
            <h2 class="section-title" style="font-size: 18px; font-weight: bold; color: #333; margin-bottom: 20px;">Birthdays</h2>
            <?php 
            $celebrantsCount = count($BirthdayCelebrant); 
            ?>
            <!-- Birthday Notification -->
            <p style="font-size: 14px; color: #333; margin-bottom: 10px; display: flex; align-items: center;" onclick="showBirthdayModal()">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="100" height="100" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 15px;">
                    <!-- Gift box -->
                    <rect x="3" y="6" width="18" height="12" rx="2" ry="2" fill="blue" stroke="#333"></rect>
                    <!-- Ribbon lines -->
                    <line x1="3" y1="6" x2="21" y2="6" stroke="orange" stroke-width="3"></line>
                    <line x1="12" y1="6" x2="12" y2="18" stroke="orange" stroke-width="3"></line>
                    <!-- Gift top section -->
                    <path d="M3 8 L12 2 L21 8" stroke="orange" stroke-width="3"></path>
                </svg>
                <span style="font-size: 16px;">
                    <?php
                    $namesToShow = array_slice($BirthdayCelebrant, 0, 2); 
                    $names = array_map(function($bc) {
                        return $bc['full_name'];
                    }, $namesToShow);
                    
                    echo '<b>' . implode(", ", $names) . '</b>'; 
                    
                    if ($celebrantsCount > 2) {
                        echo " and " . ($celebrantsCount - 2) . " others are celebrating today! 🎂🎉 Wish them a happy birthday!";
                    } else {
                        echo " are celebrating their birthday today! 🎂🎉 Wish them a happy birthday!";
                    }
                    ?>
                </span>
            </p>
        <?php endif; ?>
        </section>


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

$(document).ready(function() {
    // Handle Like and Unfollow button clicks
    $('.likeButton').on('click', function() {
        var button = $(this);
        var pageId = button.data('page-id');
        var action = button.text().trim(); 

        $.ajax({
            url: '/MessageBoard/PageFollowers/likePage', 
            method: 'POST',
            data: {
                page_id: pageId,
                action: action 
            },
            dataType: 'json',
            success: function(response) { 
                if (response.success) {
                    if (action === 'Like') {
                        button.text('Unfollow');
                    } else {
                        button.text('Like');
                    }
                } else {
                    alert('There was an error with your request.');
                }
            },
            error: function() {
                alert('Failed to process your request. Please try again.');
            }
        });
    });
});


</script>