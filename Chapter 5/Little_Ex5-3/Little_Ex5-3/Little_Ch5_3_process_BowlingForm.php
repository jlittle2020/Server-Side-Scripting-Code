<!--
   Author: Jonathon Little
   Date: 3/19/2020
   Purpose: Takes the information given from the bowling form and inputs it into a text file that updates from each entry.
-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 
STRICT//EN" "http://www.w3.org/TR/xhtmll/DTD/xhtmll-strict.dtd">                                         <!-- Declares the DOCTYPE to XHTML 1.0 Strict so different browsers read the file the same way -->
<html xmlns="http://www.w3.org/1999/xhtml">                                                              <!-- Validates and associates the document to the XHTML namespace. Opens the document -->
<head>                                                                                                   <!-- Opens the head portion of the document -->
   <title>Bowling Form</title>                                                                           <!-- Sets the title of the page to Bowling Form -->
   <meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>                             <!-- Used so the page displays correctly and assists the browser to know what encoding to use -->
</head>                                                                                                  <!-- Closes the head portion of the document -->
<body>                                                                                                   <!-- Opens the body portion of the document -->
   <?php                                                                                                 /* Utilizes a php script delimiter to open up the script for php */
      $BowlerFile = "bowlerinfo.txt";                                                                    /* Initializes the variable that the name of the text file will go into */
      $Name = $_POST['Name'];                                                                            /* Initializes the variable for Name that will get the bowler's name value */
      $Age = $_POST['Age'];                                                                              /* Initializes the variable for Age that will get the bowler's age value */
      $Average = $_POST['Average'];                                                                      /* Initializes the variable for Average that will get the bowler's bowling average value */
      $NewInformation = "$Name, $Age, $Average"."\n";                                                    /* Initializes the variable that will get the bowler's complete information in a string format */

      if (file_exists($BowlerFile)) {                                                                    /* Sets an if statement to check if the bowlerinfo.txt file exists */
         $BowlerFile = fopen("bowlerinfo.txt", "a+");                                                    /* If the bowlerinfo.txt file exists then opens the file and places the pointer at the end of the line with read and write capabilities */
         fwrite($BowlerFile, $NewInformation);                                                           /* Writes to the bowlerinfo.txt file by adding the new bowler information for the new bowler that submitted the form */
		 fclose($BowlerFile);                                                                            /* Closes the bowlerinfo.txt file */
		 $Updated = TRUE;                                                                                /* Creates and sets a flag for $Updated to TRUE for the updates added to the file */
      } else {                                                                                           /* Routes to the else statement if the file does not exist */
         file_put_contents($BowlerFile, $NewInformation);                                                /* If the file was not created, creates the bowlerinfo.txt file and adds the new bowler's information to it */
		 $Updated = TRUE;                                                                                /* Creates and sets a flag for $Updated to TRUE for the updates added to the file */
      }                                                                                                  /* Closes the else statement */

      if ($Updated == TRUE) {                                                                            /* Sets an if statement to check if $Updated is set to TRUE */
         echo "<p>The Bowler Sign-Up file has been updated with the new Bowler information.</p>";        /* If $Updated is set to true, outputs a message to the user that says the file has been updated */
      }                                                                                                  /* Closes the if statement */
   ?>                                                                                                    <!-- Uses a closing php script delimiter to close the php script -->
</body>                                                                                                  <!-- Closes the body portion of the document -->
</html>                                                                                                  <!-- Closes the document -->