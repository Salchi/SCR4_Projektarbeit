<?php self::renderView('partial/header', $model); ?>

<div class="container">
    <h1>Add Comment</h1>

    <?php
    self::beginActionForm('Add', 'Comment', 'post', array(
        'did' => $model['discussionId'],
        'red' => $model['redirectUrl']
    ));
    ?>
    <div class="form-group">
        <label for="text">Comment</label>
        <textarea class="form-control" id="text" name="ct" value="<?php self::htmlOut($model['text']); ?>" required></textarea>
    </div>

    <button class="btn btn-primary">Save</button>
<?php self::endActionForm(); ?>
</div>

<?php self::renderView('partial/footer', $model); ?>
