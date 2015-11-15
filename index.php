<!DOCTYPE html>
<html lang="en-US">
    <html>
        
        <head>
            <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
            <link rel="stylesheet" href="styles.css">
            <meta charset="UTF-8">
            <link rel="http://i.imgur.com/3qcrS4Z.png" href="favicon.ico" />
            <title>
                <Tuition-Hack/>
            </title>
            <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.js"></script>
            <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false&amp;v=3"></script>
            <script src="tabbing.js"></script>
            <!--SHOWS AND HIDES THE TABS -->
            <script src="tabHide.js"></script>
            <!--GOOGLE MAP IMPLEMENTATION -->
            <script src="featureMap.js"></script>
              <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
  <!-- bootstrap -->
  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
  <link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
  <script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.js'> </script>
        </head>
        
        <body>
            <div id="container" class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-5">
                        <div class="box fade-in one">
                             <h1> < Tuition Hack /></h1>

                        </div>
                        <br><br><br>
                         <h4>Feel the  <span class="burn">Burn</span> before you  <span class="learn">Learn</span></h4>

                    </div>

                </div>
                <br />
                <div class="row">
                    <ul class="nav nav-tabs">
                        <li class="active">	
                          <a href="#tab1"> Maps </a>
                        </li>
                        <li>	
                          <a href="#tab2" class='future'> Future Cost Prediction </a>
                        </li>
                        <li>	
                          <a href="#tab3" class='highest'> Highest Cost Schools </a>
                        </li>
                        <li> 
                          <a href="#tab4" class='lowest'> Lowest Cost Schools </a>
                        </li>
                          <li> 
                          <a href="#tab5" class='change'> Change of School Costs </a>
                        </li>
                    </ul>
                </div>
                <section id="tab1" class="tab-content active">
                  <p> Toggle on and off the heatmap by utilizing the switch. </p>
                <div id="map-canvas">

                  <input id="heatmap" value="true" type="checkbox" />  <label for="heatmap"> </label>
                </div>
                    <div id="googft-mapCanvas"></div>
                    <div id="wrap">
                </section>
                <section id="tab2" class="tab-content hide">
                    <div id="wrap">
                      <?php

                      include 'config.php';
                      include 'SchoolsController.php';
                      include 'School.php';

if (isset($_POST['submitFuture'])) {
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

    echo "<h4>". $year . " " .$institution." In-State Cost: </h4><p style='color:black;'> $".round($mySchoolInState, 2)." </p>";
    echo "<h4>". $year . " " .$institution." Out-of-State Cost: </h4><p style='color:black;'> $".round($mySchoolOutState, 2)." </p>";
    echo '<br>';     
    echo "<h4>". $year . " National Average In-State Cost: </h4><p style='color:black;'> $".round($avgInState, 2)." </p>";
   echo "<h4>". $year . " National Average Out-of-State Cost: </h4><p style='color:black;'> $".round($avgOutState, 2)." </p>";
}
else {
      $institutions = array();
      $sql = "SELECT `Institution` FROM `oldData` WHERE 1";
      if ($result = mysqli_query($conn,$sql)) {
        while($row = mysqli_fetch_assoc($result)) {
          array_push($institutions,$row['Institution']);
        }
      }
     echo "<form action='index.php' method='POST' name='future' id='future'>
     <label> Select an institution that you are interested in seeing information about. </label>
     <select class=\"form-control\" id=\"School\" name='School'>";
     //creates options to be voted on from last name variable
     for ($i = 0;$i<count($institutions);$i++) {
     echo '<option>' . $institutions[$i] . '</option>';
     }
     echo "
     </select>
     <br><br>

      <label> Select a year for which you would like past/predicted cost data. </label>
     <select class=\"form-control\" id=\"Year\" name='Year'>";
     //creates options to be voted on from last name variable
     for ($year = 2002;$year<2026;$year++) {
     echo '<option>' . $year . '</option>';
     }
     echo "
     </select>
     <br>
     <input type='submit' name='submitFuture' id ='submitFuture' value='submit'>
     </form>";
   }
     ?>
                    </div>
                    <script src="resizeImage.js"></script>
                </section>
                <section id="tab3" class="tab-content hide">
                    <div id="wrap">
                        <h4> Highest In-State Tuition in Thousands of Dollars in 2014-15 Academic Year</h4> 
                        <canvas id="myChart" width="500" height="400" style="width: 800px; height: 500px;">  </canvas>    
                        <h4> Highest Out-of-State Tuition in Thousands of Dollars in 2014-15 Academic Year</h4> 
                        <canvas id="myChart2" width="500" height="400" style="width: 800px; height: 500px;">  </canvas>    
                    </div>
                </section>
                <section id="tab4" class="tab-content hide">
                    <div id="wrap">
                        <h4> Lowest In-State Tuition in Thousands of Dollars in 2014-15 Academic Year</h4> 
                        <canvas id="myChart3" width="500" height="400" style="width: 800px; height: 500px;">  </canvas>    
                        <h4> Lowest Out-of-State Tuition in Thousands of Dollars in 2014-15 Academic Year</h4> 
                        <canvas id="myChart4" width="500" height="400" style="width: 800px; height: 500px;">  </canvas>    
                    </div>
                </section>
                <section id="tab5" class="tab-content hide">
                    <div id="wrap">
                        <h4> Greatest Change of In-State Costs Between Years </h4> 
                        <canvas id="myChart5" width="500" height="400" style="width: 800px; height: 500px;">  </canvas>    
                        <h4> Greatest Change of Out-State Costs Between Years </h4> 
                        <canvas id="myChart6" width="500" height="400" style="width: 800px; height: 500px;">  </canvas>    
                    </div>
                </section>
                <br />
                <div id="main"></div>
                </div>
                <div id="footer">
                    <div class="container">
                        <p class="muted credit">Copyright &copy; 2015 < Tuition Hack /> Hack Princeton</p>
                        <p class="muted credit">Gregory Vaks, Matthew Newman, Joseph Stack, Daniel Saganome, Patrick Monaghan</p>
                    </div>
                </div>
                <script>


