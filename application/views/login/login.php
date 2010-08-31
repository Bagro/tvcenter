<div id="loginform">
    <h1>Login</h1>
	<?php
	echo form_open('login/validate');
	echo form_input('username', 'Username');
	echo form_password('password', 'Password');
	echo form_submit('submit', 'Login');
	echo form_close();
	?>
</div>