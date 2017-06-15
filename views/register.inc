<?php self::renderView('partial/header', $model); ?>

<div class="container">
    <h1>Register</h1>

    <?php self::beginActionForm('Register', 'User', 'post'); ?>
        <div class="form-group">
            <label for="username">Username</label>
            <input class="form-control" id="username" name="un" value="<?php self::htmlOut($model['username']); ?>" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="pwd" required>
        </div>
        <div class="form-group">
            <label for="confirmedPassword">Confirm Password</label>
            <input type="password" class="form-control" id="confirmedPassword" name="confirmedPwd" required>
        </div>

        <button class="btn btn-primary">Register</button>
    <?php self::endActionForm(); ?>
</div>
<?php self::renderView('partial/footer', $model); ?>