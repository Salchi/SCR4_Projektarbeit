<script src="js/scripts.js"></script>
<div class="list-group" id="discussions-list">
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
                    <?php if (sizeof($discussion->getComments()) > 0): ?>
                        <p class="list-group-item-text">Last comment by <?php self::htmlOut($discussion->getComments()[0]->getOriginator()); ?>, at <?php self::htmlOut($discussion->getComments()[0]->getCreationDateTime()); ?></p>
                    <?php endif; ?>
                </div>
                <?php if ($model['currUser'] != null && $model['currUser']->getUsername() == $discussion->getOriginator()): ?>
                    <div class="col-xs-2">
                        <?php
                        self::renderView('partial/deleteIcon', array(
                            'controller' => 'Discussion',
                            'action' => 'Delete',
                            'params' => array('id' => $discussion->getId()),
                            'cssClass' => 'delete-form pull-right',
                            'onSubmit' => 'return requestConfirmation(\'Are you sure?\')'
                        ));
                        ?>
                    </div>
                <?php endif; ?>
            </div>
        </a>
    <?php endforeach; ?>
</div>