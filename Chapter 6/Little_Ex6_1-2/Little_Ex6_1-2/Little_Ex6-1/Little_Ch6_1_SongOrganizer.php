<!--
   Author: Jonathon Little
   Date: 3/27/2020
   Purpose: Gets a song from the user and stores it in a song list contained within a text file.
-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 
STRICT//EN" "http://www.w3.org/TR/xhtmll/DTD/xhtmll-strict.dtd">                                             <!-- Declares the DOCTYPE to XHTML 1.0 Strict so different browsers read the file the same way -->
<html xmlns="http://www.w3.org/1999/xhtml">                                                                  <!-- Validates and associates the document to the XHTML namespace. Opens the document -->
<head>                                                                                                       <!-- Opens the head portion of the document -->
   <title>Song Organizer</title>                                                                             <!-- Sets the title of the page to Song Organizer -->
   <meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>                                 <!-- Used so the page displays correctly and assists the browser to know what encoding to use -->
</head>                                                                                                      <!-- Closes the head portion of the document -->
<body>                                                                                                       <!-- Opens the body portion of the document -->
   <h1>Song Organizer</h1>                                                                                   <!-- Sets a header for the web page and sets it to Song Organizer -->
   <?php                                                                                                     /* Utilizes a php script delimiter to open up the script for php */
      if (isset($_GET['action'])) {                                                                          /* Sets an if that determines if an action was set and gets the action specified */
         if ((file_exists("SongOrganizer/songs.txt"))                                                        /* Sets an if that checks to see if the songs.txt file exists */
            && (filesize("SongOrganizer/songs.txt") != 0)) {                                                 /* Checks the file size of the songs.txt file */
            $SongArray = file("SongOrganizer/songs.txt");                                                    /* Sets the variable $SongArray to the songs.txt file */
            switch ($_GET['action']) {                                                                       /* Gets the action that was performed from the form */
               case 'Remove Duplicates':                                                                     /* Sets a case statement for if the user selected to Remove Duplicates from the song list */
                     $SongArray = array_unique($SongArray);                                                  /* Used to remove duplicate values from an array */
                     $SongArray = array_values($SongArray);                                                  /* Assigns the values received to an array with numeric values */
                  break;                                                                                     /* Breaks from the Remove Duplicates case */
               case 'Sort Ascending':                                                                        /* Sets a case statement for if the user selected to Sort the song list in Ascending order */
                     sort($SongArray);                                                                       /* Takes the values assigned in the array and sorts them */
                  break;                                                                                     /* Breaks from the Sort Ascending case */
               case 'Shuffle':                                                                               /* Sets a case statement for if the user selected to Shuffle the song list */
                     shuffle($SongArray);                                                                    /* Takes the values assigned in the array and shuffles them */
                  break;                                                                                     /* Breaks from the Shuffle case */
            }                                                                                                /* Closes the Switch statement */
            if (count($SongArray) > 0) {                                                                     /* Sets an if statement that counts the values in $SongArray and checks to see if the value is greater than 0 */
               $NewSongs = implode($SongArray);                                                              /* Sets the variable $NewSongs to be the new value that was from the joining elements of an array that were in string format */
               $SongStore = fopen("SongOrganizer/songs.txt", "wb");                                          /* Sets a resource for the songs.txt file that is opened */
               if ($SongStore === false) {                                                                   /* Sets an if statement to check to see if the songs.txt file failed to open or assign itself to the resource */
                  echo "There was an error updating the song file\n";                                        /* Outputs an error message to the user that tells the user that there was a problem updating the song file */
               } else {                                                                                      /* Sets an else statement in the case that the resource succeeds in acquiring the songs.txt file */
                  fwrite($SongStore, $NewSongs);                                                             /* Writes to the resource which is the opened songs.txt file */
                  fclose($SongStore);                                                                        /* Closes the songs.txt file */
               }                                                                                             /* Closes the else statement */
            } else {                                                                                         /* Sets an else statement */
               unlink("SongOrganizer/songs.txt");                                                            /* Deletes the songs.txt file */
            }                                                                                                /* Closes the else statement */
         }                                                                                                   /* Closes the if statement on line 17 */
      }                                                                                                      /* Closes the if statement on line 16 */
      if (isset($_POST['submit'])) {                                                                         /* Sets an if to check the form after the submit button has been pressed and action has been taken */
         $SongToAdd = stripslashes($_POST['SongName'])."\n";                                                 /* Removes an slashes from the entered Song Name and assigns it to $SongToAdd */
         $ExistingSongs = array();                                                                           /* Sets the variable $ExistingSongs to a new array */
         if (file_exists("SongOrganizer/songs.txt")
            && filesize("SongOrganizer/songs.txt") > 0) {                                                    /* Sets an if statement that checks to see if the songs.txt file exists and the size of the file */
            $ExistingSongs = file("SongOrganizer/songs.txt");                                                /* Sets the resource of $ExistingSongs to the songs.txt file */
         }                                                                                                   /* Closes the if statement */
         if (in_array($SongToAdd, $ExistingSongs)) {                                                         /* Sets an if statement that checks whether any values exist in the array or not */
            echo "<p>The song you entered already exists!<br/>\n";                                           /* Outputs a message to the user that tells the user that the song they tried to enter already exists */
            echo "Your song was not added to the list.</p>";                                                 /* Outputs a message to the user that tells the user that their song was not added to the list */
         } else {                                                                                            /* Routes to the else statement if the song can be added to the list */
            $SongFile = fopen("SongOrganizer/songs.txt", "ab");                                              /* Opens the songs.txt file and assigns it to the resource of $SongFile */
            if ($SongFile === false) {                                                                       /* Sets an if statement to check to see if the resource successfully opened the songs.txt file */
               echo "There was an error saving your message!\n";                                             /* Outputs an error message to the user that tells the user there was an error saving their message to the file */
            } else {                                                                                         /* Sets an else if the resource was successful in opening the songs.txt file */
               fwrite($SongFile, $SongToAdd);                                                                /* Writes or adds data to the songs.txt file */
               fclose($SongFile);                                                                            /* Closes the songs.txt file */
               echo "Your song has been added to the list.\n";                                               /* Outputs a message to the user that tells the user their song has been added to the list */
            }                                                                                                /* Closes the else statement on line 60 */
         }                                                                                                   /* Closes the else statement on line 56 */
      }                                                                                                      /* Closes the if statement on line 46 */
	  if ((!file_exists("SongOrganizer/songs.txt"))
         || (filesize("SongOrganizer/songs.txt") == 0)) {                                                    /* Sets an if statement that checks to see if the file exists as well as the size of the file */
         echo "<p>There are no songs in the list.</p>\n";                                                    /* Outputs a message to the user that tells the user there are no songs in the list */
      } else {                                                                                               /* Routes to the else if there are songs in the list */
         $SongArray = file("SongOrganizer/songs.txt");                                                       /* Sets the variable $SongArray to the songs.txt file */
         echo "<table border=\"1\" width=\"100%\" style=\"background-color:lightgray\">\n";                  /* Sets a table border and colors the table in a lightgray color */
         foreach ($SongArray as $Song) {                                                                     /* Sets a foreach loop to display each value that was written in the songs.txt file */
            echo "<tr>\n";                                                                                   /* Opens the table row */
            echo "<td>".htmlentities($Song)."</td>";                                                         /* Outputs the data to the table on the web page */
            echo "</tr>\n";                                                                                  /* Closes the table row */
         }                                                                                                   /* Closes the foreach loop */
         echo "</table>\n";                                                                                  /* Closes the table */
      }                                                                                                      /* Closes the else statement */
   ?>                                                                                                        <!-- Uses a closing php script delimiter to close the php script -->
   <p>                                                                                                       <!-- Opens a paragraph on the web page to display the links for the user to make modifications to the song list -->
      <a href="Little_Ch6_1_SongOrganizer.php?action=Sort%20Ascending">Sort Song List</a><br/>               <!-- Sets a link for the option to have the song list sorted -->
      <a href="Little_Ch6_1_SongOrganizer.php?action=Remove%20Duplicates">Remove Duplicate Songs</a><br/>    <!-- Sets a link for the option to have the song list remove any duplicate songs -->
      <a href="Little_Ch6_1_SongOrganizer.php?action=Shuffle">Randomize Song List</a><br/>                   <!-- Sets a link for the option to have the song list randomized -->
   </p>                                                                                                      <!-- Closes the paragraph section on the web page -->
   <form action="Little_Ch6_1_SongOrganizer.php" method="post">                                              <!-- Opens and creates a form for the user to be able to enter a new song if desired -->
      <p>Add a New Song</p>                                                                                  <!-- Outputs a heading to the user that asks them to Add a New Song -->
      <p>Song Name: <input type="text" name="SongName"/></p>                                                 <!-- Sets an input for the user to be able to enter the song they wish to add -->
	  <p><input type="submit" name="submit" value="Add Song to List"/>                                       <!-- Sets a submit button so the user can submit the song they desired to enter -->
      <input type="reset" name="reset" value="Reset Song Name"/></p>                                         <!-- Sets a reset button to clear the entry in the input field if the user changes their mind about adding the song they chose -->
   </form>                                                                                                   <!-- Closes the form -->
</body>                                                                                                      <!-- Closes the body portion of the document -->
</html>                                                                                                      <!-- Closes the document -->