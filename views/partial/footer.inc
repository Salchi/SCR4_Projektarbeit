    <?php if (isset($model['errors'])) {
        echo "</br>";
        self::renderView('partial/errors', $model['errors']);
    }?>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>