<div class="list-group">
    <?php foreach ($model['discussions'] as $discussion): ?>
        <a href="<?php self::htmlOut(self::getUrl('Detail', 'Discussion', array('id' => $discussion->getId()))); ?>" class="list-group-item container">
            <div class="row">
                <div class="col-xs-10">
                    <h4 class="list-group-item-heading">
                        <?php
                        self::htmlOut($discussion->getName());
                        ?> <span class="badge"><?php echo sizeof($discussion->getComments()); ?></span>
                    </h4>
                    <p class="list-group-item-text">Created by <?php self::htmlOut($discussion->getOriginator()); ?>, on <?php self::htmlOut($discussion->getCreationDate()); ?></p>  
                    <p class="list-group-item-text">Last comment by NAME_HERE, on DATE_HERE</p>
                </div>
                <?php if ($model['authenticatedUser'] === $discussion->getOriginator()): ?>
                    <div class="col-xs-2">
                        <span class="glyphicon glyphicon-remove pull-right text-danger"/>
                    </div>
                <?php endif; ?>
            </div>
        </a>
    <?php endforeach; ?>
</div>
