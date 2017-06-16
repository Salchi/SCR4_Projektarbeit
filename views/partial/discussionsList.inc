<div class="list-group">
    <?php foreach ($model as $discussion): ?>
        <a href="<?php echo self::getUrl('Detail', 'Discussion', array('id' => $discussion->getId())); ?>" class="list-group-item">
            <h4 class="list-group-item-heading"><?php self::htmlOut($discussion->getName()); ?> <span class="badge"><?php echo sizeof($discussion->getComments()); ?></span></h4>
            <p class="list-group-item-text">Created by <?php self::htmlOut($discussion->getOriginator()); ?>, on <?php self::htmlOut($discussion->getCreationDate()); ?></p>  
            <p class="list-group-item-text">Last comment by NAME_HERE, on DATE_HERE</p>
        </a>
    <?php endforeach; ?>
</div>
