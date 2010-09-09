<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <title>
            <?php
            if (isset($page_title)) {
                echo $page_title;
            } ?>
        </title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>/css/style.css" type="text/css" media="screen" />
        <script type="text/javascript" src="<?php echo base_url(); ?>/scripts/jquery.js"> </script>
        <script type="text/javascript">
        //<![CDATA[
            base_url = '<?php echo base_url();?>';
        //]]>
        </script>
        <?php
            if (isset($script_tag)) {
                echo $script_tag;
            } ?>
    </head>
    <body>
	<div id="page_wrap">
		<div id="nav_bar">
			<div id="main_menu">
				<ul>
					<li><a href="<?php echo base_url(); ?>">Start</a></li>
					<li><a href="#">Serier</a></li>
					<li><a href="#">Favoriter</a></li>
				</ul>
			</div>
		</div>
