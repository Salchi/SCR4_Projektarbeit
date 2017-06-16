<?php self::renderView('partial/header', $model); ?>

<div class="container">
    <h1>Search</h1>

    <?php self::beginActionForm('Search', 'Search', 'post'); ?>
    <div class="input-group">
        <input type="text" placeholder="search string" class="form-control" name="searchString" value="<?php echo $model['searchString']; ?>" required>
        <div class="input-group-btn">
            <button class="btn btn-primary">Search</button>
        </div>
    </div>
    <br><br>
    <?php self::endActionForm(); ?>

    <?php if (sizeof($model['result']) > 0): ?>
        <div class="alert alert-info">
            <strong>Found <?php echo $model['numberOfComments']; ?> comments.</strong>
        </div>
        <?php
        self::renderView('partial/commentsList', $model['result']);
        self::renderView('partial/pagination', $model['paginationModel']);
    elseif ($model['result'] !== null):
        ?>
        <div class="alert alert-warning">
            <strong>No comment contains '<?php echo $model['searchString'] ?>'.</strong>
        </div>
    <?php endif; ?>
</div>

<?php self::renderView('partial/footer', $model); ?>