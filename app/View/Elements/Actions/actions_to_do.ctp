<div class="td" id="m-col" style="display: flex; flex-direction: column; width: 100%; background-color: #f5f5f5; border: 1px solid #ccc; border-radius: 8px;">
      <div class="m-mrg" id="p-tabs" style="padding: 10px;">
        <div class="tb" style="display: flex; align-items: center; justify-content: space-between;">
          <div class="td" style="flex-grow: 1;">
            <div class="tb" id="p-tabs-m" style="display: flex; gap: 10px; justify-content: space-around; align-items: center; background-color: #fff; border-radius: 8px; padding: 10px; box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);">
              <div class="td active" style="display: flex; flex-direction: column; align-items: center; cursor: pointer; color: #1877f2;">
                <i class="fas fa-clock" style="font-size: 24px;"></i>
                <span style="font-size: 12px; font-weight: bold;">TIMELINE</span>
              </div>
              <div class="td" style="display: flex; flex-direction: column; align-items: center; cursor: pointer; color: #555;">
                <?php if (isset($isAFriend['FriendsList']) && !empty($isAFriend['FriendsList'])): ?>
                  <?php if ($isAFriend['FriendsList']['status'] == 'accepted'): ?>
                    <i class="fas fa-users" style="font-size: 24px;"></i>
                    <span style="font-size: 12px; font-weight: bold;">FRIENDS</span>
                  <?php elseif ($isAFriend['FriendsList']['status'] == 'pending'): ?>
                      <?php if ($isAFriend['FriendsList']['user_id'] == $my_user_Id && $isAFriend['FriendsList']['acceptor'] == $acceptor ): ?>
                          <!-- If friend request is pending -->
                          <button id="cancel-request-btn" class="action-btn" data-request-id="<?php echo $isAFriend['FriendsList']['id']; ?>" style="padding: 10px; font-size: 14px; background-color: #f44336; color: white; border: none; border-radius: 5px; cursor: pointer;">
                              <i class="fas fa-user-times" style="margin-right: 5px;"></i> Cancel Request
                          </button>
                      <?php elseif ($isAFriend['FriendsList']['user_id'] == $acceptor && $isAFriend['FriendsList']['acceptor'] == $my_user_Id ): ?>
                        <button id="accept-request-btn" class="action-btn" style="padding: 10px; font-size: 14px; background-color: #4CAF50; color: white; border: none; border-radius: 5px; cursor: pointer;">
                            <i class="fas fa-user-check" style="margin-right: 5px;"></i> Accept Request
                        </button>
                      <?php endif; ?>
                  <?php endif; ?>
                  <?php else: ?>
                        <?php if ($acceptor != $my_user_Id || $my_user_Id != $acceptor): ?>
                            <button id="add-friend-btn" class="action-btn" data-user-id="<?php echo $my_user_Id; ?>" style="padding: 10px; font-size: 14px; background-color: #1877f2; color: white; border: none; border-radius: 5px; cursor: pointer;">
                                <i class="fas fa-user-plus" style="margin-right: 5px;"></i> Add Friend
                            </button>
                        <?php else: ?>
                            <i class="fas fa-users" style="font-size: 24px;"></i>
                            <span style="font-size: 12px; font-weight: bold;">FRIENDS</span>
                        <?php endif; ?>
                  <?php endif; ?>
                  
              </div>
              <div class="td" style="display: flex; flex-direction: column; align-items: center; cursor: pointer; color: #555;">
                <i class="fas fa-image" style="font-size: 24px;"></i>
                <span style="font-size: 12px; font-weight: bold;">PHOTOS</span>
              </div>
              <div class="td" style="display: flex; flex-direction: column; align-items: center; cursor: pointer; color: #555;">
                <i class="fas fa-info-circle" style="font-size: 24px;"></i>
                <span style="font-size: 12px; font-weight: bold;">ABOUT</span>
              </div>
              <div class="td" style="display: flex; flex-direction: column; align-items: center; cursor: pointer; color: #555;">
                <i class="fas fa-archive" style="font-size: 24px;"></i>
                <span style="font-size: 12px; font-weight: bold;">ARCHIVE</span>
              </div>
            </div>
          </div>
          <div class="td" id="p-tab-m" style="margin-left: 10px; cursor: pointer; display: flex; align-items: center; justify-content: center; background-color: #fff; border-radius: 50%; width: 40px; height: 40px; box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);">
            <i class="fas fa-chevron-down" style="font-size: 24px; color: #555;"></i>
          </div>
        </div>
      </div>
    </div>

