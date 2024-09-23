<?php

include('../api/_a.php');

if (!empty($_POST)) {
    $groupname = $_POST['groupname'];
    $fontnames = $_POST['fontname'];  
    $fonts = $_POST['font']; 

    if (strlen($groupname) < 2) {
        echo 'Error: Group name must be at least 2 characters long.';
        exit;
    }
    if (count($fontnames) !== count($fonts)) {
        echo 'Error: Mismatch between font names and font selections.';
        exit;
    }

    $groupId = $db->action('INSERT INTO font_groups (groupname) VALUES (?)', $groupname);
    foreach ($fontnames as $index => $fontname) {
        $font = $fonts[$index];
        $db->action('INSERT INTO font_group_fonts (group_id, groupname ,fontname, font) VALUES (?, ?, ?, ?)', $groupId, $groupname ,$fontname, $font);
    }

    echo 'Font group created successfully!';
}
