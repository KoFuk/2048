<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Statistics - 2048</title>

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
<h2>Statistics</h2>
<div class="container">
    <div class="stat-container">
        <?php for ($i = 0; $i < sizeof($data); $i++) { ?>
            <?php $d = $data[$i] ?>
            <div class="stat-row">
                <span class="stat-rank"><?php echo $i + 1 ?></span>
                <span class="stat-username"><?php echo $d['username'] ?></span>
                <span class="stat-score"><?php echo $d['score'] ?></span>
            </div>
        <?php } ?>
    </div>
</div>
</body>
</html>
