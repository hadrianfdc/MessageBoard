
<?php echo $this->Html->css('UserProfiles/setting');  ?>
<!-- jQuery CDN (Latest Version as of now) -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<div class="settings-container">
  <!-- Sidebar Section -->
  <div class="settings-sidebar">
    <h3>Settings & Privacy</h3>
    <ul>
      <li><a href="#" onclick="loadContent('general')">General</a></li>
      <li><a href="#" onclick="loadContent('security')">Security & Login</a></li>
      <li><a href="#" onclick="loadContent('privacy')">Privacy</a></li>
      <li><a href="#" onclick="loadContent('notifications')">Notifications</a></li>
      <li><a href="#" onclick="loadContent('ads')">Ads Preferences</a></li>
      <li><a href="#" onclick="loadContent('apps')">Apps & Websites</a></li>
      <li><a href="#" onclick="loadContent('activity')">Activity Log</a></li>
      <li><a href="#" onclick="loadContent('language')">Language</a></li>
      <li><a href="#" onclick="loadContent('accessibility')">Accessibility</a></li>
      <li><a href="#" onclick="showLogoutModal()">Log Out</a></li>
      <li><a href="/MessageBoard/newsfeed">Back</a></li>
    </ul>
  </div>

  <!-- Main Content Section -->
  <div class="settings-content">
    <div id="content-display">
      <!-- Default landing content -->
      <h2>Welcome to Settings</h2>
      <p>Select a menu option from the sidebar to edit your preferences.</p>
    </div>
  </div>
</div>


   <!-- Logout Modal -->
   <div id="logoutModal" 
         style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 9999; justify-content: center; align-items: center;">
        <div style="background-color: white; padding: 20px; border-radius: 8px; width: 300px; text-align: center; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
            <h2 style="font-size: 18px; margin: 0; margin-bottom: 10px;">Log Out</h2>
            <p style="font-size: 14px; color: #606770; margin-bottom: 20px;">
                Are you sure you want to log out?
            </p>
            <div style="display: flex; justify-content: space-between;">
                <button onclick="hideLogoutModal()" 
                        style="background-color: #e4e6eb; color: #050505; border: none; padding: 8px 16px; border-radius: 5px; cursor: pointer; font-size: 14px;">
                    Cancel
                </button>
                <button onclick="confirmLogout()" 
                        style="background-color: #1877f2; color: white; border: none; padding: 8px 16px; border-radius: 5px; cursor: pointer; font-size: 14px;">
                    Logout
                </button>
            </div>
        </div>
    </div>



<script>
  // Simulate Content Switching
