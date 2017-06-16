<div class="list-group">
    <?php foreach ($model as $comment): ?>
        <a href="#" class="list-group-item">
            <h4 class="list-group-item-heading"><?php self::htmlOut($comment->getText()); ?></h4>
            <p class="list-group-item-text">Created by <?php self::htmlOut($comment->getOriginator()); ?>, on <?php self::htmlOut($comment->getCreationDate()); ?></p>  
        </a>
    <?php endforeach; ?>
</div>
