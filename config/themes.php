<?php
$admin_theme = [
    "dir" => "nldpi/default",
    "template" => "admin.php",
];
$themes['admin_nldpi'] = $admin_theme;


$public_theme = [
    "dir" => "nldpi/default",
    "template" => "public.php",
];
$themes['public_nldpi'] = $public_theme;

define('THEMES', $themes);
