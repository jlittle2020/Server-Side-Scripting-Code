<!--
   Debugged By: Jonathon Little
   Date: 2/11/2020
   Purpose: To create a zodiac table with the dates, names, and images of each zodiac displayed.
-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
   <title>Chinese Zodiac for loop</title>
   <link rel="stylesheet" type="text/css" href="ChineseZodiac.css" /> 
   <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
</head>
<body>
   <h1>Chinese Zodiac for loop</h1>
   <?php
/*      $SignNames = array(                                            This is causing a syntax error because of the placement within the code.
            "Rat",                                                     It's also created within the global part of the code and should instead
            "Ox",                                                      be called within the function. So to apply a fix to this error --
            "Tiger",                                                   I have placed it within the DisplayTableForZodiac() function. This therefore 
            "Rabbit",                                                  allows the call towards $SignNames to be noticed as an array and not have it
            "Dragon",                                                  set to NULL. This was discovered by running the code through the debugger
            "Snake",                                                   and realizing it was showing an error for $SignNames not being defined.
            "Horse",                                                   Where soon after I tested it by commenting out this code portion,
            "Goat",                                                    copying, and then pasting it within the function which resulted in success.
            "Monkey",
            "Rooster",
            "Dog",
            "Pig");
*/   
   //DisplayTableForZodiac();                                          Although this does not cause an error. It is better practice to call the function after declaring and defining what they do. This has been placed at that appropriate spot within the program.
   
   function DisplayTableForZodiac()
   {
      $SignNames = array (
         "Rat",
         "Ox",
         "Tiger",
         "Rabbit",
         "Dragon",
         "Snake",
         "Horse",
         "Goat",
         "Monkey",
         "Rooster",
         "Dog",
         "Pig");
      echo "<table>";                                                                                          //Usage of the \n isn't necessary even though it does not cause any errors. The \n was removed for a cleaner code appearance. This was discovered by removing it and then running the program.
      echo "<tr>";                                                                                             //Usage of the \n isn't necessary even though it does not cause any errors. The \n was removed for a cleaner code appearance. This was discovered by removing it and then running the program.

      for ($i=0; $i <= 11; ++$i)                                                                               //Modified the for loop to be "i <= 11" because the array sets the strings to values starting from zero. If kept the way it was, it would result in a syntax error. This was discovered by running the code through the debugger.
      {
         echo "<th>".$SignNames[$i]."<br/>\n";                                                                 //Deleted the spaces for a more organized appearance.
         echo "<img src='".$SignNames[$i].".gif'alt='".$SignNames[$i]."'title='".$SignNames[$i]."'/></th>\n";  //Usage of the \n isn't necessary even though it does not cause any errors. The \n was removed for a cleaner code appearance. This was discovered by removing it and then running the program.
      }
      echo "</tr>";                                                                                            //Usage of the \n isn't necessary even though it does not cause any errors. The \n was removed for cleaner code appearance. This was discovered by removing it and then running the program.
      //echo "</table>\n";                                                                                     The table should not be closed here as this will cause a logical error. This was discovered by commenting it out and then placing it at the end of the DisplayYears() function to close the table there.
   }
   
   function DisplayYears()
   {
      //Start with year 1912, and end with the current year.
      for ($i=1912; $i <= 2009; ++$i)                                                                        //Changed the year from 2014 to 2009 for the for loop to end so it can produce the expected output called by specifications. Also removed the semicolon as it would cause a syntax error. This was discovered by running the code through the debugger.
      {
         //On every 12th year we loop through, end the table row and start a new table row.
         if (( ($i-1912) % 12) == 0) 
         {                                                                                                    //Failed to apply the brackets when creating the if statement. This can cause a syntax error and was fixed by applying the opening bracket. It was found by running the code through the debugger.
            echo "</tr>";                                                                                     //Usage of the \n isn't necessary even though it does not cause any errors. The \n was removed for a cleaner code appearance. This was discovered by removing it and then running the program.
            echo "<tr>";                                                                                      //Usage of the \n isn't necessary even though it does not cause any errors. The \n was removed for a cleaner code appearance. This was discovered by removing it and then running the program.
         }                                                                                                    //Failed to apply the brackets when creating the if statement. This can cause a syntax error and was fixed by applying the closing bracket. It was found by running the code through the debugger.
         echo "<td style='text-align: center;'>$i</td>";                                                      //Centered the text although it was not needed. This is because it provides a cleaner and organized output.
      }
   echo "</table>";
   }
   DisplayTableForZodiac();
   DisplayYears();                                                                                            //Failed to call the DisplayYears() function which doesn't throw an error when not called but does not produce the expected output. To fix this, it has been called to display to the user onscreen.
   ?>
</body>
</html>

