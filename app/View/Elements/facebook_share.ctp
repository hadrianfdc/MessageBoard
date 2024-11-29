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



/* Modal Who react */
/* Modal Who react */
/* Modal Who react */
/* Modal Who react */
/* Modal Who react */

#modal_shows_who_react {
        display: none; /* Hidden by default */
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); /* Background color */
        z-index: 1000;
        justify-content: center;
        align-items: center;
    }

    .modal_who_react_content {
        background-color: #fff; /* White background */
        color: black; /* Black text */
        padding: 20px;
        border-radius: 8px;
        width: 80%;
        max-width: 500px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .close-modal {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 30px;
        cursor: pointer;
    }

    #reactionsList {
        margin-top: 20px;
    }

    .reaction-user {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 15px;
    border-bottom: 1px solid #ddd;
    padding-bottom: 10px;
}

.reaction-profile-pic {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    margin-right: 10px;
}

.reaction-details {
    display: flex;
    align-items: center;
}

.reaction-icon {
    margin-right: 10px;
    font-size: 20px; /* Icon size */
}

.reaction-name {
    font-weight: bold;
}

.message-btn {
    background-color: #1877f2; /* Facebook blue */
    color: white;
    border: none;
    padding: 5px 10px;
    border-radius: 4px;
    cursor: pointer;
}

.message-btn:hover {
    background-color: #165eab;
}





#commentActions {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 10px;
}

#commentActions input[type="file"] {
    display: none;
}

#commentActions button {
    background: none;
    border: none;
    cursor: pointer;
}


#imagePreviewContainerComment {
    display: block;  /* Initially hidden, shown when a file is selected */
    margin-top: 10px;
    max-width: 200px;  /* Limit the size of the image */
    /* Optional additional styles */
}





</style>
