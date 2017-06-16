<div class="list-group comments-list">
    <?php foreach ($model as $comment): ?>
        <a href="<?php echo self::getUrl('Detail', 'Discussion', array('id' => $comment->getDiscussionId())) . '#' . $comment->getId(); ?>" class="list-group-item" id="<?php echo $comment->getId(); ?>">
            <h4 class="list-group-item-heading"><?php self::htmlOut($comment->getText()); ?></h4>
            <p class="list-group-item-text">Created by <?php self::htmlOut($comment->getOriginator()); ?>, on <?php self::htmlOut($comment->getCreationDate()); ?></p>  
        </a>
    <?php endforeach; ?>
</div>
