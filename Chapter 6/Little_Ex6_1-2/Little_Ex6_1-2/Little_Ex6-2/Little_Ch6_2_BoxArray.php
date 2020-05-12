<!--
   Author: Jonathon Little
   Date: 3/27/2020
   Purpose: Displaying shipping box volumes from an array.
-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 
STRICT//EN" "http://www.w3.org/TR/xhtmll/DTD/xhtmll-strict.dtd">                                         <!-- Declares the DOCTYPE to XHTML 1.0 Strict so different browsers read the file the same way -->
<html xmlns="http://www.w3.org/1999/xhtml">                                                              <!-- Validates and associates the document to the XHTML namespace. Opens the document -->
<head>                                                                                                   <!-- Opens the head portion of the document -->
   <title>Box Array</title>                                                                              <!-- Sets the title of the page to Box Array -->
   <meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>                             <!-- Used so the page displays correctly and assists the browser to know what encoding to use -->
</head>                                                                                                  <!-- Closes the head portion of the document -->
<body>                                                                                                   <!-- Opens the body portion of the document -->
   <?php                                                                                                 /* Utilizes a php script delimiter to open up the script for php */
      $Boxes = array(                                                                                    /* Creates a new multidimensional array under the name of $Boxes */
         "Small Box" => array(                                                                           /* Creates an array inside the $Boxes array under the name of "Small Box" */
            "Length" => 12,                                                                              /* Creates an array variable under the name of "Length" and sets its value to 12 */
            "Width" => 10,                                                                               /* Creates an array variable under the name of "Width" and sets its value to 10 */
            "Depth" => 2.5                                                                               /* Creates an array variable under the name of "Depth" and sets its value to 2.5 */
         ),                                                                                              /* Closes the "Small Box" array */
         "Medium Box" => array(                                                                          /* Creates an array inside the $Boxes array under the name of "Medium Box" */
            "Length" => 30,                                                                              /* Creates an array variable under the name of "Length" and sets its value to 30 */
            "Width" => 20,                                                                               /* Creates an array variable under the name of "Width" and sets its value to 20 */
            "Depth" => 4                                                                                 /* Creates an array variable under the name of "Depth" and sets its value to 4 */
         ),                                                                                              /* Closes the "Medium Box" array */
         "Large Box" => array(                                                                           /* Creates an array inside the $Boxes array under the name of "Large Box" */
            "Length" => 60,                                                                              /* Creates an array variable under the name of "Length" and sets its value to 60 */
            "Width" => 40,                                                                               /* Creates an array variable under the name of "Width" and sets its value to 40 */
            "Depth" => 11.5                                                                              /* Creates an array variable under the name of "Depth" and sets its value to 11.5 */
         )                                                                                               /* Closes the "Large Box" array */
      );                                                                                                 /* Closes the $Boxes array */
	  echo "<table>";                                                                                    /* Opens a table to be displayed on the web page */

	  echo "<tr><b><u>Volume of Box Sizes</u></b></tr><br/>";                                            /* Outputs the top row of the table to display the title of the table bold and underlined */

      echo "<tr><b>Small Box: </b>".number_format($Boxes['Small Box']['Length']
            *$Boxes['Small Box']['Width']*$Boxes['Small Box']['Depth'])."</tr><br/>";                    /* Outputs the Small Box Volume on the table row */

      echo "<tr><b>Medium Box: </b>".number_format($Boxes['Medium Box']['Length']
            *$Boxes['Medium Box']['Width']*$Boxes['Medium Box']['Depth'])."</tr><br/>";                  /* Outputs the Medium Box Volume on the table row */

      echo "<tr><b>Large Box: </b>".number_format($Boxes['Large Box']['Length']
            *$Boxes['Large Box']['Width']*$Boxes['Large Box']['Depth'])."</tr><br/>";                    /* Outputs the Large Box Volume on the table row */

      echo "</table>";                                                                                   /* Closes the table */
   ?>                                                                                                    <!-- Uses a closing php script delimiter to close the php script -->
</body>                                                                                                  <!-- Closes the body portion of the document -->
</html>                                                                                                  <!-- Closes the document -->