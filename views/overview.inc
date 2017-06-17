<?php self::renderView('partial/header', $model); ?>

<div class="container">
    <h1>Overview</h1>

    <?php
    self::renderView('partial/discussionsList', array(
        'discussions' => $model['discussions']
    ));
    ?>
    <?php self::renderView('partial/pagination', $model['paginationModel']); ?>
</div>

<?php self::renderView('partial/footer', $model); ?>