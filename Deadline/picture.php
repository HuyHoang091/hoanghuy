<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select and Display Image</title>
    <script>
        function displayImage() {
            var fileInput = document.getElementById('fileToUpload');
            var filePathInput = document.getElementById('filePath');
            var image = document.getElementById('selectedImage');

            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    image.src = e.target.result;
                    filePathInput.value = fileInput.files[0].name; // Save just the filename
                };

                reader.readAsDataURL(fileInput.files[0]);
            }
        }
    </script>
</head>
<body>
    <div style="height: 50px;">
        <div onclick="huy()" style="float: right">
                    <div style="font-size: 27px;
                    cursor: pointer;
                    position: fixed; right: 10px;
        width: 30px;
        background: red;
        color: white;
        border-radius: 10px;text-align: center;">×</div>
    </div>
<img style="height: 100px; width: 150px;" src="http://localhost/hoanghuy/Deadline/Public/Pictures/img/logoct.png
" alt="">
<form action="upload.php" method="post" enctype="multipart/form-data">
    <label for="fileToUpload">Select image to upload:</label>
    <input type="file" name="fileToUpload" id="fileToUpload" onchange="displayImage()">
    <br><br>
    <label for="filePath">File path:</label>
    <input type="text" name="filePath" id="filePath" readonly>
    <br><br>
    <img id="selectedImage" src="" alt="Selected Image" style="max-width: 300px; max-height: 300px;">
    <br><br>
    <input type="submit" value="Upload Image" name="submit">
</form>
<script>
        function huy(){
            window.parent.postMessage({functionName: 'huydn'}, '*');
        }
    </script>
</body>
</html>
