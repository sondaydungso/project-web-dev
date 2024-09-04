<?php
    $currentDate = new DateTime(); // get the current date
    if (!isset($_GET['title']) || empty($_GET['title'])) {
        echo "<p>Job title search string is required.</p>";
        echo '<p><a href="/index.php">Home</a> | <a href="/searchjob.php">Search Job Vacancy</a></p>';
        exit;
    }
    $title = $_GET['title'];
    $position = isset($_GET["position"]) ? $_GET["position"] : "";
    $contract = isset($_GET["contract"]) ? $_GET["contract"] : "";
    $app = isset($_GET["app"]) ? $_GET["app"] : array();
    $location = isset($_GET["location"]) ? $_GET["location"] : "";
    
    $file = "C:/xampp/htdocs/asignment/data/job/positions.txt";
    if (!file_exists($file)) {
      echo "<p>File $file does not exist. Contact admin to get help</p>";
      echo '<p><a href="/index.php">Home</a> | <a href="/searchjob.php">Search Job Vacancy</a></p>';
      exit;
    } 
    else {
        $handle = fopen($file, 'r');
    }
    if ($handle) {
        $jobVacancies = array(); // array to store the job vacancies
        
        while (($line = fgets($handle)) !== false) {
          $lineData = explode("\t", $line);
          $jobTitle = isset($lineData[1]) ? $lineData[1] : ""; // get the job title from file
          $des = isset($lineData[2]) ? stripslashes($lineData[2]) : ""; // get the job description from file
          $closingDate = isset($lineData[3]) ? date_create_from_format('d/m/y', $lineData[3]) : "";// get the closing date from file
          $jobPosition = isset($lineData[4]) ? $lineData[4] : "";// get the job position from file
          $jobContract = isset($lineData[5]) ? $lineData[5] : "";// get the job contract from file
          $jobApplication = isset($lineData[6]) ? explode(", ", $lineData[6]) : array();// get the job application method from file
          $jobLocation = isset($lineData[7]) ? $lineData[7] : "";// get the job location from file
          if (
            (strpos(strtolower($jobTitle), strtolower(trim($title))) !== false) && // check if the job title contains the search string of job
            (empty($position) || strtolower(trim($jobPosition)) === strtolower($position)) &&
            (empty($contract) || strtolower(trim($jobContract)) === strtolower($contract)) &&
            (empty($app) || array_intersect(array_map('strtolower', $app), array_map('strtolower', $jobApplication))) &&
            (empty($location) || strtolower(trim($jobLocation)) === strtolower($location)) &&
            ($closingDate >= $currentDate) // check if the closing date is after or equal to the current date
          ) {
            // add the job vacancy to the array
            $jobVacancies[] = array(
              'title' => $jobTitle,
              'description' => $des,
              'closingDate' => $closingDate,
              'position' => "$jobContract - $jobPosition",
              'application' => $jobApplication,
              'location' => $jobLocation
            );
          }
        }
        if (empty($jobVacancies)) {
            echo "<p>No up-to-date job vacancy found.</p>";
          } else {
            // sort the job vacancies by closing date in descending order
            usort($jobVacancies, function ($b, $a) {
              if ($a['closingDate'] < $b['closingDate']) {
                return -1;
              } elseif ($a['closingDate'] > $b['closingDate']) {
                return 1;
              } else {
                return 0;
              }
            });

            // iterate over the sorted job vacancies and display the information for the ones that haven't closed
            foreach ($jobVacancies as $job) {
              $jobTitle = $job['title'];
              $description = $job['description'];
              $descriptionList = str_replace("[NEWLINE]", "<br>", $description);
              $closingDate = $job['closingDate'];
              $position = $job['position'];
              $application = implode(", ", $job['application']);
              $location = $job['location'];

              // display the job vacancy information
              echo '<div class="jobvacancy">';
              echo "<p> Job Title: $jobTitle</p>";
              echo "<p>Description:</p>";
              echo "<p>$descriptionList</p>";
              echo "<p>Closing Date: {$closingDate->format('d/m/y')}</p>";
              echo "<p>Position: $position</p>";
              echo "<p>Application by: $application</p>";
              echo "<p>Location: $location</p>";
              echo '</div>';
            }
          }
          fclose($handle); // close the file
        } else {
          echo "Unable to open $file.";
        }
        

?>