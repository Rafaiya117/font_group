<?php

include('../api/_a.php');

$groups = $db->select('SELECT g.id,g.groupname, GROUP_CONCAT(SUBSTRING_INDEX(f.fontname, ".", 1) SEPARATOR ", ") as fontnames, GROUP_CONCAT(SUBSTRING_INDEX(f.font, ".", 1) SEPARATOR ", ") as fonts, COUNT(f.fontname) as font_count 
    FROM font_groups g JOIN font_group_fonts f ON g.id = f.group_id GROUP BY g.groupname');


$output = '';

foreach ($groups as $group) {
    $output .= '<tr>';
    $output .= '<td style="display:none;">' . htmlspecialchars($group['id']) . '</td>'; 
    $output .= '<td style="display:none;">' . htmlspecialchars($group['groupname']) . '</td>'; 
    $output .= '<td>' . htmlspecialchars($group['fontnames']) . '</td>';
    $output .= '<td>' . htmlspecialchars($group['fonts']) . '</td>';
    $output .= '<td>' . htmlspecialchars($group['font_count']) . '</td>';
    $output .= '<td><button class="edit-button">Edit</button> <button class="delete-button">Delete</button></td>';
    $output .= '</tr>';
}
echo $output;

