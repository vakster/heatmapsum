<?php
	include 'config.php';
	include 'School.php';
	include 'SchoolsController.php';
	$array = array();
	$array2 = array();
	// Build a JSON array
	/*$sql = "SELECT `".$_POST['test']."`, `instate14_15` FROM `oldData`";
	if ($result = mysqli_query($conn,$sql)) {
		while ($row = mysqli_fetch_assoc($result)) {
			array_push($array,$row[$_POST['test']]);
			array_push($array2,$row['instate14_15']);
		}
	}*/

	$allSchools = array();
    $sql = "SELECT `Id`, `UnitId`, `Institution`, `Zipcode`, `Address`, `City`, `instate14_15`, `outstate14_15`, `instate13_14`, `outstate13_14`, `instate12_13`, `outstate12_13`, `instate11_12`, `outstate11_12`, `instate10_11`, `outstate10_11`, `instate09_10`, `outstate09_10`, `instate08_09`, `outstate08_09`, `instate07_08`, `outstate07_08`, `instate06_07`, `outstate06_07`, `instate05_06`, `outstate05_06`, `instate04_05`, `outstate04_05`, `instate03_04`, `outstate03_04`, `instate02_03`, `outstate02_03` FROM `oldData` WHERE 1";
    if ($result = mysqli_query($conn, $sql)) {
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($allSchools, $row);
        }
    }
    
    $SchoolsController = new SchoolsController($allSchools);
	$array3 = $SchoolsController->topInStateCost(2014);
	// Output our response to the browser
	$output = json_encode($array3);

	echo $output;
?>