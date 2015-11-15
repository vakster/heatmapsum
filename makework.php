<html lang='en'>
<head>
  <meta charset='utf-8'>

  <title> Tuition-Hack </title>
  <meta name='description' content='Tuition-Hack'>
  <meta name='author' content='Matt Newman'>
<body>
	<?php 
include 'config.php';
include 'School.php';
include 'SchoolsController.php';
$columnNames = array();

$institutions = array();
//pulls in the names of the columns in the table 'oldData'
$sql = "SELECT `Institution` FROM `oldData` WHERE 1";
if ($result = mysqli_query($conn, $sql)) {
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($institutions,$row['Institution']);
    }
}



if (isset($_POST['submit'])) {
    $institution = $_POST['School'];
    
    $allSchools = array();
    $sql = "SELECT `Id`, `UnitId`, `Institution`, `Zipcode`, `Address`, `City`, `instate14_15`, `outstate14_15`, `instate13_14`, `outstate13_14`, `instate12_13`, `outstate12_13`, `instate11_12`, `outstate11_12`, `instate10_11`, `outstate10_11`, `instate09_10`, `outstate09_10`, `instate08_09`, `outstate08_09`, `instate07_08`, `outstate07_08`, `instate06_07`, `outstate06_07`, `instate05_06`, `outstate05_06`, `instate04_05`, `outstate04_05`, `instate03_04`, `outstate03_04`, `instate02_03`, `outstate02_03` FROM `oldData` WHERE 1";
    if ($result = mysqli_query($conn, $sql)) {
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($allSchools, $row);
        }
    }
    

    
}  
else {
echo "<form action='makework.php' method='POST'> 
        <select class=\"form-control\" id=\"School\" name='School'>";
          //creates options to be voted on from last name variable
          for ($i = 0;$i<count($institutions);$i++) {
            echo '<option>' . $institutions[$i] . '</option>';
          }
          echo "
        </select>

        <input type='submit' name='submit' value='submit'> 
</form>";
}

	?>

  </body>

  <script src='script.js'></script>
</body>
</html>