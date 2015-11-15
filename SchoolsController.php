<?php
    class SchoolsController {
        
        private $Schools = array();
        
        public function __construct($allSchools) {
            for ($i = 0; $i < count($allSchools); $i++) {
                $number = $allSchools[$i]['Id'];
                $currentSchool = new School($allSchools[$i]['Id'], $allSchools[$i]['UnitId'], $allSchools[$i]['Institution'], $allSchools[$i]['Zipcode'], $allSchools[$i]['Address'], $allSchools[$i]['City'], $allSchools[$i]['instate14_15'], $allSchools[$i]['outstate14_15'], $allSchools[$i]['instate13_14'], $allSchools[$i]['outstate13_14'], $allSchools[$i]['instate12_13'], $allSchools[$i]['outstate12_13'], $allSchools[$i]['instate11_12'], $allSchools[$i]['outstate11_12'], $allSchools[$i]['instate10_11'], $allSchools[$i]['outstate10_11'], $allSchools[$i]['instate09_10'], $allSchools[$i]['outstate09_10'], $allSchools[$i]['instate08_09'], $allSchools[$i]['outstate08_09'], $allSchools[$i]['instate07_08'], $allSchools[$i]['outstate07_08'], $allSchools[$i]['instate06_07'], $allSchools[$i]['outstate06_07'], $allSchools[$i]['instate05_06'], $allSchools[$i]['outstate05_06'], $allSchools[$i]['instate04_05'], $allSchools[$i]['outstate04_05'], $allSchools[$i]['instate03_04'], $allSchools[$i]['outstate03_04'], $allSchools[$i]['instate02_03'], $allSchools[$i]['outstate02_03']);
                $this->Schools[$number] = $currentSchool;
            }
        }
        
        public function getSchoolFromName($schoolName) {
            foreach($this->Schools as $currentSchool) {
                $currentName = $currentSchool->getInstitution();
                if ($currentName == $schoolName) {
                    return $currentSchool;
                }
            }
        }
        
        public function getAverage($inOrOut, $year) {
            $i;
            $sum = 0;
            for ($i = 1; $i <= count($this->Schools); $i++) {
                $currentSchool = $this->Schools[$i];
                $currentCost = $currentSchool->getTuitionForYear($inOrOut, $year);
                $sum += $currentCost;
            }
            $average = $sum / $i;
            return $average;
        }
        
        public function scaleData($inputData, $scaleFactor, $decPlaces) {
            for ($i = 0; $i < count($inputData[1]); $i++) {
                $newData = $inputData[1][$i] / $scaleFactor;
                $inputData[1][$i] = round($newData, $decPlaces);
            }
            return $inputData;
        }
        
        public function highestInStateTuition($year, $numToShow) {
            $inStateCostArray = array();
            foreach($this->Schools as $key => $currentSchool) {
                $thisYearTuition = $currentSchool->getTuitionForYear("in", $year);
                $inStateCostArray[$key] = $thisYearTuition;
            }
            arsort($inStateCostArray);
            $i = 0;
            $top10 = array();
            foreach($inStateCostArray as $key => $currentCost) {
                if ($i == $numToShow) {
                    break;
                }
                $top10[$key] = $currentCost;
                $i++;
            }
            $schoolNames = array();
            $shoolCosts = array();
            foreach($top10 as $key => $cost) {
                $mySchool = $this->Schools[$key];
                $mySchoolName = $mySchool->getInstitution();
                $schoolNames[] = $mySchoolName;
                $schoolCosts[] = $cost;
            }
            $top10ByName = array($schoolNames, $schoolCosts);
            return $top10ByName;
        }
        
        public function highestOutStateTuition($year, $numToShow) {
            $outStateCostArray = array();
            foreach($this->Schools as $key => $currentSchool) {
                $thisYearTuition = $currentSchool->getTuitionForYear("out", $year);
                $outStateCostArray[$key] = $thisYearTuition;
            }
            arsort($outStateCostArray);
            $i = 0;
            $top10 = array();
            foreach($outStateCostArray as $key => $currentCost) {
                if ($i == $numToShow) {
                    break;
                }
                $top10[$key] = $currentCost;
                $i++;
            }
            $schoolNames = array();
            $shoolCosts = array();
            foreach($top10 as $key => $cost) {
                $mySchool = $this->Schools[$key];
                $mySchoolName = $mySchool->getInstitution();
                $schoolNames[] = $mySchoolName;
                $schoolCosts[] = $cost;
            }
            $top10ByName = array($schoolNames, $schoolCosts);
            return $top10ByName;
        }
        
        public function lowestInStateTuition($year, $numToShow) {
            $inStateCostArray = array();
            foreach($this->Schools as $key => $currentSchool) {
                $thisYearTuition = $currentSchool->getTuitionForYear("in", $year);
                $inStateCostArray[$key] = $thisYearTuition;
            }
            asort($inStateCostArray);
            $i = 0;
            $top10 = array();
            foreach($inStateCostArray as $key => $currentCost) {
                if ($i == $numToShow) {
                    break;
                }
                $top10[$key] = $currentCost;
                $i++;
            }
            $schoolNames = array();
            $shoolCosts = array();
            foreach($top10 as $key => $cost) {
                $mySchool = $this->Schools[$key];
                $mySchoolName = $mySchool->getInstitution();
                $schoolNames[] = $mySchoolName;
                $schoolCosts[] = $cost;
            }
            $top10ByName = array($schoolNames, $schoolCosts);
            return $top10ByName;
        }
        
        public function lowestOutStateTuition($year, $numToShow) {
            $outStateCostArray = array();
            foreach($this->Schools as $key => $currentSchool) {
                $thisYearTuition = $currentSchool->getTuitionForYear("out", $year);
                $outStateCostArray[$key] = $thisYearTuition;
            }
            asort($outStateCostArray);
            $i = 0;
            $top10 = array();
            foreach($outStateCostArray as $key => $currentCost) {
                if ($i == $numToShow) {
                    break;
                }
                $top10[$key] = $currentCost;
                $i++;
            }
            $schoolNames = array();
            $shoolCosts = array();
            foreach($top10 as $key => $cost) {
                $mySchool = $this->Schools[$key];
                $mySchoolName = $mySchool->getInstitution();
                $schoolNames[] = $mySchoolName;
                $schoolCosts[] = $cost;
            }
            $top10ByName = array($schoolNames, $schoolCosts);
            return $top10ByName;
        }
        
        public function greatestDifferenceInTuition($year, $numToShow) {
            $tuitionDifferenceArray = array();
            foreach($this->Schools as $key => $currentSchool) {
                $thisYearInTuition = $currentSchool->getTuitionForYear("in", $year);
                $thisYearOutTuition = $currentSchool->getTuitionForYear("out", $year);
                $differenceInTuition = $thisYearOutTuition - $thisYearInTuition;
                $tuitionDifferenceArray[$key] = $differenceInTuition;
            }
            arsort($tuitionDifferenceArray);
            $i = 0;
            $top10 = array();
            foreach($tuitionDifferenceArray as $key => $currentDifference) {
                if ($i == $numToShow) {
                    break;
                }
                $top10[$key] = $currentDifference;
                $i++;
            }
            $schoolNames = array();
            $shoolCostDifferences = array();
            foreach($top10 as $key => $costDifference) {
                $mySchool = $this->Schools[$key];
                $mySchoolName = $mySchool->getInstitution();
                $schoolNames[] = $mySchoolName;
                $shoolCostDifferences[] = $costDifference;
            }
            $top10ByName = array($schoolNames, $shoolCostDifferences);
            return $top10ByName;
        }
        
        public function greatestChangeInStateTuition($year, $numToShow) {
            $tuitionChangeArray = array();
            foreach($this->Schools as $key => $currentSchool) {
                $thisYearTuition = $currentSchool->getTuitionForYear("in", $year);
                $lastYear = $year - 1;
                $lastYearTuition = $currentSchool->getTuitionForYear("in", $lastYear);
                $changeInTuition = abs($thisYearTuition - $lastYearTuition);
                $tuitionChangeArray[$key] = $changeInTuition;
            }
            arsort($tuitionChangeArray);
            $i = 0;
            $top10 = array();
            foreach($tuitionChangeArray as $key => $currentChange) {
                if ($i == $numToShow) {
                    break;
                }
                $top10[$key] = $currentChange;
                $i++;
            }
            $schoolNames = array();
            $shoolCostChanges = array();
            foreach($top10 as $key => $costChange) {
                $mySchool = $this->Schools[$key];
                $mySchoolName = $mySchool->getInstitution();
                $schoolNames[] = $mySchoolName;
                $shoolCostChanges[] = $costChange;
            }
            $top10ByName = array($schoolNames, $shoolCostChanges);
            return $top10ByName;
        }
        
        public function greatestChangeOutStateTuition($year, $numToShow) {
            $tuitionChangeArray = array();
            foreach($this->Schools as $key => $currentSchool) {
                $thisYearTuition = $currentSchool->getTuitionForYear("out", $year);
                $lastYear = $year - 1;
                $lastYearTuition = $currentSchool->getTuitionForYear("out", $lastYear);
                $changeInTuition = abs($thisYearTuition - $lastYearTuition);
                $tuitionChangeArray[$key] = $changeInTuition;
            }
            arsort($tuitionChangeArray);
            $i = 0;
            $top10 = array();
            foreach($tuitionChangeArray as $key => $currentChange) {
                if ($i == $numToShow) {
                    break;
                }
                $top10[$key] = $currentChange;
                $i++;
            }
            $schoolNames = array();
            $shoolCostChanges = array();
            foreach($top10 as $key => $costChange) {
                $mySchool = $this->Schools[$key];
                $mySchoolName = $mySchool->getInstitution();
                $schoolNames[] = $mySchoolName;
                $shoolCostChanges[] = $costChange;
            }
            $top10ByName = array($schoolNames, $shoolCostChanges);
            return $top10ByName;
        }
        
        public function leastChangeInStateTuition($year, $numToShow) {
            $tuitionChangeArray = array();
            foreach($this->Schools as $key => $currentSchool) {
                $thisYearTuition = $currentSchool->getTuitionForYear("in", $year);
                $lastYear = $year - 1;
                $lastYearTuition = $currentSchool->getTuitionForYear("in", $lastYear);
                $changeInTuition = abs($thisYearTuition - $lastYearTuition);
                $tuitionChangeArray[$key] = $changeInTuition;
            }
            asort($tuitionChangeArray);
            $i = 0;
            $top10 = array();
            foreach($tuitionChangeArray as $key => $currentChange) {
                if ($i == $numToShow) {
                    break;
                }
                $top10[$key] = $currentChange;
                $i++;
            }
            $schoolNames = array();
            $shoolCostChanges = array();
            foreach($top10 as $key => $costChange) {
                $mySchool = $this->Schools[$key];
                $mySchoolName = $mySchool->getInstitution();
                $schoolNames[] = $mySchoolName;
                $shoolCostChanges[] = $costChange;
            }
            $top10ByName = array($schoolNames, $shoolCostChanges);
            return $top10ByName;
        }
        
        public function leastChangeOutStateTuition($year, $numToShow) {
            $tuitionChangeArray = array();
            foreach($this->Schools as $key => $currentSchool) {
                $thisYearTuition = $currentSchool->getTuitionForYear("out", $year);
                $lastYear = $year - 1;
                $lastYearTuition = $currentSchool->getTuitionForYear("out", $lastYear);
                $changeInTuition = abs($thisYearTuition - $lastYearTuition);
                $tuitionChangeArray[$key] = $changeInTuition;
            }
            asort($tuitionChangeArray);
            $i = 0;
            $top10 = array();
            foreach($tuitionChangeArray as $key => $currentChange) {
                if ($i == $numToShow) {
                    break;
                }
                $top10[$key] = $currentChange;
                $i++;
            }
            $schoolNames = array();
            $shoolCostChanges = array();
            foreach($top10 as $key => $costChange) {
                $mySchool = $this->Schools[$key];
                $mySchoolName = $mySchool->getInstitution();
                $schoolNames[] = $mySchoolName;
                $shoolCostChanges[] = $costChange;
            }
            $top10ByName = array($schoolNames, $shoolCostChanges);
            return $top10ByName;
        }

        
    }
    ?>