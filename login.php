<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Orlia'26</title>
    <link rel="stylesheet" href="assets/styles/styles.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Space+Grotesk:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
</head>

<body>
    <!-- Animated Background Particles -->
    <div class="particles-container">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>
    <div class="theme-switch-wrapper">
        <!-- <div class="theme-switch" id="theme-toggle" title="Toggle Theme">
            <i class="ri-moon-line"></i>
        </div> -->
    </div>
    <div class="registration-container">
        <div class="brand-section">
            <div class="floating-circle"></div>
            <div class="floating-circle"></div>
            <div class="floating-circle"></div>
            <h1>Orlia Admin</h1>
            <p>Welcome to the administrative portal of MKCE's premier technical symposium</p>
        </div>
        <div class="form-section">
            <div class="floating-circle"></div>
            <div class="floating-circle"></div>
            <div class="registration-form">
                <h2>Login</h2>
                <form id="adminLoginForm">
                    <div class="form-group">
                        <input type="text" id="userid" name="username" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <input type="password" id="password" name="password" placeholder="Password" required>
                    </div>
                    <button type="submit" class="submit-btn" name="login_user">
                        <i class="ri-login-circle-line"></i> Login Access
                    </button>

                    <div class="event-footer">
                        <div class="event-location" style="opacity: 0;"></div> <!-- Spacer -->
                        <a href="index.php" class="event-btn">
                            <i class="ri-arrow-left-line"></i> Back to Home
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="assets/script/script.js"></script>
    <script src="assets/script/assistant.js"></script>
    <script>
        $(document).on('submit', '#adminLoginForm', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("login_user", true);

            $.ajax({
                type: "POST",
                url: "backend.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    var res = JSON.parse(response);

                    if (res.status == 200) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Login Successful',
                            text: 'Redirecting...',
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.href = res.redirect || 'adminDashboard.php';
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Login Failed',
                            text: res.message
                        });
                    }
                },
                error: function (xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong! Connection failed.'
                    });
                }
            });
        });
    </script>
</body>

</html>