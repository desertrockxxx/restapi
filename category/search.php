<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/category.php';
 
// instantiate database and category object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$category = new Category($db);

// get keywords
$keywords = isset($_GET["s"]) ? $_GET["s"] : "";

// query categories
$stmt = $category->search($keywords);
$num = $stmt->rowCount();

// check if more than 0 records found
if($num > 0){

	// products array
	$categories_arr = array();
	$categories_arr['records'] = array();

	// retrieve our table contents
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

		// extract row
		// this will make $row['name'] to just $name only
		extract($row);

		$category_item = array(
			"id" => $id,
			"name" => $name,
			"description" => html_entity_decode($description),
			"created" => $created
		);

		array_push($categories_arr["records"], $category_item);
	}

	echo json_encode($categories_arr);
}

else{
	echo json_encode(
		array("message" => "No products found.")
	);	
}

?>