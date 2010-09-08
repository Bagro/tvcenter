<?php $this->load->view('includes/header'); ?>
<div id="left_content">
<?php 
	if(isset($left_content))
		$this->load->view($left_content);
?>		
</div>
<div id="main_content">
<?php $this->load->view($main_content); ?>
</div>
<?php $this->load->view('includes/footer'); ?>