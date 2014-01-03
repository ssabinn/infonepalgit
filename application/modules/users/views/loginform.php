	<div id="content">	

		<div id="loginform">
			<h2>Login Form</h2>

			<?php
				echo validation_errors("<p style='color: #e51717'>", "</p>");
			?>


			<?php
				
				echo form_open('users/submit');

				echo "<span>Username</span>";
				echo "<br/>";
				echo form_input('username', '');
				echo "<br/>";

				echo "<span>Password</span>";
				echo "<br/>";				
				echo "<input type='password' name='password'></input> ";	
				echo "<br/>";

				echo form_submit('submit', 'Submit');

				echo form_close();

			?>
			<br/>
			<p><a href="<?php echo base_url()."/users/create" ?>">Create new account</a></p>
		</div>



	</div>