<?php
require_once('../../../private/initialize.php');

// Default values for variables;
$errors = array();
$salesperson = array(
	'first_name' => '',
	'last_name' => '',
	'phone' => '',
	'email' => ''
	);

if(is_post_request()) {

	//Confirm presence of the variable values
	if(isset($_POST['first_name'])) { $salesperson['first_name'] = $_POST['first_name']; }
	if(isset($_POST['last_name'])) { $salesperson['last_name'] = $_POST['last_name']; }
	if(isset($_POST['phone'])) { $salesperson['phone'] = $_POST['phone']; }
	if(isset($_POST['email'])) { $salesperson['email'] = $_POST['email']; }

	$result = insert_salesperson($salesperson);
	if($result === true) {
		$new_id = mysqli_insert_id($db);
		redirect_to(rawurlencode('show.php') . '?id=' . urlencode($new_id));
	}
	else {
		$errors = $result;
	}
}
?>
<?php $page_title = 'Staff: New Salesperson'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <a href="index.php">Back to Salespeople List</a><br />

  <h1>New Salesperson</h1>

  <?php echo display_errors($errors); ?>

  <!-- TODO add form -->
  <form action="new.php" method="post">
  	<label for="first_name">First Name: </label>
  	<br />
  	<input type="text" name="first_name" id="first_name" value="<?php echo htmlspecialchars($salesperson['first_name']); ?>" /><br />
  	<label for="last_name">Last Name: </label>
  	<br />
  	<input type="text" name="last_name" id="last_name" value="<?php echo htmlspecialchars($salesperson['last_name']); ?>" /><br />
  	<label for="phone">Phone: </label>
  	<br />
  	<input type="text" name="phone" id="phone" value="<?php echo htmlspecialchars($salesperson['phone']); ?>" /><br />
  	<label for="email">Email: </label>
  	<br />
  	<input type="text" name="email" id="email" value="<?php echo htmlspecialchars($salesperson['email']); ?>" /><br />
  	<br />
  	<input type="submit" name="submit" value="Create">
  </form>


</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
