<div class="container">
    <div class="alert alert-danger" role="alert">
        <strong>Please correct the following errors and try again</strong>

        <ul>
            <?php foreach ($model as $errorMsg): ?>
            <li>
                <?php self::htmlOut($errorMsg); ?>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>