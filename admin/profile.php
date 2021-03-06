
<?php include("includes/admin_header.php"); ?>

<?php 

	if (isset($_SESSION['username'])) {
		
		$logged_in_user = $_SESSION['username'];

		$query = "SELECT * FROM users WHERE username = '$logged_in_user'";
		$show_user_data = mysqli_query($connection, $query);
		if (!$show_user_data) {
			die("Sorry! Query failed. " . mysqli_error($connection));
		}

		while ($row = mysqli_fetch_assoc($show_user_data)) {
			
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

			$logged_in_user = $_SESSION['username'];

	    	$post_user_firstname  	= mysqli_real_escape_string($connection, $_POST['user_firstname']);
	        $post_user_lastname  	= mysqli_real_escape_string($connection, $_POST['user_lastname']);
	        $post_username  			= mysqli_real_escape_string($connection, $_POST['username']);
	        $post_user_email  		= $_POST['user_email'];
	        $post_user_password  	= $_POST['user_password'];
	        $post_user_role  		= $_POST['user_role'];

	    	$query  = "UPDATE users SET ";
			$query .= "username = '$post_username', ";
			$query .= "user_password = '$post_user_password', ";
			$query .= "user_firstname = '$post_user_firstname', ";
			$query .= "user_lastname = '$post_user_lastname', ";
			$query .= "user_email = '$post_user_email', ";
			$query .= "user_role = '$post_user_role' ";
			// $query .= "user_image = '$user_image' ";
			$query .= "WHERE username = '$logged_in_user'";

			$update_user_query = mysqli_query($connection, $query);
			if (!$update_user_query) {
				die("Query Failed! " . mysqli_error($connection));
			}
			// Regenerates the SESSION value immediately after update
			session_regenerate_id();
			$_SESSION['username'] = $post_username;
	    }

	}

?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include("includes/navigation.php"); ?>

        <div id="page-wrapper">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           Your Profile
                            <!-- <small> &nbsp;Subheading</small> -->
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-fw fa-edit"></i>  <a>View Your Profile</a>
                            </li>
                        </ol>						
			</div>
			
		</div>
		
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-2">
					<!-- Just some space -->
				</div>
				<div class="col-lg-8">

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
							<label for="password">Change Password: &nbsp;</label>
							<input type="password" value="" placeholder="Enter new password" class="form-control" name="user_password" id="password">
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
			</div>
		</div>

		<hr>

		<footer>
            <div class="row">
                <div class="col-lg-6">
                    <p>&copy; Ricochet CMS | 2017</p>
                </div>
                <div class="col-lg-6">
                    <p class="pull-right">Developed by Team Ricochet</p>
                </div>         
            </div>
            <!-- /.row -->
        </footer>
		
<?php include("includes/admin_footer.php") ?>