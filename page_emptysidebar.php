<?php
/*
Template Name: Mit leerer Sidebar
*/
?>
<?php
global $groupslug;
$groupoptions = get_option("pcamp-groups");
$groupslug = get_post_custom_values("_pcamp_groups_group"); 
$groupslug = $groupslug[0];
if (is_array($groupoptions[$groupslug])) {
	$group = $groupoptions[$groupslug];
	include('page_group_emptysidebar.php');
} else {
	include('page_nogroup_emptysidebar.php');
}
?>
