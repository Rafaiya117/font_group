<?php

include('../api/_a.php');

$id = $_POST['id'];
// print_r($_POST);
// die();


$group = $db->select('SELECT g.id, g.groupname, f.fontname, f.font FROM font_groups g JOIN font_group_fonts f ON g.id = f.group_id WHERE g.id = ?', $id);


echo json_encode($group);
?>
