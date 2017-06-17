<?php self::renderView('partial/header', $model); ?>

<div class="container">
    <div class="row v-center">
        <div class="col-xs-10">
            <h1>Overview</h1>
        </div>
        <div class="col-xs-2">
            <h4>
                <strong>
                    <?php
                    if (Privileges\PrivilegeManager::isAuthenticatedUserAllowedToAdd()) {
                        self::actionLink('Add discussion', 'Add', 'Discussion');
                    }
                    ?>
                </strong>
            </h4>
        </div>
    </div>

    <?php
    self::renderView('partial/discussionsList', array(
        'discussions' => $model['discussions']
    ));
    ?>
    <?php self::renderView('partial/pagination', $model['paginationModel']); ?>
</div>

<?php self::renderView('partial/footer', $model); ?>