$('.change').click(function() {
                 // Call the getData function
              getData();            
 
          // The function that makes the request to our PHP script
          function getData()
          {
            // Ajax call
            $.ajax({
              type: "POST",
              url: "test2.php",
              dataType: "json",
              data: $('#stuff').serialize(),
              success: response
            });
          }
 
          // This function runs once we get our data from PHP
          function response(json)
          {
             // Get context with jQuery - using jQuery's .get() method.
            var ctx5 = $("#myChart5").get(0).getContext("2d");
            var ctx6 = $("#myChart6").get(0).getContext("2d");
            var myNewChart5 = new Chart(ctx5);
            var myNewChart6 = new Chart(ctx6);
            var data5 = {
                labels: json[2][0][0],
                datasets: [
                    {
                        label: "First",
                        fillColor: "rgba(220,220,220,0.5)",
                        strokeColor: "rgba(220,220,220,0.8)",
                        highlightFill: "rgba(220,220,220,0.75)",
                        highlightStroke: "rgba(220,220,220,1)",
                        data: json[2][0][1]
                    }
                ]
            };

            var data6 = {
                labels: json[2][1][0],
                datasets: [
                    {
                        label: "Second",
                        fillColor: "rgba(220,220,220,0.5)",
                        strokeColor: "rgba(220,220,220,0.8)",
                        highlightFill: "rgba(220,220,220,0.75)",
                        highlightStroke: "rgba(220,220,220,1)",
                        data: json[2][1][1]
                    }
                ]
            }

            var myBarChart5 = new Chart(ctx5).Bar(data5);
            var myBarChart6 = new Chart(ctx6).Bar(data6);
          }
          });
 $('.highest').click(function() {
                 // Call the getData function
              getData();            
 
          // The function that makes the request to our PHP script
          function getData()
          {
            // Ajax call
            $.ajax({
              type: "POST",
              url: "test2.php",
              dataType: "json",
              data: $('#stuff').serialize(),
              success: response
            });
          }
 
          // This function runs once we get our data from PHP
          function response(json)
          {
             // Get context with jQuery - using jQuery's .get() method.
            var ctx = $("#myChart").get(0).getContext("2d");
            var ctx2 = $("#myChart2").get(0).getContext("2d");
            var myNewChart = new Chart(ctx);
            var myNewChart2 = new Chart(ctx2);
            var data1 = {
                labels: json[0][0][0],
                datasets: [
                    {
                        label: "First",
                        fillColor: "rgba(220,220,220,0.5)",
                        strokeColor: "rgba(220,220,220,0.8)",
                        highlightFill: "rgba(220,220,220,0.75)",
                        highlightStroke: "rgba(220,220,220,1)",
                        data: json[0][0][1]
                    }
                ]
            };

            var data2 = {
                labels: json[0][1][0],
                datasets: [
                    {
                        label: "Second",
                        fillColor: "rgba(220,220,220,0.5)",
                        strokeColor: "rgba(220,220,220,0.8)",
                        highlightFill: "rgba(220,220,220,0.75)",
                        highlightStroke: "rgba(220,220,220,1)",
                        data: json[0][1][1]
                    }
                ]
            };

            var myBarChart = new Chart(ctx).Bar(data1);
            var myBarChart2 = new Chart(ctx2).Bar(data2);
          }
          });
        
        $('.lowest').click(function() {
                 // Call the getData function
              getData();            
 
          // The function that makes the request to our PHP script
          function getData()
          {
            // Ajax call
            $.ajax({
              type: "POST",
              url: "test2.php",
              dataType: "json",
              data: $('#stuff').serialize(),
              success: response
            });
          }
 
          // This function runs once we get our data from PHP
          function response(json)
          {
             // Get context with jQuery - using jQuery's .get() method.
            var ctx3 = $("#myChart3").get(0).getContext("2d");
            var ctx4 = $("#myChart4").get(0).getContext("2d");
            var myNewChart3 = new Chart(ctx3);
            var myNewChart4 = new Chart(ctx4);
            var data3 = {
                labels: json[1][0][0],
                datasets: [
                    {
                        label: "First",
                        fillColor: "rgba(220,220,220,0.5)",
                        strokeColor: "rgba(220,220,220,0.8)",
                        highlightFill: "rgba(220,220,220,0.75)",
                        highlightStroke: "rgba(220,220,220,1)",
                        data: json[1][0][1]
                    }
                ]
            };

            var data4 = {
                labels: json[1][1][0],
                datasets: [
                    {
                        label: "Second",
                        fillColor: "rgba(220,220,220,0.5)",
                        strokeColor: "rgba(220,220,220,0.8)",
                        highlightFill: "rgba(220,220,220,0.75)",
                        highlightStroke: "rgba(220,220,220,1)",
                        data: json[1][1][1]
                    }
                ]
            };

            var myBarChart3 = new Chart(ctx3).Bar(data3);
            var myBarChart4 = new Chart(ctx4).Bar(data4);


          }
          });
</script>
        </body>
    
    </html>
