<?php
/*
Template Name: Mit Sidebar
*/
?>
<?php
global $groupslug;
$groupoptions = get_option("pcamp-groups");
$groupslug = get_post_custom_values("_pcamp_groups_group"); 
$groupslug = $groupslug[0];
if (is_array($groupoptions[$groupslug])) {
	$group = $groupoptions[$groupslug];
	include('page_group_sidebar.php');
} else {
	include('page_nogroup_sidebar.php');
}
?>
