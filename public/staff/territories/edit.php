<?php
require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
  redirect_to('index.php');
}
$territories_result = find_territory_by_id($_GET['id']);
// No loop, only one result
$territory = db_fetch_assoc($territories_result);

$errors = array();

if(is_post_request()) {

	if(isset($_POST['name'])) { $territory['name'] = $_POST['name']; }
	if(isset($_POST['position'])) { $territory['position'] = $_POST['position']; }

	$result = update_territory($territory);
	if($result === true) {
		redirect_to(rawurlencode('show.php') . '?id=' . urlencode($territory['id']));
	}
	else {
		$errors = $result;
	}
}
?>
<?php $page_title = 'Staff: Edit Territory ' . htmlspecialchars($territory['name']); ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <a href="<?php echo htmlspecialchars("../states/" . rawurlencode("show.php") . "?id=" . urlencode($territory['state_id'])); ?>">Back to State Details</a><br />

  <h1>Edit Territory: <?php echo htmlspecialchars($territory['name']); ?></h1>

  <?php echo display_errors($errors); ?>

  <!-- TODO add form -->
  <form action="<?php echo htmlspecialchars(rawurlencode("edit.php") . "?id=" . urlencode($territory['id'])); ?>" method="post">
  	<label for="name">Name:</label><br />
  	<input type="text" name="name" id="name" value="<?php echo htmlspecialchars($territory['name']); ?>" /><br />
  	<label for="position">Position:</label><br />
  	<input type="text" name="position" id="position" value="<?php echo htmlspecialchars($territory['position']); ?>" /><br />
  	<br />
  	<input type="submit" name="submit" value="Create" />
  </form>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
