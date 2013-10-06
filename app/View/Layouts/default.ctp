<?php echo $this->Facebook->html(); ?>
    <head>
        <title><?php echo $title_for_layout ?></title>
    </head>
    <body>
        <?php echo $content_for_layout; ?>

	    <?php echo $this->Facebook->init(); ?>
    </body>
</html>

<?php echo $this->fetch('sql_dump'); ?>