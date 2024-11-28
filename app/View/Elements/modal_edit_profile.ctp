 <!-- Modal for CREATING POST -->
 <!-- Modal for CREATING POST -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

 <style>
  /* <!-- Dropdown Menu of Post --> */
 /* Style for the dropdown menu */
 .custom-dropdown-menu {
  display: none;
  position: absolute;
  background-color: white;
  border: 1px solid #ddd;
  border-radius: 4px;
  box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
  right: 70mm; 
  width: 220px;
  z-index: 1000;
}

.custom-dropdown-menu ul {
  list-style: none;
  margin: 0;
  padding: 0;
}

.custom-dropdown-menu ul li {
  padding: 10px;
  display: flex;
  align-items: center;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.custom-dropdown-menu ul li:hover {
  background-color: #f1f1f1;
}

.custom-dropdown-menu .icon {
  margin-right: 10px;
  font-size: 18px;
}

/* POP UP REACTIONS*/
/* POP UP REACTIONS*/
/* POP UP REACTIONS*/
/* .actions-buttons {
  display: flex;
  justify-content: center;
  margin-top: 10px;
}
.actions-buttons-list {
  display: flex;
  list-style: none;
  padding: 0;
} */
.actions-buttons-item {
  margin: 0 10px;
  position: relative; /* Required for the reaction popup */
}
.actions-buttons-button {
  background: none;
  border: none;
  cursor: pointer;
  font-size: 16px;
  display: flex;
  align-items: center;
  gap: 5px;
}
.actions-buttons-button .icon {
  font-size: 18px;
}

/* Reactions pop-up styles */
.reactions-popup {
    display: none;
    position: absolute;
    top: 40px; /* Adjust this value to place the popup below the button */
    left: 0;
    background: white;
    border-radius: 25px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    padding: 5px 10px;
    z-index: 10;
    white-space: nowrap;
}

.reactions-popup.active {
    display: flex;
    justify-content: center;
    align-items: center;
}

.reaction-item {
  background: none;
  border: none;
  cursor: pointer;
  font-size: 20px;
  margin: 0 5px;
  transition: transform 0.2s ease;
}
.reaction-item:hover {
  transform: scale(1.2);
}
 </style>

 <div class="modal" id="createPostModal" style="display: none; font-family: Arial, sans-serif; background-color: rgba(0, 0, 0, 0.6);">
    <div class="modal-content" style="background: #ffffff; width: 500px; border-radius: 8px; overflow: hidden; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
        <form action="<?php echo $this->Html->url(['controller' => 'UserProfiles', 'action' => 'createPost']); ?>" method="post" enctype="multipart/form-data">
            <!-- Header -->
            <div class="modal-header" style="background: #1877F2; color: white; padding: 16px; display: flex; justify-content: space-between; align-items: center;">
                <h3 style="margin: 0; font-size: 18px;">Create Post</h3>
                <span class="close-btn" id="closeModalBtn" style="cursor: pointer; font-size: 20px;">&times;</span>
            </div>
            
            <!-- Body -->
            <div class="modal-body" style="padding: 16px;">
                <!-- User Info -->
                <div class="user-info" style="display: flex; align-items: center; margin-bottom: 16px;">
                    <img src="<?php echo $this->Html->url('/' . $findMyPics[0]['Posts']['path']); ?>" alt="User Avatar" class="user-avatar" style="width: 40px; height: 40px; border-radius: 50%; margin-right: 10px;">
                    <div>
                        <span class="user-name" style="font-weight: bold; font-size: 16px;"><?php echo $users[0]['User']['full_name']; ?></span>
                        <select name="data[Posts][privacy]" id="privacySelector" class="privacy-selector" style="display: block; margin-top: 4px; background: #f0f2f5; border: 1px solid #ddd; border-radius: 4px; padding: 4px 8px; font-size: 14px;">
                            <option value="2">🌍 Public</option>
                            <option value="3">👥 Friends</option>
                            <option value="1">🔒 Only Me</option>
                        </select>
                    </div>
                </div>

                <!-- Post Text -->
                <textarea name="data[Posts][captions]" id="postText" placeholder="What's on your mind?" style="width: 100%; height: 80px; border: 1px solid #ddd; border-radius: 8px; padding: 8px; font-size: 14px; resize: none;"></textarea>

                <!-- Image Previews -->
                <div id="imagePreviewContainer" class="image-preview-container" style="margin: 10px 0; display: flex; flex-wrap: wrap; gap: 8px;"></div>

                <!-- Add Options -->
                <div class="add-options" style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap;">
                    <label for="uploadImages" class="upload-label" style="cursor: pointer; display: flex; align-items: center; color: #1877F2; margin-bottom: 8px;">
                        <input type="file" name="data[Posts][file][]" id="uploadImages" multiple accept="image/*" style="display: none;">
                        <span id="click_icon" style="color: black;">
                            <i class="fas fa-camera" style="color: green;"></i> Add Photo/Video
                        </span>
                    </label>
                    
                    <!-- Additional Menu Options -->
                    <div class="menu-options" style="display: flex; flex-wrap: wrap; gap: 8px; margin-top: 10px; width: 100%;">
                    <div class="menu-item" style="display: flex; align-items: center; font-size: 14px; cursor: pointer; color: black;">
                        <i class="fas fa-user-tag" style="margin-right: 8px; color: blue;"></i> Tag People
                    </div>
                    <div class="menu-item" style="display: flex; align-items: center; font-size: 14px; cursor: pointer; color: black;">
                        <i class="fas fa-smile" style="margin-right: 8px;color: yellow;"></i> Feeling/Activity
                    </div>
                    <div class="menu-item" style="display: flex; align-items: center; font-size: 14px; cursor: pointer; color: black;">
                        <i class="fas fa-map-marker-alt" style="margin-right: 8px; color:orange;"></i> Check In
                    </div>
                    <div class="menu-item" style="display: flex; align-items: center; font-size: 14px; cursor: pointer; color: black;">
                        <i class="fas fa-video" style="margin-right: 8px; color: red;"></i> Live Video
                    </div>
                    <div class="menu-item" style="display: flex; align-items: center; font-size: 14px; cursor: pointer; color: black;">
                        <i class="fas fa-palette" style="margin-right: 8px; color: darkgreen;"></i> Background Color
                    </div>
                    <div class="menu-item" style="display: flex; align-items: center; font-size: 14px; cursor: pointer; color: black;">
                        <i class="fas fa-image" style="margin-right: 8px; color: darkgreen;"></i> Gif
                    </div>
                    <div class="menu-item" style="display: flex; align-items: center; font-size: 14px; cursor: pointer; color: black;">
                        <i class="fas fa-star" style="margin-right: 8px; color:blue;"></i> Life Event
                    </div>
                    <div class="menu-item" style="display: flex; align-items: center; font-size: 14px; cursor: pointer; color: black;">
                        <i class="fas fa-music" style="margin-right: 8px; color: orange;"></i> Music
                    </div>
                    <div class="menu-item" style="display: flex; align-items: center; font-size: 14px; cursor: pointer; color: black;">
                        <i class="fas fa-calendar-check" style="margin-right: 8px; color:red;"></i> Tag Event
                    </div>
                    </div>
                </div>
            </div>
            
            <!-- Footer -->
            <div class="modal-footer" style="padding: 16px; display: flex; justify-content: space-between; align-items: center;">
                <a class="cancel-btn" id="cancelPostBtn" style="cursor: pointer; background: #f0f2f5; padding: 8px 16px; border-radius: 4px; text-decoration: none; color: #606770;">Cancel</a>
                <button class="post-btn" id="postBtn" style="background: #1877F2; color: white; padding: 8px 16px; border: none; border-radius: 4px; cursor: pointer;">Post</button>
            </div>
        </form>
    </div>
</div>

<!--------------------------------------- Modal for editing post ----------------------------------------->
<div class="modal" id="editPostModal" style="display: none; font-family: Arial, sans-serif; background-color: rgba(0, 0, 0, 0.6);z-index: 9999;">
    <div class="modal-content" style="background: #ffffff; width: 500px; border-radius: 8px; overflow: hidden; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
        <form action="<?php echo $this->Html->url(['controller' => 'UserProfiles', 'action' => 'editPost']); ?>" method="post" enctype="multipart/form-data">
            <!-- Header -->
            <div class="modal-header" style="background: #1877F2; color: white; padding: 16px; display: flex; justify-content: space-between; align-items: center;">
                <h3 style="margin: 0; font-size: 18px;">Edit Post</h3>
                <span class="close-btn" id="closeEditModalBtn" style="cursor: pointer; font-size: 20px;">&times;</span>
            </div>
            
            <!-- Body -->
            <div class="modal-body" style="padding: 16px;">
                <!-- User Info -->
                <div class="user-info" style="display: flex; align-items: center; margin-bottom: 16px;">
                    <img src="<?php echo $this->Html->url('/' . $findMyPics[0]['Posts']['path']); ?>" alt="User Avatar" class="user-avatar" style="width: 40px; height: 40px; border-radius: 50%; margin-right: 10px;">
                    <div>
                        <span class="user-name" style="font-weight: bold; font-size: 16px;"><?php echo $users[0]['User']['full_name']; ?></span>
                        <select name="data[Posts][privacy]" id="privacyEditSelector" class="privacy-selector" style="display: block; margin-top: 4px; background: #f0f2f5; border: 1px solid #ddd; border-radius: 4px; padding: 4px 8px; font-size: 14px;">
                            <option value="2">🌍 Public</option>
                            <option value="3">👥 Friends</option>
                            <option value="1">🔒 Only Me</option>
                        </select>
                    </div>
                </div>

                <!-- Post Text -->
                <input type="hidden" id="postEditID" name="data[Posts][id]">
                <textarea name="data[Posts][captions]" id="postEditText" placeholder="What's on your mind?" style="width: 100%; height: 80px; border: 1px solid #ddd; border-radius: 8px; padding: 8px; font-size: 14px; resize: none;"></textarea>

                <!-- Image Previews -->
                <div id="imageEditPreviewContainer" class="image-preview-container" style="margin: 10px 0; display: flex; flex-wrap: wrap; gap: 8px;"></div>

                <!-- Add Options -->
                <div class="add-options" style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap;">
                    <label for="uploadEditImages" class="upload-label" style="cursor: pointer; display: flex; align-items: center; color: #1877F2; margin-bottom: 8px;">
                        <input type="file" name="data[Posts][file][]" id="uploadEditImages" multiple accept="image/*" style="display: none;">
                        <span id="click_edit_icon" style="color: black;">
                            <i class="fas fa-camera" style="color: green;"></i> Add Photo/Video
                        </span>
                    </label>
                    
                    <!-- Additional Menu Options -->
                    <div class="menu-options" style="display: flex; flex-wrap: wrap; gap: 8px; margin-top: 10px; width: 100%;">
                    <div class="menu-item" style="display: flex; align-items: center; font-size: 14px; cursor: pointer; color: black;">
                        <i class="fas fa-user-tag" style="margin-right: 8px; color: blue;"></i> Tag People
                    </div>
                    <div class="menu-item" style="display: flex; align-items: center; font-size: 14px; cursor: pointer; color: black;">
                        <i class="fas fa-smile" style="margin-right: 8px;color: yellow;"></i> Feeling/Activity
                    </div>
                    <div class="menu-item" style="display: flex; align-items: center; font-size: 14px; cursor: pointer; color: black;">
                        <i class="fas fa-map-marker-alt" style="margin-right: 8px; color:orange;"></i> Check In
                    </div>
                    <div class="menu-item" style="display: flex; align-items: center; font-size: 14px; cursor: pointer; color: black;">
                        <i class="fas fa-video" style="margin-right: 8px; color: red;"></i> Live Video
                    </div>
                    <div class="menu-item" style="display: flex; align-items: center; font-size: 14px; cursor: pointer; color: black;">
                        <i class="fas fa-palette" style="margin-right: 8px; color: darkgreen;"></i> Background Color
                    </div>
                    <div class="menu-item" style="display: flex; align-items: center; font-size: 14px; cursor: pointer; color: black;">
                        <i class="fas fa-image" style="margin-right: 8px; color: darkgreen;"></i> Gif
                    </div>
                    <div class="menu-item" style="display: flex; align-items: center; font-size: 14px; cursor: pointer; color: black;">
                        <i class="fas fa-star" style="margin-right: 8px; color:blue;"></i> Life Event
                    </div>
                    <div class="menu-item" style="display: flex; align-items: center; font-size: 14px; cursor: pointer; color: black;">
                        <i class="fas fa-music" style="margin-right: 8px; color: orange;"></i> Music
                    </div>
                    <div class="menu-item" style="display: flex; align-items: center; font-size: 14px; cursor: pointer; color: black;">
                        <i class="fas fa-calendar-check" style="margin-right: 8px; color:red;"></i> Tag Event
                    </div>
                    </div>
                </div>
            </div>
            
            <!-- Footer -->
            <div class="modal-footer" style="padding: 16px; display: flex; justify-content: space-between; align-items: center;">
                <a class="cancel-btn" id="cancelEditPostBtn" style="cursor: pointer; background: #f0f2f5; padding: 8px 16px; border-radius: 4px; text-decoration: none; color: #606770;">Cancel</a>
                <button class="post-btn" id="postBtn" style="background: #1877F2; color: white; padding: 8px 16px; border: none; border-radius: 4px; cursor: pointer;">Post</button>
            </div>
        </form>
    </div>
</div><!---------------------------------------END Modal for editing post ----------------------------------------->

<!--------------------------------------- Modal for editing profile details ----------------------------------------->
<form method="post" action="<?php echo $this->Html->url(array('controller' => 'UserProfiles', 'action' => 'editDetails')); ?>" enctype="multipart/form-data">
<div id="editProfileModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.6); z-index: 1000;">
  <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; width: 90%; max-width: 700px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); font-family: 'Segoe UI', Tahoma, Geneva, sans-serif;">
    <div style="padding: 20px 30px; border-bottom: 2px solid #f0f2f5; display: flex; justify-content: space-between; align-items: center; background: linear-gradient(135deg, #1877f2, #3b5998); color: white; border-top-left-radius: 10px; border-top-right-radius: 10px;">
      <h5 style="margin: 0; font-size: 18px; font-weight: bold;">Edit Profile Details</h5>
      <button id="close-ModalBtn" style="background: none; border: none; font-size: 24px; cursor: pointer; color: white;">&times;</button>
    </div>
    <div style="padding: 30px; display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px;">
    
      <!-- Full Name -->
      <div style="margin-bottom: 20px;">
        <label for="full_name" style="display: block; font-size: 14px; color: #333; margin-bottom: 5px;">Full Name:</label>
        <input type="text" id="full_name" name="full_name" style="width: 100%; padding: 10px; font-size: 14px; border: 1px solid #ccc; border-radius: 5px;" value="<?php echo isset($userProfileData[0]['UserProfiles']['full_name']) ? $userProfileData[0]['UserProfiles']['full_name'] : ''; ?>">
      </div>

      <!-- Hobby -->
      <div style="margin-bottom: 20px;">
        <label for="hobby" style="display: block; font-size: 14px; color: #333; margin-bottom: 5px;">Hobby:</label>
        <textarea id="hobby" name="hobby" rows="4" maxlength="60" 
                  style="width: 100%; padding: 10px; font-size: 14px; border: 1px solid #ccc; border-radius: 5px;" oninput="updateCharCount()"><?php echo htmlspecialchars($userProfileData[0]['UserProfiles']['hobby'], ENT_QUOTES, 'UTF-8'); ?></textarea>
        <small id="charCount" style="font-size: 12px; color: #888;">60 characters remaining</small>
      </div>

      <!-- Birthday -->
      <div style="margin-bottom: 20px;">
        <label for="birthdate" style="display: block; font-size: 14px; color: #333; margin-bottom: 5px;">Birthday:</label>
        <input type="date" id="birthdate" name="birthdate" style="width: 100%; padding: 10px; font-size: 14px; border: 1px solid #ccc; border-radius: 5px;" value="<?php echo date('Y-m-d', strtotime($userProfileData[0]['UserProfiles']['birthdate'])); ?>">
      </div>

      <!-- Gender -->
      <div style="margin-bottom: 20px;">
        <label for="gender" style="font-size: 14px; color: #333; display: block; margin-bottom: 5px;">Gender:</label>
        <div>
          <label style="font-size: 14px; margin-right: 20px;">
            <input type="radio" name="gender" value="Male" <?php echo ($userProfileData[0]['UserProfiles']['gender'] == 'Male') ? 'checked' : ''; ?>> Male
          </label>
          <label style="font-size: 14px;">
            <input type="radio" name="gender" value="Female" <?php echo ($userProfileData[0]['UserProfiles']['gender'] == 'Female') ? 'checked' : ''; ?>> Female
          </label>
        </div>
      </div>

      <!-- Location -->
      <div style="margin-bottom: 20px;">
        <label for="location" style="display: block; font-size: 14px; color: #333; margin-bottom: 5px;">Location:</label>
        <input type="text" id="location" name="location" style="width: 100%; padding: 10px; font-size: 14px; border: 1px solid #ccc; border-radius: 5px;" value="<?php echo isset($userProfileData[0]['UserProfiles']['location']) ? $userProfileData[0]['UserProfiles']['location'] : ''; ?>">
      </div>

      <!-- Work -->
      <div style="margin-bottom: 20px;">
        <label for="work" style="display: block; font-size: 14px; color: #333; margin-bottom: 5px;">Work:</label>
        <input type="text" id="work" name="work" style="width: 100%; padding: 10px; font-size: 14px; border: 1px solid #ccc; border-radius: 5px;" value="<?php echo isset($userProfileData[0]['UserProfiles']['work']) ? $userProfileData[0]['UserProfiles']['work'] : ''; ?>">
      </div>

      <!-- Education -->
      <div style="margin-bottom: 20px;">
        <label for="education" style="display: block; font-size: 14px; color: #333; margin-bottom: 5px;">Education:</label>
        <input type="text" id="education" name="education" style="width: 100%; padding: 10px; font-size: 14px; border: 1px solid #ccc; border-radius: 5px;" value="<?php echo isset($userProfileData[0]['UserProfiles']['education']) ? $userProfileData[0]['UserProfiles']['education'] : ''; ?>">
      </div>

      <!-- Links -->
      <div style="margin-bottom: 20px;">
        <label for="links" style="display: block; font-size: 14px; color: #333; margin-bottom: 5px;">Links:</label>
        <input type="text" id="links" name="links" style="width: 100%; padding: 10px; font-size: 14px; border: 1px solid #ccc; border-radius: 5px;" value="<?php echo isset($userProfileData[0]['UserProfiles']['links']) ? $userProfileData[0]['UserProfiles']['links'] : ''; ?>">
      </div>

      <!-- Relationship -->
      <div style="margin-bottom: 20px;">
        <label for="relationship" style="display: block; font-size: 14px; color: #333; margin-bottom: 5px;">Relationship:</label>
        <input type="text" id="relationship" name="relationship" style="width: 100%; padding: 10px; font-size: 14px; border: 1px solid #ccc; border-radius: 5px;" value="<?php echo isset($userProfileData[0]['UserProfiles']['relationship']) ? $userProfileData[0]['UserProfiles']['relationship'] : ''; ?>">
      </div>

    </div>
    <div style="text-align: center; padding: 20px; border-top: 2px solid #f0f2f5;">
      <button type="submit" style="background: #1877f2; color: white; padding: 12px 20px; border: none; border-radius: 5px; cursor: pointer; font-weight: bold; transition: background-color 0.3s;">
        <i class="fas fa-save"></i> Save Changes
      </button>
    </div>
  </div>
