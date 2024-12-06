
<?php echo $this->Html->css('Navbar/navbar');  ?>
<header class="main-header u-flex">
    <div class="start u-flex">
       <a class="logo" href="/MessageBoard/newsfeed">f</a>
       <div class="search-box-wrapper">
         <input type="search" class="search-box" placeholder="Search Facebook">
         <span class="icon-search" aria-label="hidden">🔎</span>
      </div>
    </div>
    <nav class="main-nav">
      <ul class="main-nav-list u-flex">
      <div class="main-nav-item u-only-wide"><a aria-label="Homepage" class="main-nav-button alt-text"><span class="icon" aria-hidden="true"></span></a></div>
        <div class="main-nav-item u-only-wide"><a aria-label="Pages" class="main-nav-button alt-text"><span class="icon" aria-hidden="true"></span></a></div>
        <div class="main-nav-item u-only-wide"><a aria-label="Watch" class="main-nav-button alt-text"><span class="icon" aria-hidden="true"></span></a></div>
        <div class="main-nav-item u-only-wide"><a aria-label="Marketplace" class="main-nav-button alt-text"><span class="icon" aria-hidden="true"></span></a></div>
        <div class="main-nav-item u-only-wide"><a aria-label="Groups" class="main-nav-button alt-text"><span class="icon" aria-hidden="true"></span></a></div>
        <div class="main-nav-item u-only-small"><button aria-label="Menu" class="main-nav-button u-animation-click" id="menuButton"><span class="icon icon-hamburger" aria-hidden="true"></span></button></div>
      </ul>
    </nav>
    <div class="end"></div>
    <nav class="user-nav">
    <ul class="user-nav-list u-flex">
      <li class="user-nav-item">
        <a class="user" href="/MessageBoard/user-profile">
          <?php if (isset($findMyPic['Posts']['path'])): ?>
              <img class="user-image" src="<?php echo $this->Html->url('/' . $findMyPic['Posts']['path']); ?>" height="28" width="28" alt="">
          <?php endif; ?>
          <span class="user-name"><?php echo $user['User']['full_name']; ?></span>
        </a>
      </li>
      <li class="user-nav-item">
        <a id="openModalBtn" class="icon-button alt-text" aria-label="Create"><span class="icon" aria-hidden="true">➕</span></a>
      </li>
      <li class="user-nav-item">
        <a href="http://localhost/MessageBoard/Messages/index" class="icon-button alt-text" aria-label="Messenger"><span class="icon" aria-hidden="true">💬</span></a>
      </li>

      <li class="user-nav-item" style="position: relative; list-style: none;">
          <button class="icon-button alt-text" aria-label="Notifications" id="notificationButton" style="position: relative; background: none; border: none; padding: 0; cursor: pointer;">
              <span class="icon" aria-hidden="true" style="font-size: 24px;">🔔</span>
              <!-- Display Notification Counter -->
              <?php
              $unreadCount = 0;
              foreach ($allNotifications as $notification) {
                  if ($notification['is_seen'] == 0) {
                      $unreadCount++;
                  }
              }
              ?>
              <span id="notificationCounter" class="notification-counter" style="display: <?php echo $unreadCount > 0 ? 'inline' : 'none'; ?>; background-color: red; color: white; font-size: 12px; border-radius: 50%; padding: 3px 7px; margin-left: 5px; position: absolute; top: 5px; right: 5px;">
                  <?php echo $unreadCount; ?>
              </span>
          </button>

          <!-- Dropdown Menu -->
          <div id="notificationDropdown" class="dropdown-menu" style="display: none; position: absolute; top: 40px; right: 0; background-color: #fff; border: 1px solid #ddd; width: 300px; max-height: 400px; overflow-y: auto; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15); z-index: 100; padding: 0; border-radius: 8px;">
              <?php foreach ($allNotifications as $notification): ?>
                <?php if ($notification['source'] == 'friends_list'): ?>
                  <a data-notif-id="<?php echo $notification['id']; ?>" data-notif-source="friends_list" href="/MessageBoard/user-profiles-of/<?php echo $notification['details']['from_who_user_id']; ?>" 
                      class="notification-item" style="padding: 12px 16px; border-bottom: 1px solid #f0f0f0; display: flex; align-items: center; text-decoration: none; color: black; background-color: <?php echo $notification['is_seen'] == 0 ? '#f0f0f0' : '#fff'; ?>; position: relative;">
                <?php else: ?>
                  <a data-notif-id="<?php echo $notification['id']; ?>" data-notif-source="notification" href="#" class="notification-item" style="padding: 12px 16px; border-bottom: 1px solid #f0f0f0; display: flex; align-items: center; text-decoration: none; color: black; background-color: <?php echo $notification['is_seen'] == 0 ? '#f0f0f0' : '#fff'; ?>; position: relative;">
                <?php endif; ?>
                      <!-- Red Circle for Unread Notifications -->
                      <?php if ($notification['is_seen'] == 0): ?>
                          <span style="position: absolute; top: 8px; right: 8px; width: 12px; height: 12px; background-color: red; border-radius: 50%;"></span>
                      <?php endif; ?>

                      <!-- User Image -->
                      <img class="user-image" src="<?php echo $this->Html->url('/' . $notification['details']['profile_pic']); ?>" height="32" width="32" alt="" style="border-radius: 50%; margin-right: 12px;">

                      <!-- Notification Text -->
                      <div style="flex: 1;">
                          <?php if (isset($notification['source']) && $notification['source'] == 'notification'): ?>
                              <p style="margin: 0; font-size: 14px;"> <b><?php echo $notification['details']['full_name']; ?></b> <?php echo $notification['details']['description']; ?></p>
                          <?php else: ?>
                            <p style="margin: 0; font-size: 14px;"> <b><?php echo $notification['details']['full_name']; ?></b> <?php echo $notification['type'] == 1 ? 'Sent you a friend request' : 'Accepted your friend request'; ?></p>
                          <?php endif; ?>
                          <?php
                              // Convert created time to DateTime object
                              $createdTime = new DateTime($notification['created']);
                              $now = new DateTime();

                              // Calculate the difference between now and the created time
                              $interval = $now->diff($createdTime);

                              // Determine the difference in a human-readable format
                              if ($interval->y > 0) {
                                  $timeAgo = $interval->y . ' year' . ($interval->y > 1 ? 's' : '') . ' ago';
                              } elseif ($interval->m > 0) {
                                  $timeAgo = $interval->m . ' month' . ($interval->m > 1 ? 's' : '') . ' ago';
                              } elseif ($interval->d > 0) {
                                  $timeAgo = $interval->d . ' day' . ($interval->d > 1 ? 's' : '') . ' ago';
                              } elseif ($interval->h > 0) {
                                  $timeAgo = $interval->h . ' hour' . ($interval->h > 1 ? 's' : '') . ' ago';
                              } elseif ($interval->i > 0) {
                                  $timeAgo = $interval->i . ' minute' . ($interval->i > 1 ? 's' : '') . ' ago';
                              } else {
                                  $timeAgo = $interval->s . ' second' . ($interval->s > 1 ? 's' : '') . ' ago';
                              }
                          ?>
                          <p style="margin: 0; font-size: 12px; color: #888;"><?php echo $timeAgo; ?></p>
                      </div>
                  </a> 
              <?php endforeach; ?>
          </div>
      </li>

      <li class="user-nav-item">
          <button class="icon-button alt-text" aria-label="Account" id="dropdown-toggle">
              <span class="icon" aria-hidden="true">🔻</span>
          </button>
          <!-- Dropdown Menu -->
          <ul id="dropdown-menu" class="dropdown-menu">
              <li><a href="/MessageBoard/user-profile">Profile</a></li>
              <li><a href="#">Settings</a></li>
              <li><a href="#" onclick="confirmLogout()" >Log Out</a></li>
          </ul>
      </li>
    </ul>
  </nav>
  </header>




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
      // Get the button and dropdown menu
  const dropdownToggle = document.getElementById('dropdown-toggle');
  const dropdownMenu = document.getElementById('dropdown-menu');
  dropdownToggle.addEventListener('click', function(event) {
      event.preventDefault();
      dropdownMenu.style.display = (dropdownMenu.style.display === 'block') ? 'none' : 'block';
  });
  window.addEventListener('click', function(event) {
      if (!dropdownToggle.contains(event.target) && !dropdownMenu.contains(event.target)) {
          dropdownMenu.style.display = 'none';
      }
  });





  document.getElementById("notificationButton").addEventListener("click", function() {
    var dropdown = document.getElementById("notificationDropdown");
    var isVisible = dropdown.style.display === "block";

    // Toggle dropdown visibility
    dropdown.style.display = isVisible ? "none" : "block";
});

// Hide the dropdown when clicking anywhere outside of it
document.addEventListener("click", function(event) {
    var dropdown = document.getElementById("notificationDropdown");
    var button = document.getElementById("notificationButton");

    // If the click was outside the button or dropdown, hide the dropdown
    if (!button.contains(event.target) && !dropdown.contains(event.target)) {
        dropdown.style.display = "none";
    }
});

//--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------//--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------
 //Update is_seen //Update is_seen //Update is_seen //Update is_seen 
 //Update is_seen //Update is_seen //Update is_seen //Update is_seen 

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.notification-item').forEach(item => {
        item.addEventListener('click', function (event) {
            event.preventDefault();

            const notifId = this.getAttribute('data-notif-id');
            const notifSource = this.getAttribute('data-notif-source');
            const link = this.getAttribute('href');

            fetch('/MessageBoard/FriendsList/updateSeen', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ id: notifId, source: notifSource }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = link;
                } else {
                    alert('Failed to mark notification as seen.');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
});



  </script>