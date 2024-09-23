<?php
include('../api/_a.php');
// print_r($_POST);
// die();
$id = $_POST['id'];
$dlt1 = $db->action('DELETE FROM font_group_fonts WHERE group_id IN (SELECT id FROM font_groups WHERE id = ?)', $id);
$db->action('DELETE FROM font_groups WHERE id =? ', $id);

echo 'Font group deleted successfully.';
?>
