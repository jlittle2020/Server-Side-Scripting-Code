<!--
   Author: Jonathon Little
   Date: 4/26/2020
   Purpose: Sets a class object for the online store and applies fields, methods, and functions to the object.
-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 
STRICT//EN" "http://www.w3.org/TR/xhtmll/DTD/xhtmll-strict.dtd">                                            <!-- Declares the DOCTYPE to XHTML 1.0 Strict so different browsers read the file the same way -->
<html xmlns="http://www.w3.org/1999/xhtml">                                                                 <!-- Validates and associates the document to the XHTML namespace. Opens the document -->
<head>                                                                                                      <!-- Opens the head portion of the document -->
   <meta http-equiv="content-type" content="text/html; charset=iso-8859-1"/>                                <!-- Used so the page displays correctly and assists the browser to know what encoding to use -->
</head>                                                                                                     <!-- Closes the head portion of the document -->
<body>                                                                                                      <!-- Opens the body portion of the document -->
   <?php                                                                                                    /* Utilizes a php script delimiter to open a php script */
   class OnlineStore {                                                                                      /* Opens a new class object for the online store */
      private $DBConnect = NULL;                                                                            /* Initializes a private field $DBConnect and sets it to NULL */
      private $storeID = "";                                                                                /* Initializes a private field $storeID and sets it to an empty string */
      private $inventory = array();                                                                         /* Initializes a private field $inventory and sets it as an array */
      private $shoppingCart = array();                                                                      /* Initializes a private field $shoppingCart and sets it as an array */
      function __construct() {                                                                              /* Opens a new function by the name of __construct */
         include("Little_Ch10_inc_OnlineStoreDB.php");                                                      /* Includes the inc_OnlineStoreDB php document */
         $this->DBConnect = $DBConnect;                                                                     /* Sets the current $DBConnect to the $DBConnect returned from the inc_OnlineStoreDB php document */
      }                                                                                                     /* Closes the __construct function */
      function __destruct() {                                                                               /* Opens a new function by the name of __destruct */
         if ($this->DBConnect->connect_error) {                                                             /* Checks to see if there was a database server connection error */
            $this->DBConnect->close();                                                                      /* If there was a connection error, then close the connection */
         }                                                                                                  /* Closes the if statement */
      }                                                                                                     /* Closes the __destruct function */
      public function setStoreID($storeID) {                                                                /* Opens a public function by the name of setStoreID and passes it the $storeID */
         if ($this->storeID != $storeID) {                                                                  /* Checks to see if the current session store id matches the passed store id */
            $this->storeID = $storeID;                                                                      /* If the session store id does not match the passed store id, then sets the session store id to that store id */
            $SQLString = "SELECT * FROM inventory where storeID = '" .
            $this->storeID . "'";                                                                           /* Sets the variable $SQLString to the query which returns the data from the store that matches the store id */
            $QueryResult = @$this->DBConnect->query($SQLString);                                            /* Sets the variable $QueryResult to the returned result of the query */
            if ($QueryResult === FALSE) {                                                                   /* Checks to see if the query failed to execute */
               $this->storeID = "";                                                                         /* If the query failed to execute, then set the store id to an empty string */
            } else {                                                                                        /* Routes to the else statement if the query was successful */
               $this->inventory = array();                                                                  /* Sets the current session inventory to an array */
               $this->shoppingCart = array();                                                               /* Sets the current session shoppingCart to an array */
               while (($Row = $QueryResult->fetch_assoc()) !== NULL) {                                      /* Sets a while loop to return each row of data from the query */
                  $this->inventory[$Row['productID']] = array();                                            /* Sets the productID into an array */
                  $this->inventory[$Row['productID']]['name'] = $Row['name'];                               /* Sets the name into the current productID */
                  $this->inventory[$Row['productID']]['description'] = $Row['description'];                 /* Sets the description into the current productID */
                  $this->inventory[$Row['productID']]['price'] = $Row['price'];                             /* Sets the price into the current productID */
                  $this->shoppingCart[$Row['productID']] = 0;                                               /* Sets the shoppingCart to 0 */
               }                                                                                            /* Closes the while loop */
            }                                                                                               /* Closes the else statement */
         }                                                                                                  /* Closes the if statement */
      }                                                                                                     /* Closes the setStoreID function */
      public function getStoreInformation() {                                                               /* Opens a new public function by the name of getStoreInformation */
         $retval = FALSE;                                                                                   /* Sets the variable $retval to FALSE */
         if ($this->storeID != "") {                                                                        /* Checks to make sure the current session store id does not equal an empty string */
            $SQLString = "SELECT * FROM store_info where storeID = '" .
            $this->storeID . "'";                                                                           /* Sets a query to return the store information */
            $QueryResult = @$this->DBConnect->query($SQLString);                                            /* Sets $QueryResult to retain the result of the query */
            if  ($QueryResult !== FALSE) {                                                                  /* Checks to see if the query was successful */
               $retval = $QueryResult->fetch_assoc();                                                       /* If the query was successful, then sets the $retval variable to the returned data */
            }                                                                                               /* Closes the if statement */
         }                                                                                                  /* Closes the if statement */
         return($retval);                                                                                   /* Returns the $retval value */
      }                                                                                                     /* Closes the getStoreInformation function */
      public function getProductList() {                                                                    /* Opens a public function by the name of getProductList */
         $retval = FALSE;                                                                                   /* Initializes the $retval variable and sets it to FALSE */
         $subtotal = 0;                                                                                     /* Initializes the $subtotal variable and sets it to 0 */
         if (count($this->inventory) > 0) {                                                                 /* Checks to make sure the data rows in the inventory are greater than 0 */
            echo "<table width='100%'>\n";                                                                  /* Opens a table with a width of 100% */
            echo "<tr><th>Product</th><th>Description</th><th>Price Each</th>" .
            "<th># in Cart</th><th>Total Price</th><th>&nbsp;</th></tr>\n";                                 /* Sets the headers of the table */
            foreach ($this->inventory as $ID => $Info) {                                                    /* Sets a foreach loop to run through each row of data to be put into the table */
               echo "<tr><td>" . htmlentities($Info['name']) . "</td>\n";                                   /* Sets the name of the item into the table */
               echo "<td>" . htmlentities($Info['description']) . "</td>\n";                                /* Sets the description of the item into the table */
               printf("<td class='currency'>$%.2f</td>\n", $Info['price']);                                 /* Sets the price of the item into the table */
               echo "<td class='currency'>" . $this->shoppingCart[$ID] . "</td>\n";                         /* Sets the # of items in the cart currently */
               printf("<td class='currency'>$%.2f</td>\n", $Info['price'] * $this->shoppingCart[$ID]);      /* Sets the total price of each item that was added of that selection */
               echo "<td><a href='" . $_SERVER['SCRIPT_NAME'] . "?PHPSESSID=" .
               session_id() . "&ItemToAdd=$ID'>Add Item</a><br/>\n";                                        /* Sets a link to be able to add the item */
               echo "<a href='" . $_SERVER['SCRIPT_NAME'] . "?PHPSESSID=" . session_id() .
               "&ItemToRemove=$ID'>Remove Item</a></td>\n";                                                 /* Sets a link to be able to remove the item */
               $subtotal += ($Info['price'] * $this->shoppingCart[$ID]);                                    /* Calculates the subtotal */
            }                                                                                               /* Closes the foreach loop */
            echo "<tr><td colspan='4'>Subtotal</td>\n";                                                     /* Sets a row title for the subtotal that spans four columms */
            printf("<td class='currency'>$%.2f</td>\n", $subtotal);                                         /* Outputs the current subtotal */
            echo "<td><a href='" . $_SERVER['SCRIPT_NAME'] . "?PHPSESSID=" . session_id() .
            "&EmptyCart=TRUE'>Empty Cart</a></td></tr>\n";                                                  /* Sets a link for the user to be able to empty their cart completely of all items */
            echo "</table>";                                                                                /* Closes the table */
            echo "<p><a href='Little_Ch10_Checkout.php?PHPSESSID=" .
            session_id() . "&CheckOut=storeID'>Checkout</a></p>\n";                                         /* Sets a link to allow the user to checkout the items if desired */
            $retval = TRUE;                                                                                 /* Sets the $retval variable to TRUE */
         }                                                                                                  /* Closes the if statement */
         return($retval);                                                                                   /* Returns the value assigned to $retval */
      }                                                                                                     /* Closes the getProductList function */
      private function addItem() {                                                                          /* Opens a private function by the name of addItem */
         $ProdID = $_GET['ItemToAdd'];                                                                      /* Sets the variable of $ProdID to the item to add */
         if (array_key_exists($ProdID, $this->shoppingCart)) {                                              /* Checks to make sure the value exists in the array */
            $this->shoppingCart[$ProdID] += 1;                                                              /* Increments the counter of the shoppingCart by 1 */
         }                                                                                                  /* Closes the if statement */
      }                                                                                                     /* Closes the addItem function */
      function __wakeup() {                                                                                 /* Opens a function by the name of __wakeup */
         include("Little_Ch10_inc_OnlineStoreDB.php");                                                      /* Includes the inc_OnlineStoreDB php document */
         $this->DBConnect = $DBConnect;                                                                     /* Calls the connection to refresh it and keep it from timing out or in other terms falling asleep */
      }                                                                                                     /* Closes the __wakeup function */
      private function removeItem() {                                                                       /* Opens a private function by the name of removeItem */
         $ProdID = $_GET['ItemToRemove'];                                                                   /* Set the variable $ProdID to the item that needs to be removed */
         if (array_key_exists($ProdID, $this->shoppingCart)) {                                              /* Checks to make sure the value exists in the array */
            if ($this->shoppingCart[$ProdID] > 0) {                                                         /* Checks to make sure the value in the shoppingCart is greater than 0 */
               $this->shoppingCart[$ProdID] -= 1;                                                           /* Decrements the value of the shoppingCart by 1 */
            }                                                                                               /* Closes the if statement */
         }                                                                                                  /* Closes the if statement */
      }                                                                                                     /* Closes the removeItem function */
      private function emptyCart() {                                                                        /* Opens a private function by the name of emptyCart */
         foreach ($this->shoppingCart as $key => $value) {                                                  /* Sets a foreach loop for each item selected */
            $this->shoppingCart[$key] = 0;                                                                  /* Sets the shoppingCart value to 0 */
         }                                                                                                  /* Closes the foreach loop */
      }                                                                                                     /* Closes the emptyCart function */
      public function processUserInput() {                                                                  /* Opens a public function by the name of processUserInput */
         if (!empty($_GET['ItemToAdd'])) {                                                                  /* Checks to see if the value for ItemToAdd is empty */
            $this->addItem();                                                                               /* Calls the addItem() function */
         }                                                                                                  /* Closes the if statement */
         if (!empty($_GET['ItemToRemove'])) {                                                               /* Checks to see if the value for ItemToRemove is empty */
            $this->removeItem();                                                                            /* Calls the removeItem() function */
         }                                                                                                  /* Closes the if statement */
         if (!empty($_GET['EmptyCart'])) {                                                                  /* Checks to see if the value for EmptyCart is empty */
            $this->emptyCart();                                                                             /* Calls the emptyCart() function */
         }                                                                                                  /* Closes the if statement */
      }                                                                                                     /* Closes the processUserInput function */
      public function checkout() {                                                                          /* Opens a public function by the name of checkout */
         $ProductsOrdered = 0;                                                                              /* Initializes the $ProductOrdered variable and sets it to 0 */
         foreach($this->shoppingCart as $productID => $quantity) {                                          /* Sets a foreach loop to loop through each selected item */
            if ($quantity > 0) {                                                                            /* Checks to see if the $quantity variable value is greater than 0 */
               ++$ProductsOrdered;                                                                          /* Increments the value assigned to $ProductsOrdered */
               $SQLstring = "INSERT INTO orders " .
               " (orderID, productID, quantity) " .
               " VALUES('" . session_id() . "', " .
               "'$productID', $quantity)";                                                                  /* Sets the variable $SQLstring to the query to be entered, which will insert all the products selected by the user at checkout */
               $QueryResult = $this->DBConnect->query($SQLstring);                                          /* Sets the $QueryResult to the result of the query */
            }                                                                                               /* Closes the if statement */
         }                                                                                                  /* Closes the foreach loop */
         echo "<p><strong>Your order has been recorded.</strong></p>\n";                                    /* Outputs a message to the user that states that their order has been recorded */
      }                                                                                                     /* Closes the checkout function */
   }                                                                                                        /* Closes the class object */
   ?>                                                                                                       <!-- Utilizes a php script delimiter to close the php script -->
</body>                                                                                                     <!-- Closes the body portion of the document -->
</html>                                                                                                     <!-- Closes the file -->