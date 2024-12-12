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

/* SHARE MODAL */
/* SHARE MODAL */
/* SHARE MODAL */

/* Modal Background */
.share-modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 1000;
    justify-content: center;
    align-items: center;
}

/* Modal Content */
.share-modal-content {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    width: 300px;
    text-align: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Close Button */
.close-modal {
    background: none;
    border: none;
    font-size: 24px;
    color: #888;
    position: absolute;
    top: 10px;
    right: 10px;
    cursor: pointer;
}

.close-modal:hover {
    color: #333;
}

/* Share Options List */
.share-options {
    list-style-type: none;
    padding: 0;
    margin: 20px 0 0 0;
}

.share-option {
    display: block;
    background-color: #4267B2; /* Facebook Blue */
    color: white;
    padding: 10px;
    margin: 5px 0;
    border: none;
    width: 100%;
    text-align: left;
    cursor: pointer;
    border-radius: 5px;
    font-size: 14px;
    font-weight: 500;
}

.share-option i {
    margin-right: 10px;
}

.share-option:hover {
    background-color: #365899;
}

/* Facebook Blue Button Hover */
.share-option:active {
    background-color: #2a4d79;
}


/* Success Modal Styling*/
/* Success Modal Styling*/
/* Success Modal Styling*/

/* Success Modal Styling */
.success-modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 1000;
}

.success-modal-content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: #1877f2;
    color: white;
    border-radius: 10px;
    padding: 30px;
    text-align: center;
    width: 300px;
}

.success-modal-content h2 {
    margin-bottom: 15px;
    font-size: 20px;
}

.success-modal-content p {
    font-size: 14px;
}

.success-modal .close-modal {
    position: absolute;
    top: 10px;
    right: 10px;
    color: white;
    background: none;
    border: none;
    font-size: 20px;
    cursor: pointer;
}

#close-success-btn {
    background-color: #3b5998;
    color: white;
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    font-size: 14px;
    border-radius: 5px;
    margin-top: 15px;
}

#close-success-btn:hover {
    background-color: #2d4373;
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
                <textarea name="data[Posts][sharer_caption]" id="postEditTextSharer" placeholder="What's on your mind?" style="width: 100%; height: 80px; border: 1px solid #ddd; border-radius: 8px; padding: 8px; font-size: 14px; resize: none;"></textarea>

                <!-- Image Previews -->
                <div id="imageEditPreviewContainer" class="image-preview-container" style="margin: 10px 0; display: flex; flex-wrap: wrap; gap: 8px;"></div>

                <!-- Add Options -->
                <div class="add-options" id="addOptionsEdit" style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap;">
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

<!--------------------------------------- [START] Modal for  Success----------------------------------------->
<!-- Success Modal -->
<div id="success-modal" class="success-modal">
    <div class="success-modal-content">
        <button class="close-modal" id="close-success-modal">&times;</button>
        <h2>Post Shared to Facebook!</h2>
        <p>Your post has been successfully shared to Facebook.</p>
        <button id="close-success-btn">Close</button>
    </div>
</div>
<!--------------------------------------- [END] Modal for  Success----------------------------------------->

<!--------------------------------------- [START] Modal for Who Shared The Post----------------------------------------->
<div id="who_share_this_post" style="display:none;">
    <div id="who_share_this_post_content" style="background-color: white; color: white; border-radius: 8px; padding: 20px;">
        <span id="close_who_share_this_post" style="color: black; float: right; font-size: 20px; cursor: pointer;">&times;</span>
        <h2 style="color: black;">People Who Shared This</h2>
        <p id="postTitle" style="margin-bottom: 20px; color: black;"></p>
        <ul id="sharedUsersList" style="list-style: none; padding: 0; max-height: 300px; overflow-y: auto; color: black;">
            <!-- User list will be dynamically populated here -->
        </ul>
    </div>
</div>

<!--------------------------------------- [END] Modal for Who Shared The Post----------------------------------------->

<!--------------------------------------- [START] Modal for displaying reactions----------------------------------------->
<div id="modal_shows_who_react" class="modal_who_react" style="display: none;">
    <div class="modal_who_react_content">
        <span class="close-modal" id="closeModalWhoReact">&times;</span>
        <div id="reactionsList"></div> <!-- List of users and reactions -->
    </div>
</div>
<!--------------------------------------- [END] Modal for displaying reactions----------------------------------------->

<!--------------------------------------- [START] Modal for making Comments----------------------------------------->

