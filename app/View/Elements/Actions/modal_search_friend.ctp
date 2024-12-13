<!-- Modal for Search/Add Friend -->
<!-- Modal for Search/Add Friend -->
<style>
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    #spinner {
        display: none; 
        text-align: center;
        padding: 20px;
    }

    #spinner div {
        border: 4px solid #f3f3f3; 
        border-top: 4px solid #1877F2; 
        border-radius: 50%;
        width: 25px; 
        height: 25px; 
        animation: spin 1s linear infinite; 
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); 
    }
</style>



<div id="searchFriendModal" class="modal" style="display: none; width: 100%; height: 100%;  justify-content: center; align-items: center; z-index: 9999; position: fixed; top: 0; left: 0;">
    <div class="modal-content" style="width: 500px; padding: 0; background-color: #fff; border-radius: 8px; box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.3);">
        <div style="background-color: #1877F2; padding: 10px 15px; border-bottom: 1px solid #ddd; display: flex; justify-content: space-between; align-items: center; border-radius: 8px 8px 0 0;">
            <h4 style="margin: 0; font-size: 16px; font-weight: 600; color: white;">Search for Friends</h4>
            <span class="close" id="closeModalBtnSearchFriend" style="font-size: 24px; cursor: pointer; color: white;">&times;</span>
        </div>
        <div style="padding: 15px;">
            <input type="text" id="searchInput" placeholder="Search for friends..." autofill="off"
                style="width: 100%; padding: 12px; font-size: 14px; border-radius: 20px; border: 1px solid #ddd; background-color: #f5f6f7; outline: none; box-sizing: border-box; margin-bottom: 15px;">
                <!-- Spinner HTML (inside friendList div) -->
                <!-- Spinner HTML -->
                <div id="spinner">
                    <div></div>
                </div>

            <ul id="friendList" style="list-style-type: none; padding: 0; margin: 0; max-height: 300px; overflow-y: auto; background-color: #f9f9f9; border-radius: 8px;">
               
                <li style="padding: 12px 15px; border-bottom: 1px solid #ddd; display: flex; align-items: center; cursor: pointer; transition: background-color 0.2s ease;">
                    <img src="https://via.placeholder.com/40" alt="Friend" style="width: 40px; height: 40px; border-radius: 50%; margin-right: 15px;">
                    <div style="flex-grow: 1;">
                        <span style="font-size: 14px; color: #1c1e21; font-weight: 500;">Friend Name</span>
                        <p style="font-size: 12px; color: #606770; margin: 2px 0 0;">Not Friends</p>
                    </div>
                    <button class="message-btn" style="background-color: #42b72a; color: white; padding: 6px 10px; border: none; border-radius: 20px; font-size: 12px; cursor: pointer;">Message</button>
                </li>
                
            </ul>
        </div>
    </div>
</div>




<script>
$(document).ready(function() {
    // Open Modal when See More button is clicked
    $("#seeMoreBtn").click(function() {
        $("#searchFriendModal").fadeIn();
        $("#searchInput").focus();
        $("#searchInput").trigger('input');
    });

    // Close Modal
    $(".close").click(function() {
        $("#searchFriendModal").fadeOut();
    });

    // Search friends as user types
    $("#searchInput").on('keyup', function() {
        var searchQuery = $(this).val().trim();
        if (searchQuery.length > 0) {
            var friendsList = $("#friendList");
            var spinner = $("#spinner");
            friendsList.empty(); 

            spinner.show();

            setTimeout(function() {
                $.ajax({
                    url: '/MessageBoard/FriendsList/searchFriends', 
                    method: 'GET',
                    data: { query: searchQuery },
                    dataType: 'json',
                    success: function(response) {
                        friendsList.empty(); 
                        spinner.hide();

                        if (response.length > 0) {
                            response.forEach(function(friend) {
                                var friendItem = `
                                    <li style="padding: 10px; display: flex; align-items: center; cursor: pointer; border-bottom: 1px solid #ddd; gap: 10px;">
                                        <div class="friend-avatar" style="width: 50px; height: 50px; border-radius: 50%; overflow: hidden; flex-shrink: 0;">
                                            <a href="/MessageBoard/user-profiles-of/${friend.user_id}">
                                                <img src="${friend.profile_pic}" alt="${friend.full_name}" style="width: 100%; height: 100%; object-fit: cover;">
                                            </a>
                                        </div>
                                        <div style="flex-grow: 1;">
                                            <h4 style="font-size: 16px; margin: 0; font-weight: bold; color: #1c1e21;">
                                                <a href="/MessageBoard/user-profiles-of/${friend.user_id}" style="text-decoration: none; color: #1877F2;">${friend.full_name}</a>
                                            </h4>
                                            <p style="margin: 2px 0 0; font-size: 12px; color: #606770;">${friend.is_friend ? 'Friend' : 'Not Friends'}</p>
                                        </div>
                                        <div style="text-align: center; display: flex; align-items: center; gap: 10px;">
                                            ${friend.is_friend 
                                                ? (friend.is_online === '1' 
                                                    ? '<span style="display: inline-block; width: 10px; height: 10px; border-radius: 50%; background-color: #4CAF50;" title="Online"></span>' 
                                                    : '<span style="display: inline-block; width: 10px; height: 10px; border-radius: 50%; background-color: #ccc;" title="Offline"></span>') 
                                                : ''}
                                            <a href="/MessageBoard/user-profiles-of/${friend.user_id}" class="add-friend-btn" style="background-color: #1877F2; color: white; padding: 5px 10px; border: none; border-radius: 5px; font-size: 14px;">See Profile</a>
                                            <button class="message-btn" style="background-color: #42b72a; color: white; padding: 5px 10px; border: none; border-radius: 5px; font-size: 14px;">Message</button>
                                        </div>
                                    </li>`;

                                friendsList.append(friendItem);
                            });
                        } else {
                            friendsList.append('<li style="padding: 10px; font-size: 14px; color: #606770; text-align: center;">No results found</li>');
                        }
                    },
                    error: function(xhr, status, error) {
                        friendsList.empty(); 
                        spinner.hide(); 
                        friendsList.append('<li style="padding: 10px; font-size: 14px; color: #606770; text-align: center;">Error fetching data. Please try again.</li>');
                        console.error('AJAX Error: ' + error);
                    }
                });
            }, 1000); 
        } else {

            var friendsList = $("#friendList");
            var spinner = $("#spinner");
            friendsList.empty();
            spinner.hide(); 
        }
    });
});
</script>

