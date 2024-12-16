
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

    <div class="container" style="max-width: 500px; margin: 0 auto; padding-top: 40px;">
        <div class="page-create-container" style="background-color: #fff; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); padding: 40px; text-align: center;">
            <h1 style="font-size: 28px; font-weight: bold; color: #1C1E21; margin-bottom: 20px;">Create Your Page</h1>
            <p style="font-size: 16px; color: #65676B; margin-bottom: 30px;">Choose a category to get started and create your page.</p>

            <!-- Form to create a page -->
            <form action="<?php echo $this->Html->url(array('controller' => 'Page', 'action' => 'createPage')); ?>" method="POST" class="page-form" enctype="multipart/form-data">

                
                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="name" style="font-size: 14px; font-weight: 600; color: #1C1E21; margin-bottom: 5px;">Page Name</label>
                    <input type="text" id="name" name="data[Page][name]" class="form-control" style="width: 100%; padding: 12px 16px; border-radius: 6px; border: 1px solid #ddd; font-size: 14px;" placeholder="Enter page name" required>
                </div>

                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="category" style="font-size: 14px; font-weight: 600; color: #1C1E21; margin-bottom: 5px;">Category</label>
                    <select id="category" name="data[Page][category]" class="form-control" style="width: 100%; padding: 12px 16px; border-radius: 6px; border: 1px solid #ddd; font-size: 14px;" required>
                        <option value="">Select category</option>
                        <option value="Business">Business</option>
                        <option value="Community">Community</option>
                        <option value="Artist">Artist</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <!-- Additional category input field, initially hidden -->
                <div class="form-group" id="otherCategoryGroup" style="display: none; margin-bottom: 20px;">
                    <label for="other_category" style="font-size: 14px; font-weight: 600; color: #1C1E21; margin-bottom: 5px;">Specify Category</label>
                    <input type="text" id="other_category" name="data[Page][other_category]" class="form-control" style="width: 100%; padding: 12px 16px; border-radius: 6px; border: 1px solid #ddd; font-size: 14px;" placeholder="Enter custom category">
                </div>

                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="description" style="font-size: 14px; font-weight: 600; color: #1C1E21; margin-bottom: 5px;">Description</label>
                    <textarea id="description" name="data[Page][description]" class="form-control" style="width: 100%; padding: 12px 16px; border-radius: 6px; border: 1px solid #ddd; font-size: 14px; height: 120px;" placeholder="Describe your page" required></textarea>
                </div>

                <!-- Profile Picture Upload -->
                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="profile_picture" style="font-size: 14px; font-weight: 600; color: #1C1E21; margin-bottom: 5px;">Profile Picture</label>
                    <input type="file" id="profile_picture" name="data[Page][profile_picture]" class="form-control" style="width: 100%; padding: 12px 16px; border-radius: 6px; border: 1px solid #ddd; font-size: 14px;" accept="image/*">
                </div>

                <!-- Cover Photo Upload -->
                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="cover_photo" style="font-size: 14px; font-weight: 600; color: #1C1E21; margin-bottom: 5px;">Cover Photo</label>
                    <input type="file" id="cover_photo" name="data[Page][cover_photo]" class="form-control" style="width: 100%; padding: 12px 16px; border-radius: 6px; border: 1px solid #ddd; font-size: 14px;" accept="image/*">
                </div>


                <div class="form-group">
                    <button type="submit" class="btn" style="width: 100%; padding: 14px; font-size: 16px; background-color: #1877F2; color: white; border-radius: 6px; border: none; cursor: pointer; transition: background-color 0.2s ease;">
                        <strong>Create Page</strong>
                    </button>
                </div>
            </form>
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

document.getElementById('category').addEventListener('change', function() {
    var otherCategoryGroup = document.getElementById('otherCategoryGroup');
    var otherCategoryInput = document.getElementById('other_category'); // This is the actual input for custom category

    if (this.value === 'Other') {
        otherCategoryGroup.style.display = 'block'; 
    } else {
        otherCategoryGroup.style.display = 'none'; 
        otherCategoryInput.value = ''; // Clear the value of the input element
    }
});



</script>