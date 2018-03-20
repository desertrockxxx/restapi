<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../config/database.php';
include_once '../objects/category.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare category object
$category = new Category($db);

// get id of category to be edited
$data = json_decode(file_get_contents("php://input"));

// set ID property of category to be edited
$category->id = $data->id;

// set category property values
$category->id = $data->id;
$category->name = $data->name;
$category->description = $data->description;
$category->created = $data->created;


// update the category
if($category->update()){
	echo '{';
		echo '"message": "Category was updated."';
	echo '}';
}

// if unable to update the category, tell the user
else{
	echo '{';
		echo '"message": "Unable to update category."';
	echo '}';
}

?>