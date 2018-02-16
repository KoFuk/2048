<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sign up - 2048</title>

    <link href="style/main.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="apple-touch-icon" href="meta/apple-touch-icon.png">
    <link rel="apple-touch-startup-image" href="meta/apple-touch-startup-image-640x1096.png"
          media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)">
    <!-- iPhone 5+ -->
    <link rel="apple-touch-startup-image" href="meta/apple-touch-startup-image-640x920.png"
          media="(device-width: 320px) and (device-height: 480px) and (-webkit-device-pixel-ratio: 2)">
    <!-- iPhone, retina -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="viewport"
          content="width=device-width, target-densitydpi=160dpi, initial-scale=1.0, maximum-scale=1, user-scalable=no, minimal-ui">
</head>
<body>
<div class="container">
    <div class="heading">
        <h1 class="title">2048</h1>
    </div>
</div>

<div class="container">
    <h2>Sign up to the Game</h2>

    <?php if ($err) { ?>
        <div style="color: red; margin: 10px">
            <?php if ($err === 'passwordconfirm') { ?>
                Password is not confirmed correctly.
            <?php } elseif ($err === 'takenusername') { ?>
                Username has already taken.
            <?php } ?>
        </div>
    <?php } ?>

    <form action="register" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" class="input-text" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" class="input-text" name="password" required>
        <br>
        <label for="password_confirm">Confirm password:</label>
        <input type="password" id="password_confirm" class="input-text"
               name="password-confirm" required>
        <input type="submit" value="Sign up" class="input-button">
    </form>
</div>
<script>
    const password = document.getElementById('password');
    const passwordConfirm = document.getElementById('password_confirm');

    const validatePassword = function () {
        if (password.value !== passwordConfirm.value) {
            passwordConfirm.setCustomValidity('Passwords don\'t match');
        } else {
            passwordConfirm.setCustomValidity('');
        }
    };

    passwordConfirm.onchange = validatePassword();
</script>
</body>
</html>
