<?php
    $dir = "C:/xampp/htdocs/asignment/data/job";
    $file = "$dir/positions.txt";
    if (!file_exists($dir)) {
        mkdir($dir, 02770, true);
      }
      
    //validate function used by other functions later
    function validateField($fieldName, $fieldValue, $pattern, $errorMessage)
      {
        if (empty($fieldValue)) {
          echo "<p>Please enter a $fieldName.</p>";
        } else if (!preg_match($pattern, $fieldValue)) {
          echo "<p>$errorMessage</p>";
        } else {
          return $fieldValue;
        }
        return null;
      }

      // Check if the Position ID is unique
      function isPosIdUnique($posId, $file)
      {
        if (file_exists($file)) {
          $handle = fopen($file, 'r');
          if ($handle) {
            while (($line = fgets($handle)) == true) {
              $lineData = explode("\t", $line);
              if (isset($lineData[0]) && trim($lineData[0]) === $posId) {
                fclose($handle);
                return false; // Position ID already exists
              }
            }
            fclose($handle);
          } else {
            echo "Unable to open $file.";
          }
        }
        return true; // Position ID is unique
      }
      
      function validateDescription($str)
      {
        if (empty($str)) {
          echo "<p>Please enter a description.</p>";
        } 
        else if (strlen($str) > 250) {
          echo "<p>Please enter a maximum of 250 characters in the description.</p>";
        } 
        else {
          return str_replace(["\r\n", "\r", "\n"], "{AnotherLine}", $str);
        }
        return null;
      }
      
      // Error messages 
      function error($fieldName)
      {
        echo "<p>Please select a $fieldName.</p>";
      }

      // Validate the application method field
      function validateApplicationMethod($fieldName, $fieldValue)
      {
        if (empty($fieldValue)) {
          echo "<p>Please select a $fieldName(s) to send accepted application.</p>";
        } else {
          return implode(", ", $fieldValue);
        }
        return null;
      }

      // Validate the location field
      function validateLocation($fieldName, $fieldValue)
      {
        if (empty($fieldValue)) {
          echo "<p>Please enter a $fieldName.</p>";
        } else {
          return $fieldValue;
        }
        return null;
      }

      // Process the form submission
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $posId = validateField('position ID', $_POST['posId'], '/^ID\d{3}$/', 'Please enter a unique 5-character code that starts with "ID" and is followed by 3 digits, e.g., ID123.');
        $title = validateField('title', $_POST['title'], '/^[a-zA-Z0-9 ,.!]{1,10}$/', 'Please enter a maximum of 10 characters (comma, period, and exclamation point are allowed).');
        $des = validateDescription($_POST["des"]);
        $des = $des ? addslashes($des) : "";
        $date = validateField('closing date', $_POST['date'], '/^(0[1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/\d{2}$/', 'Please enter a date in "dd/mm/yy" format.');
        $position = isset($_POST['position']) ? $_POST['position'] : error("full-time or part-time postion");
        $contract = isset($_POST['contract']) ? $_POST['contract'] : error("fixed-term or on-going contract");
        $app = validateApplicationMethod('method', isset($_POST['app']) ? $_POST['app'] : array());
        $location = validateLocation('location', isset($_POST['location']) ? $_POST['location'] : '');

        if ($posId && $title && $des && $date && $position && $contract && $app && $location) {
          if (!isPosIdUnique($posId, $file)) {
            echo '<p>The position ID already exists. Please enter a unique ID.</p>';
          } else {
            $record = "$posId\t$title\t$des\t$date\t$position\t$contract\t$app\t$location\n";
            $handle = fopen($file, 'a');
            if ($handle) {
              fwrite($handle, $record);
              fclose($handle);
              echo "<p id='success'>The job vacancy has been posted successfully.</p>";
            } else {
              echo "Unable to open $file.";
            }
          }
        }
      } else {
        echo "<p>Please fill out the form to post a job vacancy.</p>";
      }
      ?>