</div>
</form>

<!--------------------------------------- Modal for Edit Privacy ----------------------------------------->
<!-- Modal -->
<div id="changePrivacyModal" style="display:none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0, 0, 0, 0.5); z-index: 9999; display: none; justify-content: center; align-items: center;">
    <div class="modal-content" style="background-color: white; width: 400px; padding: 20px; border-radius: 10px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">
        <span id="closePrivacyModal" style=" float:right; cursor: pointer;color: black;">×</span>
        <h2 style="text-align: center; color: black;font-size: 20px;">Change Audience</h2>

        <form id="privacyForm">
            <div style="margin-bottom: 10px;">
                <label style="font-size: 16px;">
                    <input type="radio" name="privacy" value="2" id="public" /> 
                    <span style="color: black;">Public</span>
                </label>
            </div>
            <div style="margin-bottom: 10px;">
                <label style="font-size: 16px;">
                    <input type="radio" name="privacy" value="3" id="friends" /> 
                    <span style="color: black;">Friends</span>
                </label>
            </div>
            <div style="margin-bottom: 20px;">
                <label style="font-size: 16px;">
                    <input type="radio" name="privacy" value="1" id="onlyMe" /> 
                    <span style="color: black;">Only Me</span>
                </label>
            </div>
            <button type="submit" style="width: 100%; background-color: #1877F2; color: white; padding: 10px; border: none; border-radius: 5px; font-size: 16px; cursor: pointer;">
                Done
            </button>
        </form>
    </div>
