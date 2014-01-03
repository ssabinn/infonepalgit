	<div id="content">	

		<div id="loginform">
			<h2>Sign Up Form</h2>

			<?php
				echo validation_errors("<p style='color: #e51717'>", "</p>");
			?>


			<?php
				
				echo form_open('users/signupsubmit');

				echo "<span>Name</span>";
				echo "<br/>";
				echo form_input('name', '');
				echo "<br/>";

				echo "<span>Username</span>";
				echo "<br/>";
				echo form_input('username', '');
				echo "<br/>";

				echo "<span>Password</span>";
				echo "<br/>";				
				echo "<input type='password' name='password'></input> ";	
				echo "<br/>";

				echo "<span>Confirm Password</span>";
				echo "<br/>";				
				echo "<input type='password' name='passwordconf'></input> ";	
				echo "<br/>";

				echo "<span>Email</span>";
				echo "<br/>";				
				echo "<input type='email' name='email'></input> ";	
				echo "<br/>";

				echo form_submit('submit', 'Submit');

				echo form_close();

			?>
		</div>

	</div>