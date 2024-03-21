<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo $this->Html->css('Posts/index');  ?>
    <title>Upload Profile Picture</title>
</head>

<body>

    <div class="users-form-container">
        <div class="image-upload-container">
            <div class="image-preview">
                <?php if (!empty($imageRecord)) : ?>
                    <img id="previewImage" src="<?php echo $this->Html->url('/' . $imageRecord['Posts']['path']); ?>" alt="Uploaded Image">
                <?php else : ?>
                    <div class="no-image">No image uploaded</div>
                <?php endif; ?>
            </div>
            <h1>Upload your profile picture here!</h1>
        </div>
        <div class="upload-form-container">
            <div class="flash-message">
                <?php echo $this->Flash->render(); ?>
            </div>
            <form class="upload-form" method="post" action="<?php echo $this->Html->url(array('controller' => 'posts', 'action' => 'index')); ?>" enctype="multipart/form-data" onsubmit="return validateForm()">
                <input type="file" name="data[Posts][file]" id="fileUpload" accept=".jpg, .jpeg, .gif, .png" onchange="previewFile()" />
                <div class="button-container">
                    <input type="submit" class="btn btn-upload" value="Upload File" />
                    <a class="btn btn-secondary" href="http://localhost/MessageBoard/Userprofiles/user_profile">Back to Home</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewFile() {
            var preview = document.getElementById('previewImage');
            var file = document.querySelector('input[type=file]').files[0];
            var reader = new FileReader();

            reader.onloadend = function() {
                preview.src = reader.result;
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = "";
            }
        }
    </script>

</body>

<script>
    function validateForm() {
        var fileInput = document.getElementById('fileUpload');
        var filePath = fileInput.value;
        var allowedExtensions = /(\.jpg|\.jpeg|\.gif|\.png)$/i;

        if (!allowedExtensions.exec(filePath)) {
            alert('Please upload files having extensions .jpg, .jpeg, .gif, .png only.');
            fileInput.value = '';
            return false;
        }

        return true;
    }
</script>

</html>