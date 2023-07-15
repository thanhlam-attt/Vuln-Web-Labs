<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Another Page</title>
    <link href="/xss/Image/favicon.ico" rel="icon" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mini.css/2.3.4/mini-dark.min.css">
</head>

<body>
    <header>
        <a href="\xss\index.php" class="logo">LAB</a>
    </header>

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <?php echo "Chưa có gì đâu!" ?>
            
            </div>
        </div>
    </div>
</body>

</html>