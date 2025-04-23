<?php
http_response_code(404);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="<?= BASE_URL ?>">
    <title>NLDPI</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css"  href="bootstrap-4/css/bootstrap.css">

    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 50vh;
        }
    </style>
</head>
<body>
    <div class="text-center">
            <div class="mb-5">
                <a href="<?= BASE_URL ?>" class="home">
                    <img src="images/nldpi-logo-extra.png" alt="NLDPI">
                </a>
            </div>
            <div class="display-4">Page Not Found</div>
    </div>
</body>
</html>