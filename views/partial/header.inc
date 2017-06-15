<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Projektarbeit</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span> 
        </button>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li><?php self::actionLink('Login', "Login", "User"); ?></li>
                <li><?php self::actionLink('Register', "Register", "User"); ?></li>
                <li><?php self::actionLink('Overview', "Index", "Post"); ?></li>
                <li><?php self::actionLink('Search', "Search", "Post"); ?></li>
            </ul>
        </div>
    </div>
    </nav>