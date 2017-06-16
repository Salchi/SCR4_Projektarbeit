    <?php if (isset($model['errors'])) {
        echo "</br>";
        self::renderView('partial/errors', $model['errors']);
    }?>

    <script src="js/bootstrap.min.js"></script>
</body>
</html>