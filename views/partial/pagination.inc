<ul class="pagination">
    <?php if ($model['currentPageNumber'] <= 1): ?>
        <li class="disabled"><a href="#">First</a></li>
        <li class="disabled"><a href="#">Prev</a></li>
    <?php else: ?>
        <li><a href="<?php echo self::addParamsToUrl($model['baseUri'], array($model['paramNamePageNumber'] => 1)) ?>">First</a></li>
        <li><a href="<?php echo self::addParamsToUrl($model['baseUri'], array($model['paramNamePageNumber'] => $model['currentPageNumber'] - 1)) ?>">Prev</a></li>
    <?php endif; ?>

    <?php
    for ($i = 1; $i <= $model['pagesToDisplay']; $i++) {
        if ($model['currentPageNumber'] < $model['pivot'] || $model['totalPages'] <= $model['defaultPagesToDisplay']) {
            $pageIndex = $i;
        } else if ($model['currentPageNumber'] > ($model['totalPages'] - $model['pivot'])) {
            $pageIndex = $model['totalPages'] - ($model['pagesToDisplay'] - $i);
        } else {
            $pageIndex = $model['currentPageNumber'] + ($i - $model['pivot']);
        }
        ?>
        <li class="<?php echo $pageIndex == $model['currentPageNumber'] ? 'active' : ''; ?>"><a href="<?php self::htmlOut(self::addParamsToUrl($model['baseUri'], array($model['paramNamePageNumber'] => $pageIndex))) ?>"><?php echo $pageIndex ?></a></li>
    <?php }

    if ($model['currentPageNumber'] >= $model['totalPages']):?>
        <li class="disabled"><a href="#">Next</a></li>
        <li class="disabled"><a href="#">Last</a></li>
    <?php else: ?>
        <li><a href="<?php self::htmlOut(self::addParamsToUrl($model['baseUri'], array($model['paramNamePageNumber'] => $model['currentPageNumber'] + 1))) ?>">Next</a></li>
        <li><a href="<?php self::htmlOut(self::addParamsToUrl($model['baseUri'], array($model['paramNamePageNumber'] => $model['totalPages']))) ?>">Last</a></li>
<?php endif; ?>
</ul>