<div id="commentModal" style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5);">
  <div id="commentModalContent" style="background-color: #ffffff; color: #000; border-radius: 8px; padding: 20px; width: 90%; max-width: 500px; margin: auto; margin-top: 10%; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);">
    <button id="closeCommentModal" style="float: right; background: none; border: none; font-size: 20px; font-weight: bold; cursor: pointer;">&times;</button>
    <h2 style="color: #1877f2;">Comments</h2>
    <div id="commentList" style="max-height: 300px; overflow-y: auto; margin-top: 10px; border: 1px solid #ccc; border-radius: 8px; padding: 10px;">
      <!-- Example content -->
      <p>Example comment 1</p>
      <p>Example comment 2</p>
      <p>Example comment 3</p>
      <!-- More comments will go here -->
    </div>
    <textarea id="commentInput" placeholder="Write a comment..." style="width: 100%; margin-top: 10px; padding: 10px; border-radius: 8px; border: 1px solid #ccc;"></textarea>
    <!-- Container for image preview -->
    <div id="imagePreviewContainerComment" style="display: none; margin-top: 10px;"></div>
    <div id="commentActions" style="display: flex; align-items: center; justify-content: space-between; margin-top: 10px;">
      <div style="display: flex; gap: 15px; align-items: center; color: grey;">
        <input type="text" id="postId" hidden>
        <input type="file" id="fileInputComment" accept="image/*" style="display: none;"/>
        <button id="uploadImageButton" style="background: none; border: none; cursor: pointer;">
          <i class="fas fa-camera"></i>
        </button>
        <button id="gifButton" style="background: none; border: none; cursor: pointer;">
          <i class="fas fa-film"></i>
        </button>
        <button id="emojiButton" style="background: none; border: none; cursor: pointer;">
          <i class="fas fa-smile"></i>
        </button>
      </div>
      <button id="postCommentButton" style="background-color: #1877f2; color: white; padding: 10px 15px; border: none; border-radius: 8px; cursor: pointer;">Post Comment</button>
    </div>
  </div>
</div>

<!--------------------------------------- [END] Modal for making Comments----------------------------------------->

<!--------------------------------------- [START] Modal for Adding Story Modal for Adding Story----------------------------------------->
<!-- Modal for Adding Story -->
<form method="post" action="<?php echo $this->Html->url(array('controller' => 'MyDayStory', 'action' => 'addStory')); ?>" enctype="multipart/form-data" id="addStoryForm">
<div id="addStoryModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 9999; align-items: center; justify-content: center;">
    <div id="myStoryIdForDarkmode" style="background: white; width: 400px; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);">
        <!-- Modal Header -->
        <div style="display: flex; align-items: center; justify-content: space-between; padding: 10px 15px; border-bottom: 1px solid #ddd;">
            <h3 style="margin: 0; font-size: 16px; font-weight: bold; color: #333;">Add Story</h3>
            <a onclick="closeAddStoryModal()" style="background: none; border: none; font-size: 18px; color: #555; cursor: pointer;">&times;</a>
        </div>

        <!-- Modal Content -->
        <div style="padding: 15px; text-align: center;">
            <!-- Add Photo or Video with Preview -->
            <label for="storyImageUpload" style="cursor: pointer; display: inline-block; background-color: #f0f2f5; border: 1px dashed #ccc; border-radius: 8px; padding: 20px; font-size: 14px; color: #555; width: 100%; max-width: 250px; margin: 0 auto;">
                <img  src="<?php echo $this->Html->url('/' . $findMyPic['Posts']['path']); ?>" alt="Add" style="width: 50px; height: 50px; margin-bottom: 10px;">
                <span style="display: block;">Upload Photo/Video</span>
                <input type="file" id="storyImageUpload" name="data[MyDayStory][file]" style="display: none;" accept="image/*,video/*">
                
                <!-- Image or Video Preview Section -->
                <div id="storyPreview" style="margin-top: 15px; display: none;">
                    <img id="storyPreviewImage" src="" alt="Story Preview" style="max-width: 100%; max-height: 200px; border-radius: 8px; object-fit: cover;">
                </div>
            </label>
        </div>

        <!-- Modal Footer -->
        <div style="padding: 10px 15px; border-top: 1px solid #ddd; display: flex; justify-content: flex-end;">
            <a onclick="closeAddStoryModal()" id="closeStoryModalForDarkmode" style="background-color: #e4e6eb; border: none; padding: 8px 15px; border-radius: 6px; font-size: 14px; margin-right: 10px; cursor: pointer;">Cancel</a>
            <button onclick="submitStory()" style="background-color: #1877f2; color: white; border: none; padding: 8px 15px; border-radius: 6px; font-size: 14px; cursor: pointer;" disabled id="submitStoryButton">Share Story</button>
        </div>
    </div>
