
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
          <h2 style="color: #333; font-size: 24px; margin-bottom: 10px;">Security & Login</h2>
          <p style="color: #555; margin-bottom: 20px; font-size: 14px;">Update your password or set up two-factor authentication here.</p>
          <div style="background: #f0f2f5; padding: 20px; border-radius: 8px; box-shadow: 0 1px 2px rgba(0,0,0,0.1);">
            <div class="setting-item" style="margin-bottom: 15px;">
              <label for="old-password" style="color: #555; font-size: 14px; display: block; margin-bottom: 5px;">Old Password</label>
              <input type="password" id="old-password" 
                style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px;">
            </div>
            <div class="setting-item" style="margin-bottom: 15px;">
              <label for="new-password" style="color: #555; font-size: 14px; display: block; margin-bottom: 5px;">New Password</label>
              <input type="password" id="new-password"
                style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px;">
            </div>
            <div class="setting-item" style="margin-bottom: 20px;">
              <label for="confirm-password" style="color: #555; font-size: 14px; display: block; margin-bottom: 5px;">Confirm New Password</label>
              <input type="password" id="confirm-password"
                style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px;">
            </div>
            <div class="setting-item" style="text-align: center;">
              <button class="btn-save" 
                style="background-color: #1877f2; color: #fff; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; font-size: 16px; transition: background-color 0.2s;"
                onclick="saveSecurity()">Save Security Settings</button>
            </div>
          </div>
        `;
        break;

        case 'privacy':
        contentDisplay.innerHTML = `
            <h2 style="font-size: 24px; margin-bottom: 10px; color: #333;">Privacy Settings</h2>
            <p style="font-size: 14px; margin-bottom: 20px; color: #555;">Control who can see your posts, find you, or contact you.</p>
            
            <!-- Who can see your profile -->
            <div class="setting-item" style="margin-bottom: 15px; display: flex; align-items: center; gap: 10px;">
                <label for="account-type" style="font-size: 14px; color: #555;">Account type?</label>
                <select id="account-type" style="padding: 8px 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px;">
                    <option value="1" ${userProfileData[0]['UserProfiles']['account_type'] == 1 ? 'selected' : ''}>Private</option>
                    <option value="2" ${userProfileData[0]['UserProfiles']['account_type'] == 2 ? 'selected' : ''}>Public</option>
                </select>
            </div>
            
            <!-- Who can find your profile -->
            <div class="setting-item" style="margin-bottom: 15px; display: flex; align-items: center; gap: 10px;">
                <label for="search-visibility" style="font-size: 14px; color: #555;">Who can find your profile?</label>
                <select id="search-visibility" style="padding: 8px 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px;">
                    <option value="1" ${userProfileData[0]['UserProfiles']['search_visibility'] == 1 ? 'selected' : ''}>Everyone</option>
                    <option value="2" ${userProfileData[0]['UserProfiles']['search_visibility'] == 2 ? 'selected' : ''}>Friends</option>
                </select>
            </div>
            
            <!-- Who can send you messages -->
            <div class="setting-item" style="margin-bottom: 15px; display: flex; align-items: center; gap: 10px;">
                <label for="who-can-send-message" style="font-size: 14px; color: #555;">Who can send you messages?</label>
                <select id="who-can-send-message" style="padding: 8px 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px;">
                    <option value="1" ${userProfileData[0]['UserProfiles']['who_can_send_message'] == 1 ? 'selected' : ''}>Everyone</option>
                    <option value="2" ${userProfileData[0]['UserProfiles']['who_can_send_message'] == 2 ? 'selected' : ''}>Friends Only</option>
                    <option value="0" ${userProfileData[0]['UserProfiles']['who_can_send_message'] == 0 ? 'selected' : ''}>No One</option>
                </select>
            </div>
            
            <!-- Location sharing -->
            <div class="setting-item" style="margin-bottom: 15px; display: flex; align-items: center; gap: 10px;">
                <label for="location-sharing" style="font-size: 14px; color: #555;">Location Sharing</label>
                <select id="location-sharing" style="padding: 8px 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px;">
                    <option value="0" ${userProfileData[0]['UserProfiles']['location_sharing'] == 0 ? 'selected' : ''}>Disable</option>
                    <option value="1" ${userProfileData[0]['UserProfiles']['location_sharing'] == 1 ? 'selected' : ''}>Enable</option>
                </select>
            </div>
            
            <!-- Who can post on your timeline -->
            <div class="setting-item" style="margin-bottom: 15px; display: flex; align-items: center; gap: 10px;">
                <label for="timeline-permission" style="font-size: 14px; color: #555;">Who can post on your timeline?</label>
                <select id="timeline-permission" style="padding: 8px 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px;">
                    <option value="1" ${userProfileData[0]['UserProfiles']['timeline_permision'] == 1 ? 'selected' : ''}>Everyone</option>
                    <option value="2" ${userProfileData[0]['UserProfiles']['timeline_permision'] == 2 ? 'selected' : ''}>Friends</option>
                    <option value="3" ${userProfileData[0]['UserProfiles']['timeline_permision'] == 3 ? 'selected' : ''}>Only Me</option>
                </select>
            </div>

            <!-- Permission for Tag -->
            <div class="setting-item" style="margin-bottom: 15px; display: flex; align-items: center; gap: 10px;">
                <label for="profile-tagging" style="font-size: 14px; color: #555;">Permission for Tag?</label>
                <select id="profile-tagging" style="padding: 8px 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px;">
                    <option value="1" ${userProfileData[0]['UserProfiles']['profile_tagging'] == 1 ? 'selected' : ''}>Allow Friends</option>
                    <option value="2" ${userProfileData[0]['UserProfiles']['profile_tagging'] == 2 ? 'selected' : ''}>Approval for Tag</option>
                </select>
            </div>

            <!-- Who can see my friends list -->
            <div class="setting-item" style="margin-bottom: 15px; display: flex; align-items: center; gap: 10px;">
                <label for="who-can-see-myfriends" style="font-size: 14px; color: #555;">Who can see my friends list?</label>
                <select id="who-can-see-myfriends" style="padding: 8px 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px;">
                    <option value="1" ${userProfileData[0]['UserProfiles']['who_can_see_myfriends'] == 1 ? 'selected' : ''}>Only Me</option>
                    <option value="2" ${userProfileData[0]['UserProfiles']['who_can_see_myfriends'] == 2 ? 'selected' : ''}>Friends</option>
                    <option value="3" ${userProfileData[0]['UserProfiles']['who_can_see_myfriends'] == 3 ? 'selected' : ''}>Public</option>
                </select>
            </div>

            <!-- Show Birthday -->
            <div class="setting-item" style="margin-bottom: 15px; display: flex; align-items: center; gap: 10px;">
                <label for="show-birthday" style="font-size: 14px; color: #555;">Show birthday?</label>
                <select id="show-birthday" style="padding: 8px 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px;">
                    <option value="1" ${userProfileData[0]['UserProfiles']['show_birthday'] == 1 ? 'selected' : ''}>Yes</option>
                    <option value="0" ${userProfileData[0]['UserProfiles']['show_birthday'] == 0 ? 'selected' : ''}>No</option>
                </select>
            </div>

            <!-- Show Location Details -->
            <div class="setting-item" style="margin-bottom: 15px; display: flex; align-items: center; gap: 10px;">
                <label for="show-location-details" style="font-size: 14px; color: #555;">Show location in timeline?</label>
                <select id="show-location-details" style="padding: 8px 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px;">
                    <option value="1" ${userProfileData[0]['UserProfiles']['show_location_details'] == 1 ? 'selected' : ''}>Yes</option>
                    <option value="0" ${userProfileData[0]['UserProfiles']['show_location_details'] == 0 ? 'selected' : ''}>No</option>
                </select>
            </div>

            <!-- Show Relationship Details -->
            <div class="setting-item" style="margin-bottom: 15px; display: flex; align-items: center; gap: 10px;">
                <label for="show-inrelationship" style="font-size: 14px; color: #555;">Show in relationship in timeline?</label>
                <select id="show-inrelationship" style="padding: 8px 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px;">
                    <option value="1" ${userProfileData[0]['UserProfiles']['show_inrelationship'] == 1 ? 'selected' : ''}>Yes</option>
                    <option value="0" ${userProfileData[0]['UserProfiles']['show_inrelationship'] == 0 ? 'selected' : ''}>No</option>
                </select>
            </div>
            
            <!-- Save Button -->
            <div class="setting-item" style="margin-top: 20px; display: flex; justify-content: center;">
                <button class="btn-save" 
                        onclick="savePrivacy()"
                        style="background-color: #4267B2; color: white; padding: 10px 20px; font-size: 16px; border: none; border-radius: 5px; cursor: pointer;">
                    Save Privacy Settings
                </button>
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

