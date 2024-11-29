<style>
    .shared-post {
    background-color: white; 

    margin-bottom: 20px;
    padding: 10px;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.shared-facebook-post .common-post-header {
    background-color: #1877f2; /* Facebook blue */
    color: white;
    padding: 10px;
    border-radius: 5px;
}

.shared-facebook-post .common-post-header .user-image {
    border-radius: 50%;
    border: 2px solid white;
}

.shared-facebook-post .common-post-content {
    padding: 10px;
}




#who_share_this_post {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1000; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    background-color: rgba(0, 0, 0, 0.5); /* Black with transparency */
    display: flex;
    align-items: center; /* Center vertically */
    justify-content: center; /* Center horizontally */
}

#who_share_this_post_content {
    background-color: white; /* Changed to white */
    color: black; /* Changed to black */
    border-radius: 8px;
    padding: 20px;
    width: 90%; /* Responsive width */
    max-width: 500px; /* Maximum width */
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); /* Add a slight shadow */
}

#close_who_share_this_post {
    float: right;
    font-size: 24px;
    font-weight: bold;
    cursor: pointer;
}

#close_who_share_this_post:hover {
    color: #ff4444; /* Subtle hover effect */
}

#sharedUsersList li {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}

#sharedUsersList img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    margin-right: 10px;
}

#sharedUsersList p {
    margin: 0;
    font-weight: bold;
}

#sharedUsersList small {
    display: block;
    color: #555; /* Keep this subtle for descriptions */
}

</style>