</div>
</form>
<!--------------------------------------- [END] Modal for Adding Story Modal for Adding Story----------------------------------------->

<!--------------------------------------- [START] Modal for Birthday Celebrants Details ----------------------------------------->

    <!-- Modal for Birthday Celebrants Details -->
    <div id="birthdayModal" style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0, 0, 0, 0.5); padding: 20px; z-index: 1000;">
        <div id="birthdayModalContent" style="background: #fff; padding: 20px; border-radius: 8px; max-width: 500px; margin: 0 auto;">
            <h3>Birthday Celebrants</h3>
            <div id="birthdayCelebrantsList" style="margin-bottom: 20px;"></div>
            <button onclick="closeBirthdayModal()" style="padding: 5px 10px; background-color: #007bff; color: #fff; border: none; border-radius: 5px;">Close</button>
        </div>
    </div>
<!--------------------------------------- [END] Modal for Birthday Celebrants Details ----------------------------------------->


<script>
    
//--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------

   // Array of real existing ads
   const adsData = [
    {
        url: "https://www.canva.com",
        image: "data:image/jpeg;base64,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",
        title: "Create Stunning Designs with Canva",
        site: "canva.com"
    },
    {
        url: "https://www.udemy.com",
        image: "data:image/png;base64,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",
        title: "Master New Skills with Online Courses",
        site: "udemy.com"
    },
    {
        url: "https://www.wix.com",
        image: "data:image/png;base64,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",
        title: "Build Your Website with Wix",
        site: "wix.com"
    },
    {
        url: "https://www.codecademy.com",
        image: "data:image/png;base64,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",
        title: "Learn to Code with Codecademy",
        site: "codecademy.com"
    },
    {
        url: "https://www.spotify.com",
        image: "data:image/jpeg;base64,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",
        title: "Stream Music with Spotify",
        site: "spotify.com"
    },
    {
        url: "https://www.hellofresh.com",
        image: "data:image/png;base64,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",
        title: "Get Fresh Ingredients Delivered to Your Door",
        site: "hellofresh.com"
    },
    {
        url: "https://www.blueapron.com",
        image: "data:image/jpeg;base64,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",
        title: "Delicious Meal Kits from Blue Apron",
        site: "blueapron.com"
    },
    {
        url: "https://www.grubhub.com",
        image: "data:image/png;base64,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",
        title: "Order Food Delivery from Your Favorite Restaurants",
        site: "grubhub.com"
    },
    {
        url: "https://www.freshdirect.com",
        image: "data:image/png;base64,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",
        title: "Fresh Groceries Delivered to Your Door",
        site: "freshdirect.com"
    },
    {
        url: "https://www.sweetgreen.com",
        image: "data:image/jpeg;base64,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",
        title: "Healthy, Delicious Salads with Sweetgreen",
        site: "sweetgreen.com"
    }
];


    // Function to load random ads
    function loadRandomAds() {
        // Get a random ad from the adsData array
        const randomAds = [];
        for (let i = 0; i < 2; i++) {
            const randomIndex = Math.floor(Math.random() * adsData.length);
            randomAds.push(adsData[randomIndex]);
        }

        // Clear the existing ads
        const adsList = document.getElementById('ads-list');
        adsList.innerHTML = '';

        // Display the random ads
        randomAds.forEach(ad => {
            const li = document.createElement('div');
            li.classList.add('common-list-item');
            li.innerHTML = `
                <a href="${ad.url}" class="common-list-button is-ads">
                    <div class="image"><img src="${ad.image}" width="115" alt=""></div>
                    <div class="text">
                        <h4 class="ads-title" style="font-size: 15px;">${ad.title}</h4> 
                        <p class="ads-url" >${ad.site}</p>
                    </div>
                </a>
            `;
            adsList.appendChild(li);
        });
    }

    // Load random ads on page load
    window.onload = loadRandomAds;



