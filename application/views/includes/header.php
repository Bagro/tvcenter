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
            base_url = '<?= base_url();?>';
        //]]>
        </script>
        <?php
            if (isset($script_tag)) {
                echo $script_tag;
            } ?>
    </head>
    <body>

