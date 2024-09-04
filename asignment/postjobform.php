<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Asignment1</title>
  <link rel="stylesheet" type="text/css" href="style/style.css">
</head>

<body>
  <h1 class="header">Job Vacancy Posting System</h1>
    <nav class = "navigator">
    
      <a class = "navigatorlist" href="postjobform.php">Post Job Page</a>
      <a class = "navigatorlist" href="searchjobform.php">Search Job Vacancy Page</a>
      <a class = "navigatorlist" href="about.php">About Page</a>
      <a class = "navigatorlist" href="index.php">Home</a>
    
    </nav>
    <form action="postjobprocess.php" method="POST">
        <p>Position ID: <input type="text" name="posId" required pattern="ID\d{3}" title="Please enter a unique 5-character code that starts with 'ID' and is followed by 3 digits, e.g., ID123."></p>
        <p>Title: <input type="text" name="title" required pattern="^[a-zA-Z0-9 ,.!]{1,10}$" title="Please enter a maximum of 10 characters (alphanumeric, space, comma, period, and exclamation point are allowed)."></p>
        <p>Description: <textarea name="des" required maxlength="250" title="Please enter a maximum of 250 characters."></textarea></p>
        <p>Closing Date: <input type="text" name="date" required pattern="^(0[1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/\d{2}$" title="Please enter a date in 'dd/mm/yy' format." value="<?php echo date('d/m/y'); ?>"></p>
        <p>Position:
          <input type="radio" name="position" value="Full Time" required> Full Time
          <input type="radio" name="position" value="Part Time" required> Part Time
        </p>
        <p>Contract:
          <input type="radio" name="contract" value="On-going" required> On-going
          <input type="radio" name="contract" value="Fixed term" required> Fixed term
        </p>
        <p>Location:
          <input type="radio" name="location" value="On site" required> On site
          <input type="radio" name="location" value="Remote" required> Remote
        </p>
        <p>Accept Application by:
          <input type="checkbox" name="app[]" value="Post"> Post
          <input type="checkbox" name="app[]" value="Email"> Email
        </p>
    <p><input type="submit" value="Post Job"></p>
    </form>

</body>
</html>