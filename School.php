<?php
    
    class School {
        
        
        //Instance Data:
        private $id;
        private $unitID;
        private $institution;
        private $zipCode;
        private $address;
        private $city;
        private $inStateTuition = array();
        private $outStateTuition = array();
        private $inStateCoeff == array();
        private $outStateCoeff == array();
        
        //Functions:
        //Initializer(All data) -> store in respective locations, call function 2
        public function __construct($id, $unitID, $institution, $zipCode, $address, $city, $in14, $out14, $in13, $out13, $in12, $out12, $in11, $out11, $in10, $out10, $in9, $out9, $in8, $out8, $in7, $out7, $in6, $out6, $in5, $out5, $in4, $out4, $in3, $out3, $in2, $out2) {
            $this->id = $id;
            $this->unitID = $unitID;
            $this->institution = $institution;
            $this->zipCode = $zipCode;
            $this->address = $address;
            $this->city = $city;
            $this->storeTuitionData("in", $in14, $in13, $in12, $in11, $in10, $in9, $in8, $in7, $in6, $in5, $in4, $in3, $in2);
            $this->storeTuitionData("out", $out14, $out13, $out12, $out11, $out10, $out9, $out8, $out7, $out6, $out5, $out4, $out3, $out2);
            $this->calcCoeffs(); // ***MOVE THIS FUNCTION CALL OUTSIDE CONSTRUCTOR***
            echo "" . $institution . " object created!<br>";
        }
        
        //Create arrays for in and out of state in appropriate variables
        private function storeTuitionData($whichArray, $data14, $data13, $data12, $data11, $data10, $data9, $data8, $data7, $data6, $data5, $data4, $data3, $data2) {
            echo "Which array: " . $whichArray . "<br>";
            
            if ($whichArray == "in") {
                $this->inStateTuition = array("14" => $data14, "13" => $data13, "12" => $data12, "11" => $data11, "10" => $data10, "9" => $data9, "8" => $data8, "7" => $data7, "6" => $data6, "5" => $data5, "4" => $data4, "3" => $data3, "2" => $data2);
                echo "In state tuition: " . $inStateTuition . "<br>";
            }
            else if ($whichArray == "out") {
                $this->outStateTuition = array("14" => $data14, "13" => $data13, "12" => $data12, "11" => $data11, "10" => $data10, "9" => $data9, "8" => $data8, "7" => $data7, "6" => $data6, "5" => $data5, "4" => $data4, "3" => $data3, "2" => $data2);
                echo "Out of state tuition: " . $outStateTuition . "<br>";
            }
            else
                echo "Error";
        }
        
        //Calculates the quadratic coefficients for in and out of state tuition and stores them in appropriate arrays
        private function calcCoeffs() {
            $this->quadReg("in");
            echo "In state coeff: " . $inStateCoeff . "<br>";
            
            $this->quadReg("out");
            echo "Out of state coeff: " . $outStateCoeff . "<br>";
        }
        
        //Get quadratic formula coefficients() -> calculates values of a, b, and c for quadratic equation
        public function quadReg($whichArray) {
            echo "Which array: " . $whichArray . "<br>";
            //Count the number of values
            $tuitionValues = array();
            if ($whichArray == "in") {
                $tuitionValues = $inStateTuition;
                echo "In tuition values: " . $tuitionValues . "<br>";
            }
            else if ($whichArray == "out") {
                $tuitionValues = $outStateTuition;
                echo "Out tuition values: " . $tuitionValues . "<br>";
            }
            $numValues = count($tuitionValues);
            echo "There are " . $numValues . " total tuition values<br>";
            
            //Find Sum of x, y, x^2,, x^3, x^4, x*y, x^2*y
            //Initialize each sum to 0
            $sumx = 0;
            $sumy = 0;
            $sumx2 = 0;
            $sumx3 = 0;
            $sumx4 = 0;
            $sumxy = 0;
            $sumx2y = 0;
            
            //Iterate through tuition value array and add appropriate values to running totals
            foreach($tuitionValues as $key => $currentYearCost) {
                $sumx += $key;
                $sumy += $currentYearCost;
                $sumx2 += $key*$key;
                $sumx3 += $key*$key*$key;
                $sumx4 += $key*$key*$key*$key;
                $sumxy += $key*$currentYearCost;
                $sumx2y += $key*$key*$currentYearCost;
            }
            echo "Sums:<br>" . $sumx . "<br>" . $sumy . "<br>" . $sumx2 . "<br>" . $sumx3 . "<br>" . $sumx4 . "<br>" . $sumxy . "<br>" . $sumx2y . "<br>";
            
            // a = (( Σ x2y * Σ xx ) - (Σ xy * Σ xx2 )) / (( Σ xx * Σ x2x2) - (Σ xx2 * Σ xx2))
            // b = (( Σ xy * Σ x2x2 ) - (Σ x2y * Σ xx2 )) / (( Σ xx * Σ x2x2) - (Σ xx2 * Σ xx2 ))
            // c = ( Σ y / $numValues ) - ( b * ( Σ x / $numValues )) - ( a * ( Σ x2 / $numValues ))
            // where:
            // Σ xx = (($sumx2) - (($sumx * $sumx) / $numValues))
            // Σ xy = (($sumxy) - (($sumx * $sumy) / $numValues))
            // Σ xx2 = (($sumx3) - (($sumx2 * $sumx) / $numValues))
            // Σ x2y = (($sumx2y) - (($sumx2 * $sumy) / $numValues))
            // Σ x2x2 = (($sumx4) - (($sumx2*$sumx2) / $numValues))
            
            $a = (( (($sumx2y) - (($sumx2 * $sumy) / $numValues)) * (($sumx2) - (($sumx * $sumx) / $numValues)) ) - ((($sumxy) - (($sumx * $sumy) / $numValues)) * (($sumx3) - (($sumx2 * $sumx) / $numValues)) )) / (( (($sumx2) - (($sumx * $sumx) / $numValues)) * (($sumx4) - (($sumx2*$sumx2) / $numValues))) - ((($sumx3) - (($sumx2 * $sumx) / $numValues)) * (($sumx3) - (($sumx2 * $sumx) / $numValues)) ));
            $b = (( (($sumxy) - (($sumx * $sumy) / $numValues)) * (($sumx4) - (($sumx2*$sumx2) / $numValues)) ) - ((($sumx2y) - (($sumx2 * $sumy) / $numValues)) * (($sumx3) - (($sumx2 * $sumx) / $numValues)) )) / (( (($sumx2) - (($sumx * $sumx) / $numValues)) * (($sumx4) - (($sumx2*$sumx2) / $numValues))) - ((($sumx3) - (($sumx2 * $sumx) / $numValues)) * (($sumx3) - (($sumx2 * $sumx) / $numValues)) ));
            $c = ( $sumy / $numValues ) - ( $b * ( $sumx / $numValues )) - ( $a * ( $sumx2 / $numValues ));
            echo "a: " . $a . " b: " . $b . " c: " . $c "<br>";
            if ($whichArray == "in")
                $this->inStateCoeff = array($a, $b, $c);
            else if ($whichArray == "out")
                $this->outStateCoeff = array($a, $b, $c);
            
            
        }
        
        //Predict future tuition (whicharray, year) -> Return predicted tuition
        public function getEstimatedTuition($whichArray, $predictionYear) {
            if (($predictionYear >= 2002) && ($predictionYear <= 2100)) {
                $predictionYear -= 2000;
                echo "year: " . $predictionYear . "<br>";
                $predictedTuition = 0;
                if ($whichArray == "in")
                    $predictedTuition = ($inStateCoeff[0]*$predictionYear*$predictionYear + $inStateCoeff[1]*$predictionYear + $inStateCoeff[2]);
                else if ($whichArray == "out")
                    $predictedTuition = ($outStateCoeff[0]*$predictionYear*$predictionYear + $outStateCoeff[1]*$predictionYear + $outStateCoeff[2]);
                return $predictedTuition;
            }
        }
        
        //getters for all data() -> Return data
        public function getid() {
            return $id;
        }
        
        public function getunitID() {
            return $unitID;
        }
        
        public function getinstitution() {
            return $institution;
        }
        
        public function getzipCode() {
            return $zipCode;
        }
        
        public function getaddress() {
            return $address;
        }
        
        public function getcity() {
            return $city;
        }
        
        public function getinStateTuition() {
            return $inStateTuition;
        }
        
        public function getoutStateTuition() {
            return $outStateTuition;
        }
        //Setters for some variables (data) if needed???
        
    }
    
    ?>