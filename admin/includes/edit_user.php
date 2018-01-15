
	<div class="col-lg-2">
		<!-- Just some space -->
	</div>
	<div class="col-lg-8">

		<?php 

			if (isset($_GET['edit_user'])) {
				$edit_user_id = $_GET['edit_user'];

				$query = "SELECT * FROM users WHERE user_id = $edit_user_id";
		        $show_data_of_user = mysqli_query($connection, $query);

		        while ($row = mysqli_fetch_assoc($show_data_of_user)) {
		            
		            $user_id  		=  $row['user_id'];
		            $username  		=  $row['username'];
		            $user_password  =  $row['user_password'];
		            $user_firstname =  $row['user_firstname'];
		            $user_lastname  =  $row['user_lastname'];
		            $user_email  	=  $row['user_email'];
		            $user_image  	=  $row['user_image'];
		            $user_role  	=  $row['user_role'];
		        }

		        if (isset($_POST['edit_user'])) {

		        	$user_firstname  	= mysqli_real_escape_string($connection, $_POST['user_firstname']);
		            $user_lastname  	= mysqli_real_escape_string($connection, $_POST['user_lastname']);
		            $username  			= mysqli_real_escape_string($connection, $_POST['username']);
		            $user_email  		= $_POST['user_email'];
		            $user_password  	= $_POST['user_password'];
		            $user_role  		= $_POST['user_role'];

		            // Query for decrypting password.
		            $query = "SELECT randSalt FROM users";
                    $select_randSalt_query = mysqli_query($connection, $query);

                    if (!$select_randSalt_query) {
                        die('Sorry! Query failed. ' . mysqli_error($connection));
                    }

                    $row  =  mysqli_fetch_assoc($select_randSalt_query);
                    $salt =  $row['randSalt'];

                    $hashed_password = crypt($user_password, $salt);

		        	$query  = "UPDATE users SET ";
		    		$query .= "username = '$username', ";
		    		$query .= "user_password = '$hashed_password', ";
		    		$query .= "user_firstname = '$user_firstname', ";
		    		$query .= "user_lastname = '$user_lastname', ";
		    		$query .= "user_email = '$user_email', ";
		    		$query .= "user_role = '$user_role' ";
		    		// $query .= "user_image = '$user_image' ";
		    		$query .= "WHERE user_id = '$edit_user_id'";

		    		$update_user_query = mysqli_query($connection, $query);
		    		if (!$update_user_query) {
		    			die("Query Failed! " . mysqli_error($connection));
		    		} else {
				    		echo "<div class='alert alert-success' role='alert'>
										Success! User details <a href='users.php' class='alert-link'>edited</a>.
								  </div>";
			        }

		        }

			}

		?>

		<form action="" method="post" enctype="multipart/form-data">

			<div class="row">
				<div class="col-lg-6">
					<div class="form-group">
						<label for="first-name">First Name: &nbsp;</label>
						<input type="text" value="<?php echo $user_firstname; ?>" class="form-control" name="user_firstname" id="first-name">
					</div>
				</div>

				<div class="col-lg-6">
					<div class="form-group">
						<label for="last-name">Last Name: &nbsp;</label>
						<input type="text" value="<?php echo $user_lastname; ?>" class="form-control" name="user_lastname" id="last-name">
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-6">
					<div class="form-group">
						<label for="username">Username: &nbsp;</label>
						<input type="text" value="<?php echo $username; ?>" class="form-control" name="username" id="username">
					</div>
				</div>

				<div class="col-lg-6">
					<div class="form-group">
						<label for="email">Email: &nbsp;</label>
						<input type="email" value="<?php echo $user_email; ?>" class="form-control" name="user_email" id="email">
					</div>
				</div>
			</div>

			<div class="form-group">
				<label for="password">Password: &nbsp;</label>
				<input type="password" value="<?php echo $user_password; ?>" class="form-control" name="user_password" id="password">
			</div>

			<div class="form-group" style="margin-top: 25px;">
				<label for="user-role">Role: &nbsp;</label>
				<select name="user_role" id="user-role">

					<?php 

						echo "<option>$user_role</option>";

						if ($user_role == 'Admin') {
							echo "<option value='Subscriber'>Subscriber</option>";
						} else {
							echo "<option value='Admin'>Admin</option>";
						}

					?>

				</select>
			</div>

			<div class="form-group">
				<label for="user-image">Image: &nbsp;</label>
				<input type="file" name="image" id="user-image">
			</div>

			<div class="form-group"  style="margin-top: 30px;">
				<input class="btn btn-primary" type="submit" name="edit_user" value="EDIT USER">
			</div>

		</form>

	</div>
		<div class="col-lg-2">
		<!-- Just some space -->
	</div>