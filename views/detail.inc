<?php self::renderView('partial/header', $model); ?>

<div class="container">
    <div class="row v-center">
        <div class="col-xs-10">
            <h1>Detail - <?php self::htmlOut($model['discussion']->getName()); ?></h1>
            <p>Created by <?php self::htmlOut($model['discussion']->getOriginator()); ?>, on <?php self::htmlOut($model['discussion']->getCreationDate()); ?></p>  
        </div>
        <div class="col-xs-2">
            <h4>
                <strong>
                    <?php
                    if (Privileges\PrivilegeManager::isAuthenticatedUserAllowedToAdd()) {
                        self::actionLink('Add comment', 'Add', 'Comment', array(
                            'did' => $model['discussion']->getId(),
                            'red' => $model['redirectUrl']
                        ));
                    }
                    ?>
                </strong>
            </h4>
        </div>
    </div>
    <?php
    if (sizeof($model['discussion']->getComments()) > 0) {
        self::renderView('partial/information', array('information' => 'Disucssion has ' . sizeof($model['discussion']->getComments()) . ' comments.'));
    } else {
        self::renderView('partial/warning', array('warning' => 'Disucssion has no comments yet.'));
    }
    self::renderView('partial/commentsList', array(
        'redirectUrl' => self::getUrl('Detail', 'Discussion', array('id' => $model['discussion']->getId())),
        'comments' => $model['discussion']->getComments()
    ));
    ?>
</div>

<script>
    $(function () {
        function scroll(hash) {
            $('html, body').animate({
                scrollTop: $(hash).offset().top - 60 + 'px'
            }, 1000, 'swing');
        }

        if (window.location.hash) {
            scroll(window.location.hash);
        }

        $(".comments-list a").on('click', function (e) {
            var href = $(this).attr('href');
            scroll(href.substr(href.indexOf("#")));
        });
    });
</script>

<?php self::renderView('partial/footer', $model); ?>