<?php 
$target = $_SERVER['DOCUMENT_ROOT'] . '/../storage/app/public'; $link = $_SERVER['DOCUMENT_ROOT'] . '/storage'; if (!is_link($link)) { symlink($target, $link); echo 'Symlink created successfully.'; } else { echo 'Symlink already exists.'; } 
?> 