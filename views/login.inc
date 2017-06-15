<?php self::renderView('partial/header', $model); ?>

<div class="container">
    <h1>Login</h1>

    <?php self::beginActionForm('Login', 'User', 'post'); ?>
        <div class="form-group">
            <label for="username">Username</label>
            <input class="form-control" id="username" name="un" value="<?php self::htmlOut($model['username']); ?>">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="pwd">
        </div>

        <button class="btn btn-primary">Log in</button>
    <?php self::endActionForm(); ?>
</div>

<?php self::renderView('partial/footer', $model); ?>