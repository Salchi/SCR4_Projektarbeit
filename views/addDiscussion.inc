<?php self::renderView('partial/header', $model); ?>

<div class="container">
    <h1>Add Discussion</h1>

    <?php self::beginActionForm('Add', 'Discussion', 'post'); ?>
        <div class="form-group">
            <label for="name">Name</label>
            <input class="form-control" id="name" name="n" value="<?php self::htmlOut($model['name']); ?>" required>
        </div>

        <button class="btn btn-primary">Save</button>
    <?php self::endActionForm(); ?>
</div>

<?php self::renderView('partial/footer', $model); ?>