//Case General Setting //Case General Setting//Case General Setting//Case General Setting//Case General Setting//Case General Setting//Case General Setting//Case General Setting
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

//Case Secuirty Password //Case Secuirty Password//Case Secuirty Password//Case Secuirty Password//Case Secuirty Password//Case Secuirty Password//Case Secuirty Password//Case Secuirty Password
  function saveSecurity() {
      const logoutURL = "<?php echo $this->Html->url(array('controller' => 'logins', 'action' => 'logout')); ?>";
      const oldPassword = document.getElementById('old-password').value;
      const newPassword = document.getElementById('new-password').value;
      const confirmPassword = document.getElementById('confirm-password').value;

      $.ajax({
        type: "POST",
        url: "/MessageBoard/Logins/changePasswordJson", 
        data: {
          'Registers[old_password]': oldPassword,
          'Registers[password]': newPassword,
          'Registers[confirm_password]': confirmPassword
        },
        dataType: 'json',
        success: function(response) {
          if (response.success) {
            Swal.fire({
              title: 'Success!',
              text: response.message,
              icon: 'success',
              confirmButtonText: 'OK'
            }).then(() => {
              window.location= logoutURL;
            });
          } else {
            Swal.fire({
              title: 'Error!',
              text: response.message,
              icon: 'error',
              confirmButtonText: 'Try Again'
            });
          }
        },
        error: function() {
          Swal.fire({
            title: 'Unexpected Error',
            text: 'Something went wrong!',
            icon: 'error',
            confirmButtonText: 'OK'
          });
        }
      });
  }

//Case Privacy //Case Privacy//Case Privacy//Case Privacy//Case Privacy//Case Privacy//Case Privacy//Case Privacy//Case Privacy//Case Privacy//Case Privacy
function savePrivacy() {
    const data = {
        account_type: document.getElementById('account-type').value,
        search_visibility: document.getElementById('search-visibility').value,
        who_can_send_message: document.getElementById('who-can-send-message').value,
        location_sharing: document.getElementById('location-sharing').value,
        timeline_permision: document.getElementById('timeline-permission').value,
        profile_tagging: document.getElementById('profile-tagging').value,
        who_can_see_myfriends: document.getElementById('who-can-see-myfriends').value,
        show_birthday: document.getElementById('show-birthday').value,
        show_location_details: document.getElementById('show-location-details').value,
        show_inrelationship: document.getElementById('show-inrelationship').value,
    };

    fetch('/MessageBoard/UserProfiles/updatePrivacySettings', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Privacy settings updated successfully',
                confirmButtonText: 'OK',
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Failed!',
                text: 'Failed to update privacy settings: ' + data.message,
                confirmButtonText: 'OK',
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'An error occurred while updating privacy settings.',
            confirmButtonText: 'OK',
        });
    });
}




</script>