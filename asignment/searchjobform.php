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
    <form action="searchjobprocess.php" method="Get">
        <p>Job Title:<input type="text" name="title" required></p>
        <p>Position:
            <input type="radio" id="fullTime" name="position" value="Full Time">
            <label for="fullTime">Full Time</label>
            <input type="radio" id="partTime" name="position" value="Part Time">
            <label for="partTime">Part Time</label>
        </p>
        <p>Contract:
            <input type="radio" id="onGoing" name="contract" value="On-going">
            <label for="onGoing">On-going</label>
            <input type="radio" id="fixedTerm" name="contract" value="Fixed term">
            <label for="fixedTerm">Fixed term</label>
        </p>
        <p>Application by:
            <input type="checkbox" id="post" name="app[]" value="Post">
            <label for="post">Post</label>
            <input type="checkbox" id="mail" name="app[]" value="Mail">
            <label for="mail">Mail</label>
        </p>
        <p>Location:
            <input type="radio" id="onSite" name="location" value="On site">
            <label for="onSite">On site</label>
            <input type="radio" id="remote" name="location" value="Remote">
            <label for="remote">Remote</label>  
        </p>
        
        <p><input type="submit" value="Find"></p>
    </form>

</body>
</html>