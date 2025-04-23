<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NLDPI Registration Approval</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <style>
        body {
            font-family: Nunito, Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #F8FAFC;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .email-container {
            max-width: 600px;
            background-color: #fff;
            padding: 32px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            text-align: center;
            margin-bottom: 24px;
        }

        .logo-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            font-size: 24px;
            font-weight: 600;
            color: #16192C;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
        }

        .email-content h1 {
            font-size: 20px;
            font-weight: 700;
            color: #16192C;
            margin-bottom: 16px;
        }

        .email-content p {
            font-size: 16px;
            color: #16192C;
            line-height: 24px;
            margin-bottom: 16px;
        }

        .status-section {
            border-left: 4px solid #00AD56;
            padding: 12px 16px;
            background-color: #F8FAFC;
            margin: 24px 0;
        }

        .status-item {
            font-size: 16px;
            font-weight: 600;
            color: #16192C;
        }

        .status-value {
            font-weight: 400;
            color: #16192C;
        }

        .footer {
            text-align: center;
            margin-top: 24px;
            font-size: 14px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="email-header">
            <div class="logo-container">
                <img src="<?= $logo_url?>"  alt="NLDPI Logo"> 
            </div>
        </div>

        <!-- Content -->
        <div class="email-content">
            <h1>Registration Approved</h1>
            <p>Dear <?= $user_obj->full_name ?>,</p>
            <p>
                Congratulations! Your registration with the National Livestock Digital Public Infrastructure (NLDPI) has been successfully approved.
            </p>

            <!-- Status Section -->
            <div class="status-section">
                <div class="status-item">NLDPI NUMBER: <span class="status-value"><?= $user_obj->nldpi_number ?></span></div>
            </div>

            <p>
                Important Steps:
                <ul>
                    <li>Visit the portal at <a href="<?= $login_url ?>"><?= $login_url ?></a></li>
                    <li>Log in using your Email and password created during registration</li>
                </ul>
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            &copy; 2025 NLDPI - Ministry of Livestock Development <br>
            Federal Republic of Nigeria
        </div>
    </div>
</body>
</html>
