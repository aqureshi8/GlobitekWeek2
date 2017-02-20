<?php require_once('../../../private/initialize.php'); ?>

<?php
if(!isset($_GET['id'])) {
  redirect_to('../states/index.php');
}
$id = $_GET['id'];
$territory_result = find_territory_by_id($id);
// No loop, only one result
$territory = db_fetch_assoc($territory_result);
$state_id = $territory['state_id'];
?>

<?php $page_title = 'Staff: Territory of ' . htmlspecialchars($territory['name']); ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <a href="<?php echo htmlspecialchars("../states/" . rawurlencode("show.php") . "?id=" . urlencode("$state_id")); ?>">Back to State Details</a>
  <br />

  <h1>Territory: <?php echo htmlspecialchars($territory['name']); ?></h1>

  <?php
    echo "<table id=\"territory\">";
    echo "<tr>";
    echo "<td>Name: </td>";
    echo "<td>" . htmlspecialchars($territory['name']) . "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>State ID: </td>";
    echo "<td>" . htmlspecialchars($territory['state_id']) . "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>Position: </td>";
    echo "<td>" . htmlspecialchars($territory['position']) . "</td>";
    echo "</tr>";
    echo "</table>";

    db_free_result($territory_result);
  ?>
  <br />
  <a href="<?php echo htmlspecialchars(rawurlencode("edit.php") . "?id=" . urlencode($territory['id'])); ?>">Edit</a><br />

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
