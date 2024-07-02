<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ob_start();

$action = $_GET['action'];
include 'admin_class.php';
$crud = new Action();
if($action == 'login'){
	$login = $crud->login();
	if($login)
		echo $login;
}
if($action == 'login2'){
	$login = $crud->login2();
	if($login)
		echo $login;
}
if($action == 'logout'){
	$logout = $crud->logout();
	if($logout)
		echo $logout;
}
if($action == 'logout2'){
	$logout = $crud->logout2();
	if($logout)
		echo $logout;
}
if($action == 'save_user'){
	$save = $crud->save_user();
	if($save)
		echo $save;
}
if($action == 'update_user'){
	$save = $crud->update_user();
	if($save)
		echo $save;
}
if($action == 'delete_user'){
	$save = $crud->delete_user();
	if($save)
		echo $save;
}
if($action == 'save_branch'){
	$save = $crud->save_branch();
	if($save)
		echo $save;
}
if($action == 'delete_branch'){
	$save = $crud->delete_branch();
	if($save)
		echo $save;
}
if($action == 'delete_staff'){
	$save = $crud->Delete_staff();
	if($save)
	echo $save;
}
if($action == 'save_parcel'){
	$save = $crud->save_parcel();
	if($save)
		echo $save;
}
if($action == 'delete_parcel'){
	$save = $crud->delete_parcel();
	if($save)
		echo $save;
}
if($action == 'update_parcel'){
	$save = $crud->update_parcel();
	if($save)
		echo $save;
}
if($action == 'get_parcel_history'){
	$get = $crud->get_parcel_history();
	if($get)
		echo $get;
}
ob_end_flush();
?>
