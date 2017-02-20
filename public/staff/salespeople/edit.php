<?php
require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
  redirect_to('index.php');
}
$salespeople_result = find_salesperson_by_id($_GET['id']);
// No loop, only one result
$salesperson = db_fetch_assoc($salespeople_result);

$errors = array();

if(is_post_request()) {

	if(isset($_POST['first_name'])) { $salesperson['first_name'] = $_POST['first_name']; }
	if(isset($_POST['last_name'])) { $salesperson['last_name'] = $_POST['last_name']; }
	if(isset($_POST['phone'])) { $salesperson['phone'] = $_POST['phone']; }
	if(isset($_POST['email'])) { $salesperson['email'] = $_POST['email']; }

	$result = update_salesperson($salesperson);
	if($result === true) {
		redirect_to(rawurlencode('show.php') . '?id=' . urlencode($salesperson['id']));
	}
	else {
		$errors = $result;
	}
}
?>
<?php $page_title = 'Staff: Edit Salesperson ' . htmlspecialchars($salesperson['first_name']) . " " . htmlspecialchars($salesperson['last_name']); ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <a href="index.php">Back to Salespeople List</a><br />

  <h1>Edit Salesperson: <?php echo htmlspecialchars($salesperson['first_name']) . " " . htmlspecialchars($salesperson['last_name']); ?></h1>

  <!-- TODO add form -->
  <form action="<?php echo htmlspecialchars(rawurlencode("edit.php") . "?id=" . urlencode($salesperson['id'])); ?>" method="post">
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
  	<input type="submit" name="submit" value="Update">
  </form>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
