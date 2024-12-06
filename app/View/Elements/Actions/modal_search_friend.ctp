<!-- Modal for Search/Add Friend -->
<!-- Modal for Search/Add Friend -->
<div id="searchFriendModal" class="modal" style="display: none; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); 
        justify-content: center; align-items: center; z-index: 9999;">
    <div class="modal-content" style="width: 500px; padding: 20px; background-color: white; border-radius: 8px;">
        <span class="close" id="closeModalBtnSearchFriend" style="font-size: 30px; cursor: pointer; ">&times;</span>
        <h4 style="margin-bottom: 20px; text-align: center;">Search for Friends</h4>
        <input type="text" id="searchInput" placeholder="Search for friends..." 
            style="width: 100%; padding: 10px; margin-bottom: 20px; font-size: 14px; border-radius: 5px; border: 1px solid #ddd;">
        <ul id="friendList" style="list-style-type: none; padding: 0;"></ul>
    </div>
</div>

<script>
$(document).ready(function() {
    // Open Modal when See More button is clicked
    $("#seeMoreBtn").click(function() {
        $("#searchFriendModal").fadeIn();
    });

    // Close Modal
    $(".close").click(function() {
        $("#searchFriendModal").fadeOut();
    });

    // Search friends as user types
$("#searchInput").on('keyup', function() {
    var searchQuery = $(this).val().trim();
    if (searchQuery.length > 2) { 
        var friendsList = $("#friendList");
        friendsList.empty(); // Clear previous results
        // Show loading indicator
        friendsList.append('<li>Loading...</li>');
        
        $.ajax({
            url: '/MessageBoard/FriendsList/searchFriends', 
            method: 'GET',
            data: { query: searchQuery },
            dataType: 'json',
            success: function(response) {
                friendsList.empty(); // Clear the loading text
                
                if (response.length > 0) {
                    response.forEach(function(friend) {
                        var friendItem = `<li style="padding: 10px; border-bottom: 1px solid #ddd;">
                                            <div style="display: flex; align-items: center;">
                                                <div class="friend-avatar" style="width: 40px; height: 40px; border-radius: 50%; overflow: hidden; margin-right: 10px;">
                                                    <a href="/MessageBoard/user-profiles-of/${friend.user_id}">
                                                        <img src="${friend.profile_pic}" alt="${friend.full_name}" style="width: 100%; height: 100%; object-fit: cover;">
                                                    </a>
                                                </div>
                                                <div style="flex-grow: 1;">
                                                    <h4 style="font-size: 14px; margin: 0; font-weight: bold;">
                                                    <a href="/MessageBoard/user-profiles-of/${friend.user_id}">${friend.full_name}</a></h4>`;
                                                                                                
                        // Conditionally add "Add Friend" button or the online/offline circle
                        if (friend.is_friend) {
                            var statusCircle = friend.is_online === '1' 
                                ? '<button style="width: 10px; height: 10px; border-radius: 50%; background-color: #4CAF50; border: none;">  </button>'  // Green if online
                                : '<button style="width: 10px; height: 10px; border-radius: 50%; background-color: #ccc; border: none;"> </button>'; // Gray if offline

                            friendItem += `<div style="display: flex; align-items: center; gap: 5px;">
                                                ${statusCircle}
                                            </div>`;
                        } else {
                            friendItem += `<button class="add-friend-btn" style="background-color: #1877F2; color: white; padding: 5px 10px; border: none; border-radius: 5px; cursor: pointer;">See Profile</button>`;
                        }

                        friendItem += `</div></div></li>`;

                        friendsList.append(friendItem);
                    });
                } else {
                        friendsList.append('<li>No results found</li>');
                    }
                },
                error: function(xhr, status, error) {
                    friendsList.empty(); // Clear the loading text
                    friendsList.append('<li>Error fetching data. Please try again.</li>');
                    console.error('AJAX Error: ' + error);
                }
            });
        } else {
            // If input is too short, clear the list
            var friendsList = $("#friendList");
            friendsList.empty();
        }
    });
});


</script>