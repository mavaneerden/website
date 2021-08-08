<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/static/js/jquery.js"></script>
    <script src="/static/js/angular.js"></script>
    <link rel="stylesheet" href="/static/css/main.css" type="text/css">
    <?php
    foreach ($stylesheets as $link) {
        echo "<link rel=\"stylesheet\" href=".$link." type=\"text/css\">";
    }
    ?>
    <title><?php echo $title ?></title>
</head>
<body>
    <div class="all">