<?php
require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
  redirect_to('index.php');
}
$states_result = find_state_by_id($_GET['id']);
// No loop, only one result
$state = db_fetch_assoc($states_result);

$errors = array();

if(is_post_request()) {

	if(isset($_POST['name'])) { $state['name'] = $_POST['name']; }
	if(isset($_POST['code'])) { $state['code'] = $_POST['code']; }
	if(isset($_POST['country_id'])) { $state['country_id'] = $_POST['country_id']; }

	$result = update_state($state);
	if($result === true) {
		redirect_to(rawurlencode('show.php') . '?id=' . urlencode($state['id']));
	}
	else {
		$errors = $result;
	}
}
?>
<?php $page_title = 'Staff: Edit State ' . htmlspecialchars($state['name']); ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <a href="index.php">Back to States List</a><br />

  <h1>Edit State: <?php echo htmlspecialchars($state['name']); ?></h1>

  <?php echo display_errors($errors); ?>

  <!-- TODO add form -->
  <form action="<?php echo htmlspecialchars(rawurlencode("edit.php") . "?id=" . urlencode($state['id'])); ?>" method="post">
	<label for="name">Name: </label>
	<br />
	<input type="text" name="name" id="name" value="<?php echo htmlspecialchars($state['name']); ?>" />
	<br />
	<label for="code">Code: </label>
	<br />
	<input type="text" name="code" id="code" value="<?php echo htmlspecialchars($state['code']); ?>" />
	<br />
	<label for="country_id">Country ID: </label>
	<br />
	<input type="text" name="country_id" id="country_id" value="<?php echo htmlspecialchars($state['country_id']); ?>" />
	<br />
	<br />
	<input type="submit" name="submit" value="Create" />
  </form>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
