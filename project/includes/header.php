<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= ucfirst($page)." - ".$site_name ?? $site_name ?></title>
    <link rel="stylesheet" href="./base.css">
    <link rel="icon" href="./images/favicon.ico" type="image/ico">
</head>
<body>
<header>
    <nav>
        <h1><?= $site_name ?></h1>
        <a href="index.php?page=home"><img src="./images/logo.png" alt="Site Logo" width=100px height=100px></a>
        <a href="index.php?page=home">Home</a>
        <a href="index.php?page=booking">Check Bookings</a>
        <a href="index.php?page=about">About</a>
    </nav>
</header>