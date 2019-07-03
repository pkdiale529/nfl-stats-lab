<?php
	class DB_CONNECT 
	{
		private $conn;

		// constructor
		function __construct() {
			// does nothing
		}

		// destructor
		function __destructor() {
			// does nothing
		}

		/**
     	* Function to connect with database
     	*/
   		 function connect() {
	        $servername = "wheatley.cs.up.ac.za";
			$username = "u17076146";
			$password = "Aomine01";
			$dbname = "u17076146_FOOTBALL";

			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			} 
			return $conn;
		} 
	    /**
	     * Function to close db connection
	     */
	    function close() {
	        // closing db connection
	        mysql_close();
		}
	}
?>