<script>
        //--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------//--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------
 //Cancel Friend Request //Cancel Friend Request //Cancel Friend Request //Cancel Friend Request 
 //Cancel Friend Request //Cancel Friend Request //Cancel Friend Request //Cancel Friend Request 

$(document).ready(function() {
    $('#cancel-request-btn').on('click', function() {
        var friendRequestId = $(this).data('request-id');  
        
        $.ajax({
            url: '/MessageBoard/FriendsList/deleteFriendRequest',
            type: 'POST',
            data: {
                request_id: friendRequestId,
                user_id: <?php echo $my_user_Id; ?> 
            },
            success: function(response) {
                if(response.success) {
                    alert('Friend request canceled successfully.');
                    // Optionally, remove the row or hide the button
                    $('#cancel-request-btn').closest('div').remove();  
                } else {
                    alert('An error occurred. Please try again.');
                }
            },
            error: function() {
                alert('There was an error with the request.');
            }
        });
    });
});

//--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------//--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------
 //ADD Friend Request //ADD Friend Request //ADD Friend Request //ADD Friend Request 
 //ADD Friend Request //ADD Friend Request //ADD Friend Request //ADD Friend Request 

$(document).ready(function() {
    $('#add-friend-btn').on('click', function() {
        
        $.ajax({
            url: '/MessageBoard/FriendsList/addFriendRequest', 
            type: 'POST',
            data: {
                friend_user_id: <?php echo $acceptor; ?> ,
                user_id: <?php echo $my_user_Id; ?> 
            },
            success: function(response) {
                if(response.success) {
                    alert('Friend request sent successfully.');
                    $('#add-friend-btn').text('Cancel Request').prop('disabled', true).css('background-color', '#f44336');
                } else {
                    alert('An error occurred. Please try again.');
                }
            },
            error: function() {
                alert('There was an error with the request.');
            }
        });
    });
});

//--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------//--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------
 //ACCEPT Friend Request //ACCEPT Friend Request //ACCEPT Friend Request //ACCEPT Friend Request 
 //ACCEPT Friend Request //ACCEPT Friend Request //ACCEPT Friend Request //ACCEPT Friend Request 

$(document).ready(function() {
    $('#accept-request-btn').on('click', function() {
        var friendUserId = <?php echo $acceptor; ?>; 
        var myUserId = <?php echo $my_user_Id; ?>; 
        
        $.ajax({
            url: '/MessageBoard/FriendsList/acceptFriendRequest', 
            type: 'POST',
            data: {
                friend_user_id: friendUserId,
                user_id: myUserId 
            },
            success: function(response) {
                if(response.success) {
                    alert('Friend request accepted successfully.');
                    window.location.reload();
                } else {
                    alert('An error occurred. Please try again.');
                }
            },
            error: function() {
                alert('There was an error with the request.');
            }
        });
    });
});

//--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------//--------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------
 //UNFRIEND Friend Request //UNFRIEND Friend Request //UNFRIEND Friend Request //UNFRIEND Friend Request 
 //UNFRIEND Friend Request //UNFRIEND Friend Request //UNFRIEND Friend Request //UNFRIEND Friend Request 

$(document).ready(function() {
    $('#unfriend-btn').on('click', function() {
        var friendUserId = <?php echo $acceptor; ?>; 
        var myUserId = <?php echo $my_user_Id; ?>; 
        
        $.ajax({
            url: '/MessageBoard/FriendsList/unfriend',
            type: 'POST',
            data: {
                friend_user_id: friendUserId,
                user_id: myUserId 
            },
            success: function(response) {
                if(response.success) {
                    alert('You have unfriended this user.');
                    $('#unfriend-btn').hide(); 
                    window.location.reload();
                } else {
                    alert('An error occurred while unfriending the user. Please try again.');
                }
            },
            error: function() {
                alert('There was an error with the request.');
            }
        });
    });
});

</script>