</div>
<!--------------------------------------- [END] Modal for Edit Privacy ----------------------------------------->

<script>

  // <!-- Dropdown Menu of Post -->
 function toggleCustomDropdown(event, postId) {
        var dropdown = document.getElementById('custom-dropdown-menu-' + postId);
        event.stopPropagation();
        dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
    }

    // Close dropdown if clicked outside
    document.addEventListener('click', function(event) {
        var dropdowns = document.querySelectorAll('.custom-dropdown-menu');
        dropdowns.forEach(function(dropdown) {
            if (!dropdown.contains(event.target) && !dropdown.previousElementSibling.contains(event.target)) {
                dropdown.style.display = 'none';
            }
        });
    });

    // Close dropdowns on scroll
    window.addEventListener('scroll', function() {
        var dropdowns = document.querySelectorAll('.custom-dropdown-menu');
        dropdowns.forEach(function(dropdown) {
            dropdown.style.display = 'none';
        });
    });
    // <!-- END OF Dropdown Menu of Post -->

//--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------

  //ARCHIEVE Post
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.toggle-archieve-post').forEach(function (element) {
        element.addEventListener('click', function () {
            const postId = this.getAttribute('data-post-id');
            const isArchieve = this.getAttribute('data-is-archieve');

            // Toggle isArchieve value
            const newArchieveStatus = isArchieve === '1' ? 0 : 1;

            // Send the data to the controller
            fetch('/MessageBoard/toggleArchieve', {
                method: 'POST',
                body: JSON.stringify({
                    post_id: postId,
                    is_archieve: newArchieveStatus
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

//--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------

  //Move to trash Post
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.toggle-trash-post').forEach(function (element) {
        element.addEventListener('click', function () {
            const postId = this.getAttribute('data-post-id');

            // Send the data to the controller
            fetch('/MessageBoard/toggleTrash', {
                method: 'POST',
                body: JSON.stringify({
                    post_id: postId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.reload();
                } else {
                    alert('Failed to move to trash.');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
});

//--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------


// Get references to the modal and its components
const editPostModal = document.getElementById('editPostModal');
const closeEditModalBtn = document.getElementById('closeEditModalBtn');
const cancelEditPostBtn = document.getElementById('cancelEditPostBtn');
const postTextArea = document.getElementById('postEditText'); 
const postID = document.getElementById('postEditID'); 
const privacySelector = document.getElementById('privacyEditSelector'); 
const imagePreviewContainer = document.getElementById('imageEditPreviewContainer'); 

// Open Edit Modal for a specific post
document.querySelectorAll('.edit-post').forEach((button) => {
    button.addEventListener('click', async function () {
        const postId = this.getAttribute('data-post-id');
        
        try {
            const response = await fetch(`/MessageBoard/UserProfiles/getPostDetails/${postId}`);
            const postDetails = await response.json();

            if (response.ok && postDetails.success) {

                postTextArea.value = postDetails.data.captions;
                privacySelector.value = postDetails.data.privacy;
                postID.value = postDetails.data.id;

                // Clear previous image previews
                imagePreviewContainer.innerHTML = '';

                // Parse file_paths into an array
                const filePaths = JSON.parse(postDetails.data.file_paths);

                // Add new image previews
                    if (Array.isArray(filePaths)) {
                        filePaths.forEach((filePath, index) => {
                          const imageWrapper = document.createElement('div');
                          imageWrapper.classList.add('image-preview');
                          console.log('filePath:', filePath);
                          const img = document.createElement('img');
                          img.src = filePath;
                          img.alt = 'Existing Image';
                          img.style.width = '100px';
                          img.style.height = '100px';
                          img.style.objectFit = 'cover';
                          img.style.borderRadius = '8px';

                          const removeBtn = document.createElement('span');
                          removeBtn.textContent = '×';
                          removeBtn.classList.add('remove-btn');

                          // Remove existing image on click
                          removeBtn.addEventListener('click', function () {
                              filePaths.splice(index, 1); // Remove from filePaths array
                              imageWrapper.remove(); // Remove from UI
                          });

                          imageWrapper.appendChild(img);
                          imageWrapper.appendChild(removeBtn);
                          imagePreviewContainer.appendChild(imageWrapper);
                      });
                  }

                // Display the modal
                editPostModal.style.display = 'flex';
            } else {
                alert('Failed to load post details. Please try again.');
            }
        } catch (error) {
            console.error('Error fetching post details:', error);
            alert('An error occurred while fetching the post details.');
        }
    });
});

// Close Edit Modal
closeEditModalBtn.addEventListener('click', () => {
    editPostModal.style.display = 'none';
});

cancelEditPostBtn.addEventListener('click', () => {
    editPostModal.style.display = 'none';
});

//--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------
// [EDIT] Image upload and preview logic
document.addEventListener('DOMContentLoaded', function () {
    const uploadImages = document.getElementById('uploadEditImages');
    const uploadIcon = document.getElementById('click_edit_icon');
    const imagePreviewContainer = document.getElementById('imageEditPreviewContainer');
    const form = uploadImages.closest('form');

    const maxImages = 5;
    let selectedFiles = [];

    // Simulate clicking the hidden file input
    uploadIcon.addEventListener('click', function () {
        uploadImages.click();
    });

    // Handle file input changes
    uploadImages.addEventListener('change', function () {
        const files = Array.from(this.files);

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
                    image.alt = 'Preview';
                    image.style.width = '100px';
                    image.style.height = '100px';
                    image.style.objectFit = 'cover';
                    image.style.borderRadius = '8px';

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

    // Handle form submission
    form.addEventListener('submit', function (event) {
            const postText = postTextArea.value.trim();
            const dataTransfer = new DataTransfer();

            if (postText === '' && selectedFiles.length === 0) {
                event.preventDefault();
                alert('Please write something before posting.');
                return;
            }

            selectedFiles.forEach((file) => {
                dataTransfer.items.add(file);
            });

            uploadImages.files = dataTransfer.files;
        });
    });

    //--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------
document.querySelectorAll('.edit-privacy').forEach((button) => {
    button.addEventListener('click', async function () {
        const postId = this.getAttribute('data-post-id');

        try {
            const response = await fetch(`/MessageBoard/UserProfiles/getPostDetails/${postId}`);
            const postDetails = await response.json();

            if (response.ok && postDetails.success) {
                // Set the privacy option in the modal based on current privacy
                const privacyValue = postDetails.data.privacy;

                // Set the radio buttons based on the current privacy
                document.querySelector(`#public`).checked = privacyValue == 2;
                document.querySelector(`#friends`).checked = privacyValue == 3;
                document.querySelector(`#onlyMe`).checked = privacyValue == 1;

                // Show the modal
                document.getElementById('changePrivacyModal').style.display = 'flex';

                // Close the modal when clicking on the close button
                document.getElementById('closePrivacyModal').addEventListener('click', function () {
                    document.getElementById('changePrivacyModal').style.display = 'none';
                });

                // Handle the form submission
                document.getElementById('privacyForm').addEventListener('submit', async (e) => {
                    e.preventDefault();

                    const selectedPrivacy = document.querySelector('input[name="privacy"]:checked').value;

                    const updateResponse = await fetch(`/MessageBoard/UserProfiles/updatePostPrivacy`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            post_id: postId,
                            privacy: selectedPrivacy
                        })
                    });

                    const updateResult = await updateResponse.json();
                    if (updateResult.success) {
                        window.location.reload();
                        document.getElementById('changePrivacyModal').style.display = 'none';
                    } else {
                        alert('Failed to update privacy');
                    }
                });
            } else {
                alert('Failed to load post details.');
            }
        } catch (error) {
            console.error('Error fetching post details:', error);
            alert('An error occurred while fetching the post details.');
        }
    });
});

//--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------

// Update the character count dynamically
function updateCharCount() {
    const textarea = document.getElementById('hobby');
    const charCount = document.getElementById('charCount');
    const remaining = 60 - textarea.value.length;
    charCount.textContent = `${remaining} characters remaining`;
}

//--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------
//FOR REACTIONS

document.addEventListener('DOMContentLoaded', function () {
    // Event listener for each "Like" button
    document.querySelectorAll('.toggle-reactions').forEach((reactionButton) => {
        reactionButton.addEventListener('click', function (e) {
            e.stopPropagation();

            const postId = this.getAttribute('data-post-id');
            const reactionsPopup = document.getElementById(`reactions-popup-${postId}`);

            // Toggle the visibility of the reactions popup
            reactionsPopup.classList.toggle('active');
        });
    });

    // Event listener for each reaction button
    document.querySelectorAll('.reaction-item').forEach((reactionButton) => {
        reactionButton.addEventListener('click', function (e) {
            e.stopPropagation();

            const postId = this.getAttribute('data-post-id');
            const userId = this.getAttribute('data-user-id');
            const reactionType = this.getAttribute('data-reaction');

            // Send reaction data to server
            fetch('/MessageBoard/Reactions/saveReaction', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    user_id: userId,
                    profile_post_id: postId,
                    reaction_type: reactionType,
                }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    
                } else {
                    alert('Failed to save reaction.');
                }
                const reactionsPopup = document.getElementById(`reactions-popup-${postId}`);
                reactionsPopup.classList.remove('active'); // Close the popup after selecting a reaction
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred.');
            });
        });
    });
});


  //--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------
//See more and see less function
function toggleCaption(postId) {
        const truncated = document.getElementById('truncated-caption-' + postId);
        const full = document.getElementById('full-caption-' + postId);

        if (truncated.style.display === 'none') {
            truncated.style.display = '';
            full.style.display = 'none';
        } else {
            truncated.style.display = 'none';
            full.style.display = '';
        }
    }


</script>