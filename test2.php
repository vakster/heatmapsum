<?php
	include 'config.php';
	include 'School.php';
	include 'SchoolsController.php';
	$array = array();
	$array2 = array();


	$allSchools = array();
    $sql = "SELECT `Id`, `UnitId`, `Institution`, `Zipcode`, `Address`, `City`, `instate14_15`, `outstate14_15`, `instate13_14`, `outstate13_14`, `instate12_13`, `outstate12_13`, `instate11_12`, `outstate11_12`, `instate10_11`, `outstate10_11`, `instate09_10`, `outstate09_10`, `instate08_09`, `outstate08_09`, `instate07_08`, `outstate07_08`, `instate06_07`, `outstate06_07`, `instate05_06`, `outstate05_06`, `instate04_05`, `outstate04_05`, `instate03_04`, `outstate03_04`, `instate02_03`, `outstate02_03` FROM `oldData` WHERE 1";
    if ($result = mysqli_query($conn, $sql)) {
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($allSchools, $row);
        }
    }
    $SchoolsController = new SchoolsController($allSchools);

    //high tab
	$array3 = $SchoolsController->highestInStateTuition(2014, 20);
	$array4 = $SchoolsController->highestOutStateTuition(2014, 20);
	$array3scaled = $SchoolsController->scaleData($array3, 1000, 3);
	$array4scaled = $SchoolsController->scaleData($array4, 1000, 3);
	$array5 = array($array3scaled, $array4scaled);

	//low tab
	$array6 = $SchoolsController->lowestInStateTuition(2014, 20);
	$array7 = $SchoolsController->lowestOutStateTuition(2014, 20);
	$array6scaled = $SchoolsController->scaleData($array6, 1000, 3);
	$array7scaled = $SchoolsController->scaleData($array7, 1000, 3);
	$array8 = array($array6scaled, $array7scaled);

	//change tab

	$array10 = $SchoolsController->greatestChangeInStateTuition(2014, 20);
	$array11 = $SchoolsController->greatestChangeOutStateTuition(2014, 20);
	$array10scaled = $SchoolsController->scaleData($array10, 1, 2);
	$array11scaled = $SchoolsController->scaleData($array11, 1, 2);
	$array12 = array($array10scaled, $array11scaled); 

	$array9 = array($array5, $array8, $array12);
	// Output our response to the browser
	$output = json_encode($array9);

	echo $output;
?>