<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>File Upload</title>
    <link href="../Image/favicon.ico" rel="icon" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mini.css/2.3.4/mini-dark.min.css">
</head>

<body>
    <header>
        <a href="..\index.php" class="logo">LAB</a>
        <div class="user-info">
            <strong> User: </strong><a href="admin_info.php">Admin</a>
        </div>
        <style>
            .user-info {
                float: right;
                margin-left: 10px;
                margin-top: 5px;
            }

            a {
                text-decoration: none;
                color: inherit;
            }

            body {
                font-family: Arial, sans-serif;
            }

            .gallery-item img {
                width: 150px;
                /* Điều chỉnh kích thước ảnh thành 200px */
                height: 150px;
                /* Điều chỉnh kích thước ảnh thành 200px */
                object-fit: cover;
                /* Đảm bảo ảnh không bị méo khi điều chỉnh kích thước */
                margin-bottom: 10px;
            }

            .gallery-item:hover {
                transform: scale(1.1);
                /* Hiệu ứng co giãn khi hover */
            }

            .gallery-item {
                transition: transform 0.3s ease;
                /* Chỉnh thời gian và kiểu hiệu ứng */
                display: inline-block;
                margin: 10px;
                text-align: center;
                border: 1px solid #000022;
                padding: 10px;
            }

            .gallery-item img {
                max-width: 200px;
                max-height: 200px;
                margin-bottom: 10px;
            }

            .item-info {
                font-weight: bold;
            }
        </style>
    </header>

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <br>
                <fieldset>
                    <legend>Ảnh</legend>
                    <?php
                    $upload_dir = 'upload/';

                    // Get the list of files in the upload directory
                    $files = glob($upload_dir . '*');

                    if (count($files) > 0) {
                        $index = 1;
                        foreach ($files as $file) {
                            if (is_file($file)) {
                                // Display the image file
                                echo '<div class="gallery-item">';
                                echo '<a  href="' . $file . '" > 
                                        <img src="' . $file . '" alt="Uploaded Image">
                                      </a>';
                                echo '<div class="item-info">' . 'Ảnh ' . $index . '</div>';
                                echo '</div>';
                                $index += 1;
                            }
                        }
                    } else {
                        echo 'No images have been uploaded.';
                    }
                    ?>
                </fieldset>
            </div>
        </div>
    </div>
</body>

</html>