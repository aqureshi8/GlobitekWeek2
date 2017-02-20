<?php
require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
	redirect_to('../states/index.php');
}

$errors = array();

$state_id = $_GET['id'];

$territory = array(
	'name' => '',
	'state_id' => $state_id,
	'position' => ''
);

if(is_post_request()) {

	if(isset($_POST['name'])) { $territory['name'] = $_POST['name']; }
	if(isset($_POST['position'])) { $territory['position'] = $_POST['position']; }

	$result = insert_territory($territory);
	if($result === true) {
		$new_id = mysqli_insert_id($db);
		redirect_to(rawurlencode('show.php') . '?id=' . urlencode($new_id));
	}
	else {
		$errors = $result;
	}
}
?>
<?php $page_title = 'Staff: New Territory'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <a href="<?php echo htmlspecialchars("../states/" . rawurlencode("show.php") . "?id=" . urlencode($state_id)); ?>">Back to State Details</a><br />

  <h1>New Territory</h1>

  <?php echo display_errors($errors); ?>

  <!-- TODO add form -->
  <form action="<?php echo htmlspecialchars(rawurlencode("new.php") . "?id=" . urlencode($state_id)); ?>" method="post">
  	<label for="name">Name:</label><br />
  	<input type="text" name="name" id="name" value="<?php echo htmlspecialchars($territory['name']); ?>" /><br />
  	<label for="position">Position:</label><br />
  	<input type="text" name="position" id="position" value="<?php echo htmlspecialchars($territory['position']); ?>" /><br />
  	<br />
  	<input type="submit" name="submit" value="Create" />
  </form>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