function loadContent(page) {
  const contentDisplay = document.getElementById('content-display');
  var userProfileData = <?php echo json_encode($userProfileData); ?>;
  switch (page) {
    case 'general':
      contentDisplay.innerHTML = `
        <h2 style="color: #333; font-size: 24px; margin-bottom: 10px;">General Settings</h2>
        <p style="color: #555; font-size: 16px; margin-bottom: 20px;">Manage your personal details here.</p>
        
        <div class="setting-item" style="margin-bottom: 15px;">
          <label for="full_name" style="display: block; font-size: 14px; margin-bottom: 5px;">Full Name</label>
          <input type="text" id="full_name" value="${userProfileData[0]['UserProfiles']['full_name']}" style="padding: 8px; width: 100%; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px;">
        </div>
        
        <div class="setting-item" style="margin-bottom: 15px;">
          <label for="gender" style="display: block; font-size: 14px; margin-bottom: 5px;">Gender</label>
          <select id="gender" style="padding: 8px; width: 100%; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px;">
            <option value="">Select</option>
            <option value="Male" ${userProfileData[0]['UserProfiles']['gender'] === 'Male' ? 'selected' : ''}>Male</option>
            <option value="Female" ${userProfileData[0]['UserProfiles']['gender'] === 'Female' ? 'selected' : ''}>Female</option>
            <option value="Other" ${userProfileData[0]['UserProfiles']['gender'] === 'Other' ? 'selected' : ''}>Other</option>
          </select>
        </div>
        
        <div class="setting-item" style="margin-bottom: 15px;">
          <label for="birthdate" style="display: block; font-size: 14px; margin-bottom: 5px;">Birthdate</label>
          <input type="date" id="birthdate" value="${userProfileData[0]['UserProfiles']['birthdate']}" style="padding: 8px; width: 100%; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px;">
        </div>
        
        <div class="setting-item" style="margin-bottom: 15px;">
          <label for="hobby" style="display: block; font-size: 14px; margin-bottom: 5px;">Hobby</label>
          <input type="text" id="hobby" value="${userProfileData[0]['UserProfiles']['hobby']}" style="padding: 8px; width: 100%; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px;">
        </div>
        
        <div class="setting-item" style="margin-bottom: 15px;">
          <label for="location" style="display: block; font-size: 14px; margin-bottom: 5px;">Location</label>
          <input type="text" id="location" value="${userProfileData[0]['UserProfiles']['location']}" style="padding: 8px; width: 100%; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px;">
        </div>
        
        <div class="setting-item" style="margin-bottom: 15px;">
          <label for="education" style="display: block; font-size: 14px; margin-bottom: 5px;">Education</label>
          <input type="text" id="education" value="${userProfileData[0]['UserProfiles']['education']}" style="padding: 8px; width: 100%; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px;">
        </div>
        
        <div class="setting-item" style="margin-bottom: 15px;">
          <label for="work" style="display: block; font-size: 14px; margin-bottom: 5px;">Work</label>
          <input type="text" id="work" value="${userProfileData[0]['UserProfiles']['work']}" style="padding: 8px; width: 100%; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px;">
        </div>
        
        <div class="setting-item" style="margin-bottom: 15px;">
          <label for="relationship" style="display: block; font-size: 14px; margin-bottom: 5px;">Relationship Status</label>
          <input type="text" id="relationship" value="${userProfileData[0]['UserProfiles']['relationship']}" style="padding: 8px; width: 100%; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px;">
        </div>
        
        <div class="setting-item" style="margin-bottom: 15px;">
          <label for="links" style="display: block; font-size: 14px; margin-bottom: 5px;">Links</label>
          <input type="url" id="links" value="${userProfileData[0]['UserProfiles']['links']}" style="padding: 8px; width: 100%; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px;">
        </div>
        
        <div class="setting-item" style="text-align: center; margin-top: 20px;">
          <button class="btn-save" onclick="saveGeneral()" style="padding: 10px 20px; background-color: #4267B2; color: white; border: none; border-radius: 5px; font-size: 16px; cursor: pointer;">Save Changes</button>
        </div>
      `;
      break;

    case 'security':
      contentDisplay.innerHTML = `
        <h2>Security & Login</h2>
        <p>Update your password or set up two-factor authentication here.</p>
        <div class="setting-item">
          <label for="old-password">Old Password</label>
          <input type="password" id="old-password">
        </div>
        <div class="setting-item">
          <label for="new-password">New Password</label>
          <input type="password" id="new-password">
        </div>
        <div class="setting-item">
          <button class="btn-save" onclick="saveSecurity()">Save Security Settings</button>
        </div>
      `;
      break;
    case 'privacy':
      contentDisplay.innerHTML = `
        <h2>Privacy Settings</h2>
        <p>Control who can see your posts, find you, or contact you.</p>
        <div class="setting-item">
          <input type="checkbox" id="post-visibility">
          <label for="post-visibility">Who can see your posts?</label>
        </div>
        <div class="setting-item">
          <button class="btn-save" onclick="savePrivacy()">Save Privacy Settings</button>
        </div>
      `;
      break;
    case 'notifications':
      contentDisplay.innerHTML = `
        <h2>Notifications</h2>
        <p>Manage notification preferences here.</p>
        <div class="setting-item">
          <input type="checkbox" id="email-notify">
          <label for="email-notify">Receive email notifications</label>
        </div>
        <div class="setting-item">
          <button class="btn-save" onclick="saveNotifications()">Save Changes</button>
        </div>
      `;
      break;
    case 'ads':
      contentDisplay.innerHTML = `
        <h2>Ads Preferences</h2>
        <p>Manage how ads are personalized for you.</p>
        <div class="setting-item">
          <input type="checkbox" id="personalized-ads">
          <label for="personalized-ads">Enable personalized ads</label>
        </div>
        <div class="setting-item">
          <button class="btn-save" onclick="saveAds()">Save Ads Settings</button>
        </div>
      `;
      break;
    case 'apps':
      contentDisplay.innerHTML = `
        <h2>Apps & Websites</h2>
        <p>Manage access to third-party apps connected to your account.</p>
      `;
      break;
    case 'activity':
      contentDisplay.innerHTML = `
        <h2>Activity Log</h2>
        <p>View your activity history and interactions.</p>
      `;
      break;
    case 'language':
      contentDisplay.innerHTML = `
        <h2>Language</h2>
        <p>Set your preferred language for Facebook.</p>
      `;
      break;
    case 'accessibility':
      contentDisplay.innerHTML = `
        <h2>Accessibility Options</h2>
        <p>Adjust settings to make the interface easier to use.</p>
      `;
      break;
  }
}

// Mock backend simulation for button clicks
function saveGeneral() {
  alert('General settings saved successfully!');
}

function saveSecurity() {
  alert('Security settings saved successfully!');
}

function savePrivacy() {
  alert('Privacy settings saved successfully!');
}

function saveNotifications() {
  alert('Notification settings saved successfully!');
}

function saveAds() {
  alert('Ad preferences saved successfully!');
}

function showLogoutModal() {
        document.getElementById('logoutModal').style.display = 'flex';
}

function hideLogoutModal() {
    document.getElementById('logoutModal').style.display = 'none';
}

function confirmLogout() {
    $.ajax({
        type: 'POST',
        url: '<?php echo $this->Html->url(array("controller" => "logins", "action" => "logout")); ?>',
        success: function(data) {
            window.location.href = '<?php echo $this->Html->url(array("controller" => "logins", "action" => "login")); ?>';
        }
    });
}


function saveGeneral() {
    const fullName = document.getElementById('full_name').value;
    const gender = document.getElementById('gender').value;
    const birthdate = document.getElementById('birthdate').value;
    const hobby = document.getElementById('hobby').value;
    const links = document.getElementById('links').value;
    const education = document.getElementById('education').value;
    const work = document.getElementById('work').value;
    const relationship = document.getElementById('relationship').value;
    const location = document.getElementById('location').value;

    // Send the AJAX POST request
    $.ajax({
      type: 'POST',
      url: '<?php echo $this->Html->url(array("controller" => "UserProfiles", "action" => "editDetails")); ?>',
      data: {
        full_name: fullName,
        gender: gender,
        birthdate: birthdate,
        hobby: hobby,
        links: links,
        education: education,
        work: work,
        relationship: relationship,
        location: location,
      },
      success: function(response) {
        Swal.fire({
          icon: 'success',
          title: 'Success!',
          text: 'Details updated successfully!',
          confirmButtonText: 'OK'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.reload(); 
          }
        });
      },
      error: function() {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Failed to save changes.',
          confirmButtonText: 'OK'
        });
      }
    });
  }

</script>