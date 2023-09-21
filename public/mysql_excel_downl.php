<?php

require ($_SERVER["DOCUMENT_ROOT"] . "/class/class.simpleXLS.php");

include_once '../database/connDatabase.php';

if (!$conn) {
    die("Connection failed:" . mysqli_connect_error());
}

$books = [
    ['ISBN', 'title', 'author', 'publisher', 'ctry' ],
    [618260307, 'The Hobbit', 'J. R. R. Tolkien', 'Houghton Mifflin', 'USA'],
    [908606664, 'Slinky Malinki', 'Lynley Dodd', 'Mallinson Rendel', 'NZ']
];



// $sql = "SELECT * FROM EOW_IBC ORDER BY Num_lotto DESC;";

$sql  = 'SELECT * FROM `users`';

$all_property = array();

$array_data = array();

$dati = array();

$finale = array();



$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));;


while ($property = mysqli_fetch_field($result)) {
    array_push($all_property, $property->name);   
}

array_push($array_data,$all_property);


$dati = mysqli_fetch_all($result, MYSQLI_NUM);


$finale = array_merge($array_data,$dati);


// print_r($finale);


$date_array = getdate();
$date = $date_array['year'] . "_" . $date_array['mon']. "_" . $date_array['mday'];

$nome_file= $date . "_riepilogo".".xlsx";

SimpleXLSXGen::fromArray($finale)->downloadAs($nome_file);

exit();

?>