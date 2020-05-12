<!--
   Author: Jonathon Little
   Date: 4/26/2020
   Purpose: Sets a web page for an electronics store. In which case the user can order some electronics.
-->
<?php                                                                                             /* Utilizes a php script delimiter to open a php script */
session_start();                                                                                  /* Starts a session */
require_once("Little_Ch10_class_OnlineStore.php");                                                /* Requires the connection to the php document that stores the class object for the online store */
$storeID = "ELECBOUT";                                                                            /* Sets the variable for $StoreID to ELECBOUT */
$storeInfo = array();                                                                             /* Sets the variable for $storeInfo to an array */
if (class_exists("OnlineStore")) {                                                                /* Checks to make sure the class object exists */
   if (isset($_SESSION['currentStore'])) {                                                        /* Checks to see if a current store session exists */
      $Store = unserialize($_SESSION['currentStore']);                                            /* If it already exists then unserializes the connection and opens up the session */
   } else {                                                                                       /* Routes to the else statement if a session did not exist */
      $Store = new OnlineStore();                                                                 /* Starts a new OnlineStore class object */
   }                                                                                              /* Closes the else statement */
   $Store->setStoreID($storeID);                                                                  /* Calls the setStoreID function */
   $storeInfo = $Store->getStoreInformation();                                                    /* Sets the $storeInfo variable to the information returned from the getStoreInformation function */
   $Store->processUserInput();                                                                    /* Calls the processUserInput function */
} else {                                                                                          /* Routes to the else if the class object does not exist */
   $ErrorMsgs[] = "The OnlineStore class is not available!";                                      /* Adds a string message to the $ErrorMsgs array */
   $Store = NULL;                                                                                 /* Sets the $Store variable to NULL */
}                                                                                                 /* Closes the else statement */
?>                                                                                                <!-- Utilizes a php script delimiter to close the php script -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 
STRICT//EN" "http://www.w3.org/TR/xhtmll/DTD/xhtmll-strict.dtd">                                  <!-- Declares the DOCTYPE to XHTML 1.0 Strict so different browsers read the file the same way -->
<html xmlns="http://www.w3.org/1999/xhtml">                                                       <!-- Validates and associates the document to the XHTML namespace. Opens the document -->
<head>                                                                                            <!-- Opens the head portion of the document -->
   <title><?php echo $storeInfo['name']; ?></title>                                               <!-- Sets the title of the page to the store name -->
   <link rel="stylesheet" type="text/css" href="<?php echo $storeInfo['css_file']; ?>"/>          <!-- Links the store stylesheet to the web page to add some design to the page -->
   <meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>                      <!-- Used so the page displays correctly and assists the browser to know what encoding to use -->
</head>                                                                                           <!-- Closes the head portion of the document -->
<body>                                                                                            <!-- Opens the body portion of the document -->
   <h1><?php echo htmlentities($storeInfo['name']); ?></h1>                                       <!-- Displays the store name in h1 size on the page as a header -->
   <h2><?php echo htmlentities($storeInfo['description']); ?></h2>                                <!-- Displays the store description in h2 size on the page as a header -->
   <p><?php echo htmlentities($storeInfo['welcome']); ?></p>                                      <!-- Displays the welcome message for the user on the page -->
   <?php                                                                                          /* Utilizes a php script delimiter to open a php script */
   $Store->getProductList();                                                                      /* Calls the product list function to list all the products for the store */
   $_SESSION['currentStore'] = serialize($Store);                                                 /* Serializes the connection in the current session */
   ?>                                                                                             <!-- Utilizes a php script delimiter to close the php script -->
</body>                                                                                           <!-- Closes the body portion of the document -->
</html>                                                                                           <!-- Closes the file -->