//--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------
// Show the modal when the notification is clicked
function showBirthdayModal() {
    const celebrants = <?php echo json_encode($BirthdayCelebrant); ?>;
    let celebrantList = '';
    
    celebrants.forEach(function(celebrant) {
        // Calculate age
        const birthdate = new Date(celebrant.birthdate);
        const age = new Date().getFullYear() - birthdate.getFullYear();

        // Create celebrant's details
        celebrantList += `
            <div style="display: flex; align-items: center; margin-bottom: 10px;">
                <img src="<?php echo $this->Html->url('/'); ?>${celebrant.profile_picture}" alt="${celebrant.full_name}" style="width: 40px; height: 40px; border-radius: 50%; margin-right: 10px;">
                <div>
                    <strong>${celebrant.full_name}</strong><br>
                    <span>${age} years old</span>
                </div>
            </div>
        `;
    });

    document.getElementById('birthdayCelebrantsList').innerHTML = celebrantList;
    document.getElementById('birthdayModal').style.display = 'block';
}

// Close the modal
function closeBirthdayModal() {
    document.getElementById('birthdayModal').style.display = 'none';
}

//--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------

// Function to open the modal with the image, profile picture, full name, and start the timer
function openModal(imageSrc, profilePic, fullName, date) {
    const modal = document.getElementById("imageModal");
    const modalImage = document.getElementById("modalImage");
    const progressBar = document.getElementById("progressBar");
    const countdownText = document.getElementById("countdown");
    const modalProfilePic = document.getElementById("modalProfilePicture");
    const modalFullName = document.getElementById("modalFullName");
    const dateCreated = document.getElementById("dateCreated");

    // Set the modal's image, profile picture, and full name
    modal.style.display = "flex";
    modalImage.src = imageSrc;
    modalProfilePic.src = profilePic;
    modalFullName.textContent = fullName;
    dateCreated.textContent = timeAgoStory(date);

    // Timer variables
    let remainingTime = 15;
    let progress = 0;
    const totalTime = 15000; // Total time for the progress bar

    // Continuous progress bar effect
    const interval = setInterval(function() {
        progress += 100 / (totalTime / 100);  
        if (progress >= 100) {
            progress = 0; 
        }
        progressBar.style.width = progress + "%";  
    }, 100);

    // Countdown timer for 15 seconds
    const countdownInterval = setInterval(function() {
        remainingTime--;
        countdownText.textContent = remainingTime + " seconds remaining"; 
        if (remainingTime <= 0) {
            clearInterval(countdownInterval); 
            clearInterval(interval);  
            closeModal();  
        }
    }, 1000);  

    // Store intervals in the modal object to clear them later
    modal.interval = interval;
    modal.countdownInterval = countdownInterval;
}

function timeAgoStory(dateString) {

    const now = new Date();
    const past = new Date(dateString);
    const diffInSeconds = Math.floor((now - past) / 1000);

    if (diffInSeconds < 60) {
        return `${diffInSeconds} seconds ago`;
    }
    const diffInMinutes = Math.floor(diffInSeconds / 60);
    if (diffInMinutes < 60) {
        return `${diffInMinutes} minutes ago`;
    }
    const diffInHours = Math.floor(diffInMinutes / 60);
    if (diffInHours < 24) {
        return `${diffInHours} hours ago`;
    }
    return "23 hours ago";
}


// Function to close the modal
function closeModal() {
    const modal = document.getElementById("imageModal");
    clearInterval(modal.interval);  
    clearInterval(modal.countdownInterval);  
    modal.style.display = "none";
}


//--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------

function openAddStoryModal() {
    document.getElementById('addStoryModal').style.display = 'flex';
    document.getElementById('storyPreview').style.display = 'none';
    document.getElementById('submitStoryButton').disabled = true;
}

function closeAddStoryModal() {
    document.getElementById('addStoryModal').style.display = 'none';
}

function submitStory() {
    document.getElementById('addStoryForm').submit();
}

// Preview the uploaded photo or video
document.getElementById('storyImageUpload').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('storyPreview');
    const previewImage = document.getElementById('storyPreviewImage');
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImage.src = e.target.result;
            preview.style.display = 'block';
            document.getElementById('submitStoryButton').disabled = false;
        };
        reader.readAsDataURL(file);
    }
});

//--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------

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
const postTextAreaSharer = document.getElementById('postEditTextSharer'); 
const postID = document.getElementById('postEditID'); 
const privacySelector = document.getElementById('privacyEditSelector'); 
const imagePreviewContainer = document.getElementById('imageEditPreviewContainer'); 
const addOptionsEdit = document.getElementById('addOptionsEdit');

