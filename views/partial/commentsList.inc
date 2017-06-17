<script src="js/scripts.js"></script>
<div class="list-group comments-list">
    <?php foreach ($model['comments'] as $comment): ?>
        <a href="<?php echo self::getUrl('Detail', 'Discussion', array('id' => $comment->getDiscussionId())) . '#' . $comment->getId(); ?>" class="list-group-item" id="<?php echo $comment->getId(); ?>">
            <div class="row">
                <div class="col-xs-10">
                    <h4 class="list-group-item-heading"><?php self::htmlOut($comment->getText()); ?></h4>
                    <p class="list-group-item-text">Created by <?php self::htmlOut($comment->getOriginator()); ?>, on <?php self::htmlOut($comment->getCreationDate()); ?></p>  
                </div>
                <?php if (\Privileges\PrivilegeManager::isAuthenticatedUserOriginator($comment->getOriginator())): ?>
                    <div class="col-xs-2">
                        <?php
                        self::renderView('partial/deleteIcon', array(
                            'controller' => 'Comment',
                            'action' => 'Delete',
                            'params' => array(
                                'cid' => $comment->getId(),
                                'red' => $model['redirectUrl']
                            ),
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
