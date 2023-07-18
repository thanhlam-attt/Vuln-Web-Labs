<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>File Upload</title>
    <link href="/xss/Image/favicon.ico" rel="icon" type="image/x-icon">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mini.css/2.3.4/mini-dark.min.css"> -->
    <style>
        .user-info {
            size: 10px;
            float: right;
            margin-left: 10px;
            margin-top: 5px;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* Thêm style cho phần input file */
        .file-input {
            display: block;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <header>
        <a href="admin_page.php" class="button">Admin page</a>
        <div class="user-info"><strong>User: </strong><a href="admin_info.php">Admin</a></div>
    </header>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <!-- Hiển thị thông tin người dùng -->
                <fieldset>
                    <legend>Thông tin User</legend>
                    <div style="display: flex; align-items: center;">
                        <a href="avatar/download.jpg">
                            <img style="width: 150px; height: 150px; margin-right: 20px;" src="avatar/download.jpg"
                                alt="Default Avatar">
                        </a>
                        <div>
                            <p><strong>Tên:</strong> Admin</p>
                            <p><strong>Email:</strong> Admin@thanhlam.com</p>
                            <p><strong>Giới tính:</strong> Nam</p>
                            <p><strong>Facebook:</strong> <a href="https://www.facebook.com/lamthanh1710t/">Thành</a>
                            </p>
                        </div>
                    </div>
                </fieldset>
                <br>
                <fieldset>
                    <legend>Thêm ảnh</legend>
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST"
                        enctype="multipart/form-data">
                        <input type="file" name="file" class="file-input" accept="image/jpeg"><br>
                        <input type="submit" name="submit" value="Upload">
                    </form>
                </fieldset>

                <?php
                $upload_dir = 'upload/';

                if (isset($_FILES['file'])) {
                    $file_upload = $_FILES['file'];
                    $upload_file = $upload_dir . md5($file_upload['name']);  // Trỏ đến file upload
                    $file_upload_tmp = $file_upload['tmp_name'];        // Trỏ đến biến tạm lưu trữ file

                    move_uploaded_file($file_upload_tmp, $upload_file);
                    if(exif_imagetype($upload_file)){
                        echo "The file ". htmlspecialchars($upload_file). " has been uploaded.";
                    }else{
                        unlink($upload_file);
                        echo "Sorry, there was an error uploading your file.";
                    }

                    // if (exif_imagetype($file_upload_tmp)) {
                    //     // Move the uploaded file to the target directory
                    //     if (move_uploaded_file($file_upload_tmp, $upload_file)) {
                    //         echo "Thêm ảnh thành công!!";
                    //     } else {
                    //         echo "Thêm ảnh thất bại!";
                    //     }
                    // } else {
                    //     die("Your upload file is not an image!");
                    // }


                    // // Validate mime type of the uploaded file
                    // $allowed_mime_types = array('image/jpeg', 'image/png', 'image/gif');
                    // if (in_array($file_upload['type'], $allowed_mime_types)) {
                    //     // Move the uploaded file to the target directory
                    //     if (move_uploaded_file($file_upload_tmp, $upload_file)) {
                    //         echo "Thêm ảnh thành công!!";
                    //     } else {
                    //         echo "Thêm ảnh thất bại!";
                    //     }
                    // } else {
                    //     echo "File tải lên không phải là hình ảnh hợp lệ. Chỉ hỗ trợ các định dạng JPEG, PNG và GIF.";
                    // }
                }
                ?>


            </div>
        </div>
    </div>
</body>

</ht ml>