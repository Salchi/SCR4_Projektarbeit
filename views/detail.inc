<?php self::renderView('partial/header', $model); ?>

<div class="container">
    <h1>Detail - <?php self::htmlOut($model['discussion']->getName()); ?></h1>
    <p>Created by <?php self::htmlOut($model['discussion']->getOriginator()); ?>, on <?php self::htmlOut($model['discussion']->getCreationDate()); ?></p>  
    <?php self::renderView('partial/commentsList', $model['discussion']->getComments()); ?>
</div>

<?php self::renderView('partial/footer', $model); ?>