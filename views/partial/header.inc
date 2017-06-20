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
                <li><?php self::actionLink('Overview', "Index", "Discussion"); ?></li>
                <li><?php self::actionLink('Search', "Search", "Search"); ?></li>
                <?php if($model['currUser'] == null): ?>
                <li><?php self::actionLink('Login', "Login", "User"); ?></li>
                <?php else: ?>
                <li>
                <?php self::beginActionForm('Logout', 'User', 'post', null, 'navbar-form'); ?>
                <button class="btn btn-link">Logout</button>
                <?php self::endActionForm(); ?>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
    </nav>
    <script src="js/jquery.min.js"></script>