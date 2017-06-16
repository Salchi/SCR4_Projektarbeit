<?php
if (isset($model['errors'])) {
    echo "</br>";
    self::renderView('partial/errors', $model['errors']);
}
?>

<footer class="footer navbar navbar-inverse navbar-fixed-bottom">
    <?php
    if (isset($model['newestComment'])) {
        echo 'Last comment was written by ' . $model['newestComment']->getOriginator() . ', on ' . $model['newestComment']->getCreationDate(); 
    }
    ?>
</footer>

<script src="js/bootstrap.min.js"></script>
</body>
</html>