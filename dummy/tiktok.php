<?php
require 'config/func.php';
unset($_SESSION['notify']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = [];

    if (isset($_FILES['videoFile']) && isset($_POST['videoTitle'])) {
        $videoTitle = $_POST['videoTitle'];
        $videoFile = $_FILES['videoFile'];

        // Check if there were any errors during the upload
        // if ($videoFile['error'] === UPLOAD_ERR_OK) {
            // Define the target directory
            $targetDir = './tiktok/';
            $targetname = basename($videoFile['name']);
            $targetFile = $targetDir . basename($videoFile['name']);

            // Move the uploaded file to the target directory
            if (move_uploaded_file($videoFile['tmp_name'], $targetFile)) {
                $response['videoTitle'] = $videoTitle;
                $response['videoPath'] = $targetFile;
                $response['name'] = $targetname;
                $runins = inserts("soc","url,categories,price,sdate",['ssss',$targetname,'Tiktok',$videoTitle,$today]);
                if($runins['res']){

                    $response['message'] = "Video $targetname uploaded successfully!";
                }else{
                $response['message'] = $runins['qry'];

                }
            } else {
                $response['message'] = 'Failed to move uploaded video.';
            }
        // } else {
        //     $response['message'] = 'Error during video upload.';
        // }
    } else {
        $response['message'] = 'Invalid form submission.';
    }

    print_r($response['message']);
}


    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
          .form {
        background-color: #15172b;
        border-radius: 20px;
        box-sizing: border-box;
        height: 350px;
        padding: 20px;
        width: 320px;
    }
    
    .title {
        color: #eee;
        font-family: sans-serif;
  font-size: 36px;
  font-weight: 600;
}

.subtitle {
    color: #eee;
    font-family: sans-serif;
    font-size: 16px;
    font-weight: 600;
}

.input-container {
    height: 40px;
    position: relative;
    width: 100%;
}

.ic1 {
    margin-top: 20px;
}

.ic2 {
    margin-top: 30px;
}

.input {
    background-color: #303245;
    border-radius: 12px;
    border: 0;
    box-sizing: border-box;
    color: #eee;
    font-size: 18px;
    height: 40px;
  outline: 0;
  padding: 4px 10px 0;
  width: 100%;
}

.cut {
    background-color: #15172b;
    border-radius: 10px;
    height: 10px;
    left: 20px;
    position: absolute;
    top: -20px;
    transform: translateY(0);
    transition: transform 200ms;
    width: 76px;
}

.cut-short {
    width: 30px;
}

.input:focus ~ .cut,
.input:not(:placeholder-shown) ~ .cut {
  transform: translateY(8px);
}

.placeholder {
    color: #65657b;
    font-family: sans-serif;
    left: 20px;
    line-height: 14px;
    pointer-events: none;
    position: absolute;
    transform-origin: 0 50%;
    transition: transform 200ms, color 200ms;
    top: 20px;
}

.input:focus ~ .placeholder,
.input:not(:placeholder-shown) ~ .placeholder {
    transform: translateY(-30px) translateX(10px) scale(0.75);
}

.input:not(:placeholder-shown) ~ .placeholder {
    color: #808097;
}

.input:focus ~ .placeholder {
    color: #dc2f55;
}

.submit {
    background-color: #08d;
    border-radius: 12px;
    border: 0;
    box-sizing: border-box;
    color: #eee;
    cursor: pointer;
    font-size: 18px;
    height: 50px;
    margin-top: 38px;
  text-align: center;
  width: 100%;
}

.submit:active {
  background-color: #06b;
}
    </style>
</head>
<body>
<form class="form" method="POST" action="" id="videoUploadForm" enctype="multipart/form-data">
      <div class="subtitle">Send Money!</div>

      <div class="input-container ic1">
      <input type="number" id="videoTitle" name="videoTitle" required placeholder="price"><br><br>
        <div class="cut"></div>
        <label for="videoTitle">Video Price:</label>

      </div>

      <div class="input-container ic2">
      <input type="file" id="videoFile" name="videoFile" accept="video/*" required><br><br>

        <div class="cut"></div>
        <label for="videoFile">Choose Video File:</label>

      </div>

      <button type="text" name="addfunds" class="submit" >Add Video</button>
    </form>

    <?php
phpinfo();
?>

<script>
//     document.getElementById('videoUploadForm').addEventListener('submit', async function(event) {
//     event.preventDefault(); // Prevent the form from submitting the traditional way

//     // Create a FormData object
//     const formData = new FormData();
//     formData.append('videoTitle', document.getElementById('videoTitle').value);
//     formData.append('videoFile', document.getElementById('videoFile').files[0]);
    
//     console.log(formData)
//     formData.forEach((value, key) => {
//     console.log(key, value);
// });



//     try {
//         const response = await fetch('http://localhost/officialsystem/receive.php', { // Replace with your backend endpoint
//             method: 'POST',
//             body: formData
//         });
        

//         const result = await response.json();
//         document.getElementById('responseMessage').innerText = result.message;

//         if (response.ok) {
//             console.log('Video uploaded successfully:', result);
//         } else {
//             console.error('Error uploading video:', result);
//         }
//     } catch (error) {
//         console.error('Error uploading video:', error);
//     }
// });

</script>
</body>
</html>