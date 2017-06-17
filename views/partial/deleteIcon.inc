<?php self::beginActionForm(
        $model['action'], 
        $model['controller'], 
        'post', 
        array_key_exists('params', $model) ? $model['params'] : null, 
        array_key_exists('cssClass', $model) ? $model['cssClass'] : null, 
        array_key_exists('onSubmit', $model) ? $model['onSubmit'] : null); ?>
<button class="btn btn-link">
    <span class="glyphicon glyphicon-remove text-danger"/>
</button>
<?php self::endActionForm(); ?>
