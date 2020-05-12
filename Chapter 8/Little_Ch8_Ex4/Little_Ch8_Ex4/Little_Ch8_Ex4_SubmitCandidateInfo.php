<!--
   Author: Jonathon Little
   Date: 4/22/2020
   Purpose: Gets the data from the form and processes it to put the interview evaluation data into the database.
-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 
STRICT//EN" "http://www.w3.org/TR/xhtmll/DTD/xhtmll-strict.dtd">                                       <!-- Declares the DOCTYPE to XHTML 1.0 Strict so different browsers read the file the same way -->
<html xmlns="http://www.w3.org/1999/xhtml">                                                            <!-- Validates and associates the document to the XHTML namespace. Opens the document -->
<head>                                                                                                 <!-- Opens the head portion of the document -->
   <title>Submitted Interview Information</title>                                                      <!-- Sets the title of the page to Submitted Interview Information -->
   <meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>                           <!-- Used so the page displays correctly and assists the browser to know what encoding to use -->
</head>                                                                                                <!-- Closes the head portion of the document -->
<body>                                                                                                 <!-- Opens the body portion of the document -->
   <?php                                                                                               /* Utilizes a php script delimiter to open up the script for php */
   $DBConnect = @mysqli_connect("localhost", "root", "");                                              /* Connects to the database */
   if ($DBConnect === FALSE) {                                                                         /* Checks to see if the connection to the database server failed */
      echo "<p>Unable to connect to the database server.</p>" . "<p>Error code " .
      mysqli_errno() . ": " . mysqli_error() . "</p>";                                                 /* If the database server failed to connect, then outputs an error message to the user that tells the user it failed to connect to the database server */
   } else {                                                                                            /* Routes to the else statement if the database connection was successful */
      $DBName = "candidates";                                                                          /* Sets a variable that holds the name of the database and sets it to "candidates" */
      if (!@mysqli_select_db($DBConnect, $DBName)) {                                                   /* Checks to see if the database does not exist */
         $SQLstring = "CREATE DATABASE $DBName";                                                       /* If the database does not exist, then it sets a variable that will hold the query statement to create the database */
         $QueryResult = @mysqli_query($DBConnect, $SQLstring);                                         /* Commands a query statement to process by connecting to the database server and sending it the query that is held in the variable */
         if ($QueryResult === FALSE) {                                                                 /* Checks to see if the query failed */
            echo "<p>Unable to execute the query.</p>" . "<p>Error code " .
            mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . "</p>";                       /* If the query failed, then it sends an output message to the user that tells the user the query failed */
         } else {                                                                                      /* If the query was successful, then it routes to the else statement */
            echo "<p>You have submitted the first evaluation!</p>";                                    /* Outputs a message to the user that alerts the user that they have submitted the first evaluation as the database has been created */
         }                                                                                             /* Closes the else statement */
      }                                                                                                /* Closes the if statement on line 21 */
      mysqli_select_db($DBConnect, $DBName);                                                           /* Selects the database */
      $TableName = "interviewinfo";                                                                    /* Creates a variable that holds the name of the table which is "interviewinfo" */
      $SQLstring = "SHOW TABLES LIKE '$TableName'";                                                    /* Creates a variable that holds the statement for the query to be executed */
      $QueryResult = @mysqli_query($DBConnect, $SQLstring);                                            /* Checks database for the table by using the query */
      if (mysqli_num_rows($QueryResult) == 0) {                                                        /* Checks to see if any rows are returned from the query */
         $SQLstring = "CREATE TABLE $TableName(countID SMALLINT
         NOT NULL AUTO_INCREMENT PRIMARY KEY, interviewer_name VARCHAR(40),
         position VARCHAR(40), interview_date DATE, candidate_name VARCHAR(40),
         comm_ability VARCHAR(100), appearance VARCHAR(3), comp_skill VARCHAR(100),
         bus_knowledge VARCHAR(100), comments VARCHAR(100))";                                          /* If no table data is returned, then it sets a query statement to execute to a variable */
         $QueryResult = @mysqli_query($DBConnect, $SQLstring);                                         /* Attempts to execute the query */
         if ($QueryResult === FALSE) {                                                                 /* Checks to see if the query failed to execute */
            echo "<p>Unable to create the table.</p>" . "<p>Error code " . 
            mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . "</p>";                       /* Outputs an error message to the user that says that there was an error creating the table */
         }                                                                                             /* Closes the if statement */
      }                                                                                                /* Closes the if statement on line 35 */
      $InterviewerName = stripslashes($_POST['interviewer_name']);                                     /* Sets a variable to hold the value for the interviewer's name */
      $Position = stripslashes($_POST['position']);                                                    /* Sets a variable to hold the value for the work position*/
      $InterviewDate = $_POST['interview_date'];                                                       /* Sets a variable to hold the value for the interview date */
      $CandidateName = stripslashes($_POST['candidate_name']);                                         /* Sets a variable to hold the value for the candidate's name */
      $Communication = stripslashes($_POST['comm_ability']);                                           /* Sets a variable to hold the value for the communication ability */
      $Appearance = stripslashes($_POST['appearance']);                                                /* Sets a variable to hold the value for the appearance */
      $ComputerSkill = stripslashes($_POST['comp_skill']);                                             /* Sets a variable to hold the value for the computer skill */
      $BusinessKnowledge = stripslashes($_POST['bus_knowledge']);                                      /* Sets a variable to hold the value for the business knowledge */
      $Comments = stripslashes($_POST['comments']);                                                    /* Sets a variable to hold the value for the comments */
	  $SQLstring = "INSERT INTO $TableName VALUES(NULL, '$InterviewerName', '$Position',
      '$InterviewDate', '$CandidateName', '$Communication', '$Appearance', '$ComputerSkill',
      '$BusinessKnowledge', '$Comments')";                                                             /* Creates a query string to insert the values into the interviewinfo table */
      $QueryResult = @mysqli_query($DBConnect, $SQLstring);                                            /* Attempts to execute the query */
      if ($QueryResult === FALSE) {                                                                    /* Checks to see if the query failed */
         echo "<p>Unable to execute the query.</p>" . "<p>Error code " .
         mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . "</p>";                          /* Outputs an error message that says the query failed to execute */
      } else {                                                                                         /* Routes to the else statement if the query was successful */
         echo "<h1>Thank you for your evaluation!</h1>";                                               /* Outputs a message that says thank you for your evaluation */
      }                                                                                                /* Closes the else */
   }                                                                                                   /* Closes the else on line 19 */
   mysqli_close($DBConnect);                                                                           /* Closes the connection to the database */
   ?>                                                                                                  <!-- Uses a closing php script delimiter to close the php script -->                                                                                            <!-- Closes the form -->
</body>                                                                                                <!-- Closes the body portion of the document -->
</html>                                                                                                <!-- Closes the file -->