<?php 
    include 'config.php';
    include 'School.php';
    include 'SchoolsController.php';
    $institution = $_POST['School'];
    $year = $_POST['Year'];
  

    $allSchools = array();
    $sql = "SELECT `Id`, `UnitId`, `Institution`, `Zipcode`, `Address`, `City`, `instate14_15`, `outstate14_15`, `instate13_14`, `outstate13_14`, `instate12_13`, `outstate12_13`, `instate11_12`, `outstate11_12`, `instate10_11`, `outstate10_11`, `instate09_10`, `outstate09_10`, `instate08_09`, `outstate08_09`, `instate07_08`, `outstate07_08`, `instate06_07`, `outstate06_07`, `instate05_06`, `outstate05_06`, `instate04_05`, `outstate04_05`, `instate03_04`, `outstate03_04`, `instate02_03`, `outstate02_03` FROM `oldData` WHERE 1";
    if ($result = mysqli_query($conn, $sql)) {
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($allSchools, $row);
        }
    }
    $schoolsController = new SchoolsController($allSchools);
    $avgInState = $schoolsController->getAverage("in", $year);
    $avgOutState = $schoolsController->getAverage("out", $year);
    $mySchool = $schoolsController->getSchoolFromName($institution);
    $mySchoolInState = $mySchool->getTuitionForYear("in", $year);
    $mySchoolOutState = $mySchool->getTuitionForYear("out", $year);

    $html .= "<h4>". $year . " " .$institution." In-State Cost: </h4><p style='color:black;'> $".round($mySchoolInState, 2)." </p>";
    $html .= "<h4>". $year . " " .$institution." Out-of-State Cost: </h4><p style='color:black;'> $".round($mySchoolOutState, 2)." </p>";
    $html .= '<br>';     
    $html .= "<h4>". $year . " National Average In-State Cost: </h4><p style='color:black;'> $".round($avgInState, 2)." </p>";
    $html .= "<h4>". $year . " National Average Out-of-State Cost: </h4><p style='color:black;'> $".round($avgOutState, 2)." </p>";

    echo $html;


?>