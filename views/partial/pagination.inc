<ul class="pagination">
    <?php if ($model['currentPageNumber'] <= 1): ?>
        <li class="disabled"><a href="#">First</a></li>
        <li class="disabled"><a href="#">Prev</a></li>
    <?php else: ?>
        <li><?php self::actionLinkCurrentPage('First', array($model['paramNamePageNumber'] => 1)); ?></li>
        <li><?php self::actionLinkCurrentPage('Prev', array($model['paramNamePageNumber'] => $model['currentPageNumber'] - 1)); ?></li>
    <?php endif; ?>

    <?php
    for ($i = 1; $i <= $model['pagesToDisplay']; $i++) {
        if ($model['currentPageNumber'] < $model['pivot'] || $model['totalPages'] <= $model['defaultPagesToDisplay']) {
            $pageIndex = $i;
        } else if ($model['currentPageNumber'] >= ($model['totalPages'] - $model['pivot'])) {
            $pageIndex = $model['totalPages'] - ($model['pagesToDisplay'] - $i);
        } else {
            $pageIndex = $model['currentPageNumber'] + ($i - $model['pivot']);
        }
        ?>
        <li class="<?php echo $pageIndex == $model['currentPageNumber'] ? 'active' : ''; ?>"><?php self::actionLinkCurrentPage($pageIndex, array($model['paramNamePageNumber'] => $pageIndex)); ?></li>
    <?php }

    if ($model['currentPageNumber'] >= $model['totalPages']):?>
        <li class="disabled"><a href="#">Next</a></li>
        <li class="disabled"><a href="#">Last</a></li>
    <?php else: ?>
        <li><?php self::actionLinkCurrentPage('Next', array($model['paramNamePageNumber'] => $model['currentPageNumber'] + 1)); ?></li>
        <li><?php self::actionLinkCurrentPage('Last', array($model['paramNamePageNumber'] => $model['totalPages'])); ?></li>
<?php endif; ?>
</ul>