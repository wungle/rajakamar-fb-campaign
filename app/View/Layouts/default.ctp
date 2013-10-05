<?php echo $this->Facebook->html(); ?>
    <head>
        <title><?php echo $title_for_layout ?></title>
    </head>
    <body>
		<script type="text/javascript">
		  //   FB.init({
		  //       appId: 575352032513460,
		  //       status: true,
		  //       cookie: true,
		  //       xfbml: true
		  //   });

		  //   FB.ui(
			 //   {
			 //     method: 'feed',
			 //     name: 'Facebook Dialogs',
			 //     link: 'http://developers.facebook.com/docs/reference/dialogs/',
			 //     picture: 'http://fbrell.com/f8.jpg',
			 //     caption: 'Reference Documentation',
			 //     description: 'Dialogs provide a simple, consistent interface for applications to interface with users.',
			 //     message: 'Facebook Dialogs are easy!'
			 //   },
			 //   function(response) {
			 //     if (response && response.post_id) {
			 //       alert('Post was published.');
			 //     } else {
			 //       alert('Post was not published.');
			 //     }
			 //   }
			 // );
		</script>

        <?php echo $content_for_layout; ?>

	    <?php echo $this->Facebook->init(); ?>
    </body>
</html>

<?php echo $this->fetch('sql_dump'); ?>