// Open Edit Modal for a specific post
document.querySelectorAll('.edit-post').forEach((button) => {
    button.addEventListener('click', async function () {
        const postId = this.getAttribute('data-post-id');
        const isShared = this.getAttribute('data-is-shared');
        
        try {
            const response = await fetch(`/MessageBoard/UserProfiles/getPostDetails/${postId}`);
            const postDetails = await response.json();

            if (response.ok && postDetails.success) {

                postID.value = postDetails.data.id;
                // Clear previous image previews
                imagePreviewContainer.innerHTML = '';
                postTextArea.value = postDetails.data.captions;
                privacySelector.value = postDetails.data.privacy;

                // Parse file_paths into an array
                const filePaths = JSON.parse(postDetails.data.file_paths);

                // Add new image previews
                if (Array.isArray(filePaths)) {
                    filePaths.forEach((filePath, index) => {
                        const imageWrapper = document.createElement('div');
                        imageWrapper.classList.add('image-preview');
                        console.log('filePath:', filePath);
                        const img = document.createElement('img');
                        img.src = '/MessageBoard/' + filePath;
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
                if (isShared == 1) {
                    postTextAreaSharer.style.display = 'block';
                    postTextArea.style.display = 'none'; 
                    privacySelector.style.display = 'block'; 
                    imagePreviewContainer.style.display = 'none'; 
                    postTextAreaSharer.value = postDetails.data.sharer_caption;
                    addOptionsEdit.style.display = 'none';
                }else{
                    postTextAreaSharer.style.display = 'none'; 
                    postTextArea.style.display = 'block';  
                    privacySelector.style.display = 'block'; 
                    imagePreviewContainer.style.display = 'block'; 
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
            const postTextSharer = postTextAreaSharer.value.trim();
            const dataTransfer = new DataTransfer();

            if (postText === '' && selectedFiles.length === 0 && postTextSharer === '') {
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
//FOR REACTIONS //FOR REACTIONS
//FOR REACTIONS //FOR REACTIONS 
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
                window.location.reload();
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

      //--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------
// Share Modal JS
document.addEventListener('DOMContentLoaded', function() {
    // Open the modal when the Share button is clicked
    document.querySelectorAll('.share-button').forEach(button => {
        button.addEventListener('click', function() {
            const postId = button.getAttribute('data-post-id');
            const shareModal = document.getElementById('share-modal-' + postId);
            shareModal.style.display = 'flex';
        });
    });

    // Close the modal when the close button is clicked
    document.querySelectorAll('.close-modal').forEach(button => {
        button.addEventListener('click', function() {
            const shareModal = button.closest('.share-modal');
            shareModal.style.display = 'none';
        });
    });

    // Close the modal if the user clicks outside of the modal content
    window.addEventListener('click', function(event) {
        if (event.target.classList.contains('share-modal')) {
            event.target.style.display = 'none';
        }
    });
          //--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------

    // When the "Share to Facebook" button is clicked
    document.querySelectorAll('.share-option').forEach(button => {
        button.addEventListener('click', function() {
            const postId = button.getAttribute('data-post-id');
            
            $.ajax({
                url: '/MessageBoard/UserProfiles/sharedPost',
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({ post_id: postId }),
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        const successModal = document.getElementById('success-modal');
                        successModal.style.display = 'flex';
                    } else {
                        alert('Failed to share the post.');
                    }
                },
                error: function() {
                    alert('An error occurred while sharing the post.');
                }
            });
        });
    });

    // Close the success modal when the close button is clicked
    const closeSuccessModalButton = document.getElementById('close-success-modal');
    closeSuccessModalButton.addEventListener('click', function() {
        const successModal = document.getElementById('success-modal');
        successModal.style.display = 'none';
    });

    // Close the success modal when the user clicks the "Close" button inside the modal
    const closeSuccessBtn = document.getElementById('close-success-btn');
    closeSuccessBtn.addEventListener('click', function() {
        const successModal = document.getElementById('success-modal');
        successModal.style.display = 'none';
        window.location.reload();
    });

    // Close the modal if the user clicks outside of the modal content
    window.addEventListener('click', function(event) {
        if (event.target.classList.contains('success-modal')) {
            event.target.style.display = 'none';
        }
    });
});

//--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------
//Who Share this Post Modal
document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("who_share_this_post");
    const modalContent = document.getElementById("who_share_this_post_content");
    const sharedUsersList = document.getElementById("sharedUsersList");
    const postTitle = document.getElementById("postTitle");
    const closeModal = document.getElementById("close_who_share_this_post");

    // Open Modal
    document.querySelectorAll(".view-shares").forEach(link => {
        link.addEventListener("click", function (event) {
            event.preventDefault();
            const postId = this.getAttribute("data-post-id");
            const title = this.getAttribute("data-post-title");

            // Set Post Title
            postTitle.textContent = `Post: "${title}"`;

            // Clear previous list
            sharedUsersList.innerHTML = "<li>Loading...</li>";

            // Fetch Shared Users
            fetch(`/MessageBoard/UserProfiles/getSharedUsers/${postId}`)
            .then(response => response.json())
            .then(data => {
                sharedUsersList.innerHTML = ""; // Clear existing content
                if (data.length > 0) {
                    data.forEach(user => {
                        const listItem = document.createElement("li");
                        listItem.style.display = "flex";
                        listItem.style.alignItems = "center";
                        listItem.style.marginBottom = "10px";

                        // User Profile Picture
                        const profilePicture = document.createElement("img");
                        profilePicture.src = user.profile_picture || "default-profile.jpg"; // Use default if not available
                        profilePicture.alt = `${user.sharer_full_name}'s profile picture`;
                        profilePicture.style.width = "40px";
                        profilePicture.style.height = "40px";
                        profilePicture.style.borderRadius = "50%";
                        profilePicture.style.marginRight = "10px";

                        // User Info
                        const userInfo = document.createElement("div");
                        const name = document.createElement("p");
                        name.textContent = user.sharer_full_name;
                        name.style.margin = "0";
                        name.style.fontWeight = "bold";

                        // Format date_shared
                        const date = new Date(user.date_shared);
                        const formattedDate = date.toLocaleString("en-US", {
                            year: "numeric",
                            month: "long",
                            day: "numeric",
                            hour: "2-digit",
                            minute: "2-digit",
                            hour12: true // Ensures AM/PM format
                        });

                        const dateShared = document.createElement("small");
                        dateShared.textContent = `Shared on ${formattedDate}`;

                        // Privacy Information with Icons
                        const privacy = document.createElement("small");
                        privacy.style.display = "block";
                        if (user.privacy == 1) {
                            privacy.textContent = "🔒 Only Me";
                        } else if (user.privacy == 2) {
                            privacy.textContent = "🌎 Public";
                        } else if (user.privacy == 3) {
                            privacy.textContent = "👥 Friends";
                        }

                        // Append Elements
                        userInfo.appendChild(name);
                        userInfo.appendChild(dateShared);
                        userInfo.appendChild(privacy);
                        listItem.appendChild(profilePicture);
                        listItem.appendChild(userInfo);
                        sharedUsersList.appendChild(listItem);
                    });
                } else {
                    sharedUsersList.innerHTML = "<li>No shares found.</li>";
                }
            })
            .catch(error => {
                console.error("Error fetching shared users:", error);
                sharedUsersList.innerHTML = "<li>Error loading data.</li>";
            });

            // Show Modal
            modal.style.display = "flex";
        });
    });

    // Close Modal
    closeModal.addEventListener("click", () => {
        modal.style.display = "none";
    });

    window.addEventListener("click", (event) => {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });
});

//--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------//--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------
// modal WHO REACT THIS POST
document.querySelectorAll('.showReactionsModal').forEach(button => {
    button.addEventListener('click', async function() {
        const postId = this.getAttribute('data-post-id');
        
        // Fetch reaction data for the post
        try {
            const response = await fetch(`/MessageBoard/Reactions/getReactions/${postId}`);
            const reactionData = await response.json();

            if (reactionData.success) {
                const reactionsList = document.getElementById('reactionsList');
                reactionsList.innerHTML = ''; // Clear previous list

                // Iterate over the reactions and display users
                const reactionMap = {
                    1: 'Like',
                    2: 'Heart',
                    3: 'Care',
                    4: 'Haha',
                    5: 'Wow',
                    6: 'Sad',
                    7: 'Angry'
                };

                    // Initialize an object to store the count of each reaction type
                    const reactionCount = {
                        1: 0, // Like
                        2: 0, // Heart
                        3: 0, // Care
                        4: 0, // Haha
                        5: 0, // Wow
                        6: 0, // Sad
                        7: 0  // Angry
                    };

                    // Update reactionCount based on the reaction data
                    reactionData.reactions.forEach(reaction => {
                        reactionCount[reaction.type]++;
                        
                        const userDiv = document.createElement('div');
                        userDiv.classList.add('reaction-user');
                        userDiv.style.display = 'flex';

                        const reactionType = reactionMap[reaction.type] || 'Unknown';
                        const reactionIcon = getReactionIcon(reaction.type);

                        userDiv.innerHTML = `
                            <img src="${reaction.user.profile_pic}" alt="${reaction.user.name}'s profile picture" class="reaction-profile-pic">
                            <div class="reaction-details" style="flex-grow: 1; display: flex; align-items: center;">
                                <span class="reaction-icon">${reactionIcon}</span>
                                <strong class="reaction-name">${reaction.user.name}</strong>
                            </div>
                            <button class="message-btn">Message</button>
                        `;

                        reactionsList.appendChild(userDiv);
                    });

                    // Create a summary header for the reactions
                    const reactionSummary = document.createElement('div');
                    reactionSummary.classList.add('reaction-summary');
                    reactionSummary.style.marginBottom = '10px';

                    // Display total reactions (All reactions count)
                    const totalReactions = reactionData.reactions.length;
                    reactionSummary.innerHTML = `
                        <span><strong>All</strong> ${totalReactions} reactions  ${Object.keys(reactionCount).map(type => {
                                const count = reactionCount[type];
                                if (count > 0) {
                                    const reactionIcon = getReactionIcon(type);
                                    return `<span>${reactionIcon} ${count}</span>`;
                                }
                             }).join('&nbsp;&nbsp;&nbsp;&nbsp;')}
                    `;

                    reactionsList.insertBefore(reactionSummary, reactionsList.firstChild);


                // Display the modal
                document.getElementById('modal_shows_who_react').style.display = 'flex';
            } else {
                alert('Could not load reactions. Please try again later.');
            }
        } catch (error) {
            console.error('Error fetching reactions:', error);
            alert('An error occurred while loading the reactions.');
        }
    });
});

const modal = document.getElementById('modal_shows_who_react');
const modalContent = document.getElementById('modal_who_react_content');

// Close modal when clicking outside the modal content
modal.addEventListener('click', function(event) {
    if (event.target === modal) {
        modal.style.display = 'none';
    }
});


function getReactionIcon(reactionType) {
    const type = parseInt(reactionType, 10);

    switch(type) {
        case 1: return '<span class="like-icon">👍</span>';  // Like
        case 2: return '<span class="heart-icon">❤️</span>';  // Heart
        case 3: return '<span class="care-icon">🤗</span>';  // Care
        case 4: return '<span class="haha-icon">😂</span>';  // Haha
        case 5: return '<span class="wow-icon">😮</span>';  // Wow
        case 6: return '<span class="sad-icon">😢</span>';  // Sad
        case 7: return '<span class="angry-icon">😡</span>';  // Angry
        default: return '<span>❓</span>';  // Default (Unknown)
    }
}

//--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------//--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------
 //FOR COMMENTS js //FOR COMMENTS js //FOR COMMENTS js //FOR COMMENTS js 
 //FOR COMMENTS js //FOR COMMENTS js //FOR COMMENTS js //FOR COMMENTS js 

 document.addEventListener('click', async function (e) {
  // Check if the clicked element is a comment button
  if (e.target.closest('.comment-button')) {
    const button = e.target.closest('.comment-button');
    const postId = button.getAttribute('data-post-id');
    const postIdValue = document.getElementById('postId'); // this is for post profile id to save

    // Fetch comments for the post
    try {
      const response = await fetch(`/MessageBoard/Comment/getComments/${postId}`);
      const commentData = await response.json();
      postIdValue.value = '';     // this is for post profile id to save
      postIdValue.value = postId; // this is for post profile id to save
      if (Array.isArray(commentData) && commentData.length > 0) {
        const commentList = document.getElementById('commentList');
        commentList.innerHTML = ''; // Clear previous comments

        commentData.forEach(comment => {
            const commentDiv = document.createElement('div');
            commentDiv.style.padding = '10px';
            commentDiv.style.borderBottom = '1px solid #ccc';
            commentDiv.style.display = 'flex';
            commentDiv.style.alignItems = 'center';

            commentDiv.innerHTML = `
                <img src="${comment.profile_picture}" alt="${comment.full_name}'s profile picture" style="width: 40px; height: 40px; border-radius: 50%; margin-right: 10px;">
                <div style="flex-grow: 1;">
                    <strong style="color: black;">${comment.full_name}</strong>
                    <p>${comment.comment}</p>
                    ${comment.images && comment.images.length > 0 ? `
                        <div>
                            <img src="${comment.images}" alt="Comment image" style="max-width: 100%; height: auto; margin-top: 10px; border-radius: 8px;">
                        </div>
                    ` : ''}
                    <small style="color: #999;">${timeAgo(comment.created)}</small>
                </div>
            `;

            commentList.appendChild(commentDiv);
        });

        // Open the modal
        document.getElementById('commentModal').style.display = 'block';
        setTimeout(() => {
            commentList.scrollTop = commentList.scrollHeight;
        }, 0);

      } else {
        const commentList = document.getElementById('commentList');
        commentList.innerHTML = '<p style="text-align: center; color: #999;">No comments yet.</p>';
        document.getElementById('commentModal').style.display = 'block';
      }
    } catch (error) {
      console.error('Error fetching comments:', error);
      alert('An error occurred while loading comments.');
    }
  }

  // Close modal on click of close button
  if (e.target.id === 'closeCommentModal') {
    document.getElementById('commentModal').style.display = 'none';
  }

  // Close modal when clicking outside the modal content
  if (e.target.id === 'commentModal') {
    document.getElementById('commentModal').style.display = 'none';
  }
});

function timeAgo(dateString) {
  const now = new Date();
  const commentDate = new Date(dateString);
  const diffInSeconds = Math.floor((now - commentDate) / 1000);

  if (diffInSeconds < 60) {
    return `${diffInSeconds} seconds ago`;
  } else if (diffInSeconds < 3600) {
    const minutes = Math.floor(diffInSeconds / 60);
    return `${minutes} minute${minutes > 1 ? 's' : ''} ago`;
  } else if (diffInSeconds < 86400) {
    const hours = Math.floor(diffInSeconds / 3600);
    return `${hours} hour${hours > 1 ? 's' : ''} ago`;
  } else if (diffInSeconds < 172800) {
    return `Yesterday`;
  } else {
    const days = Math.floor(diffInSeconds / 86400);
    return `${days} day${days > 1 ? 's' : ''} ago`;
  }
}

//--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------//--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------
 //FOR COMMENT SEND TO CONTROLER //FOR COMMENT SEND TO CONTROLER //FOR COMMENT SEND TO CONTROLER //FOR COMMENT SEND TO CONTROLER 
 //FOR COMMENT SEND TO CONTROLER //FOR COMMENT SEND TO CONTROLER //FOR COMMENT SEND TO CONTROLER //FOR COMMENT SEND TO CONTROLER 

 document.addEventListener('DOMContentLoaded', function () {
    const uploadImageButton = document.getElementById('uploadImageButton');
    const fileInputComment = document.getElementById('fileInputComment');
    const imagePreviewContainerComment = document.getElementById('imagePreviewContainerComment');  // Updated ID

    uploadImageButton.addEventListener('click', function () {
        fileInputComment.click();
    });

    fileInputComment.addEventListener('change', function () {
        const file = fileInputComment.files[0];
        if (file) {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    const imgElement = document.createElement('img');
                    imgElement.src = e.target.result;
                    imgElement.style.maxWidth = '200px'; 
                    imgElement.style.marginTop = '10px';
                    imgElement.style.borderRadius = '8px'; 

                    imagePreviewContainerComment.style.display = 'block'; 
                    imagePreviewContainerComment.innerHTML = '';
                    imagePreviewContainerComment.appendChild(imgElement);
                };
                reader.readAsDataURL(file);
            } else {
                alert('Please select an image file.');
            }
        }
    });
});





document.getElementById('postCommentButton').addEventListener('click', function () {
    const commentInput = document.getElementById('commentInput');
    const fileInput = document.getElementById('fileInputComment'); 
    const postId = document.getElementById('postId').value; 
    const comment = commentInput.value.trim();

    // Validation
    if (!comment) {
        alert('Comment cannot be empty.');
        return;
    }

    const files = fileInput.files;
    
    if (files.length > 1) {
        alert('You can upload only one image.');
        return;
    }

    const allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/jpg'];
    if(files.length > 0 && !allowedTypes.includes(files[0].type)){
        alert('Invalid file type. Please upload an image.');
        return;
    }

    const formData = new FormData();
    formData.append('profile_post_id', postId);
    formData.append('comment', comment);
    if (files.length > 0) {
        formData.append('file', fileInput.files[0]);  
        console.log([...formData]);
    }


    fetch('/MessageBoard/Comment/saveComment', {
        method: 'POST',
        body: formData,
    })
    .then(response => {
        return response.text().then(text => {
            console.log('Raw server response:', text);
            try {
                const data = JSON.parse(text); 
                return data;
            } catch (e) {
                console.error('Error parsing JSON:', e);
                console.log('Response was:', text);  
                throw e;  
            }
        });
    })
    .then(data => {
        if (data.status === 'success') {
            alert(data.message);
            commentInput.value = '';
            fileInput.value = '';
        } else {
            console.log(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        // alert('Something went wrong. Please try again.');

    });

});

</script>