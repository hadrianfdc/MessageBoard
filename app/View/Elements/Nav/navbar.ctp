
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
      <li class="user-nav-item">
        <button class="icon-button alt-text" aria-label="Notifications"><span class="icon" aria-hidden="true">🔔</span></button>
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

  </script>