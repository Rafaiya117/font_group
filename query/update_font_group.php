<?php

include('../api/_a.php');

$groupname = $_POST['groupname'];
$fontname = $_POST['fontname'];
$font = $_POST['font'];

$db->action('UPDATE font_groups SET groupname = ? WHERE groupname = ?', [$groupname]);

foreach ($fontname as $index => $name) {
    $db->action('UPDATE font_group_fonts SET fontname = ?, font = ? WHERE group_id = (SELECT id FROM font_groups WHERE groupname = ?)', [$name, $font[$index], $groupname]);
}

echo 'Font group updated successfully.';
?>
