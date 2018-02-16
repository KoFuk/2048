<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sign in - 2048</title>

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
    <h2>Sign in to the Game</h2>
    <?php if ($login_failure) { ?>
        <div style="color: red; margin: 10px">
            Failed to login. Please try again.
        </div>
    <?php } ?>
    <form action="session" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" class="input-text" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" class="input-text" name="password" required>

        <input type="submit" value="Sign in" class="input-button">
    </form>
    <p>
        You don't have an account? <a href="signup">Sign up</a> here.<br>
        ..Or <a href="game">continue</a> without logging in.
    </p>
</div>
</body>
</html>
