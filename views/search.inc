<?php self::renderView('partial/header', $model); ?>

<div class="container">
    <h1>Search</h1>

    <?php self::beginActionForm('Search', 'Discussion', 'post'); ?>
    <div class="input-group">
        <input type="text" placeholder="search string" class="form-control" name="searchString">
        <div class="input-group-btn">
            <button class="btn btn-primary">Search</button>
        </div>
    </div>
    <?php self::endActionForm(); ?>
</div>

<?php self::renderView('partial/footer', $model); ?>