<?php
/**
 * 
 * include.php - Classes and Functions
 * 
 * Contains all Classes and related Functions for
 * site functionality.
 * 
 * PHP 7.1.1-1+deb.sury.org~trusty+1
 * 
 * @author Robert Cato <saiwolf@swmnu.net>
 * @license https://opensource.org/licenses/mit-license.php MIT
 * 
 */
/**
 * Generic Helper Class
 * Misc. functions go here.
 */

namespace TicketApp;

Class GenericHelper
{
    /**
     * Function to get the currently executing
     * script's filename and 'chop' off the path
     * and file extension.
     * 
     * @param string $file The script's file name
     * @return string Sanitized page title with first letter Uppercased.
     */
     public function chopExt($file) {
         $safeFile = filter_var($file, FILTER_SANITIZE_STRING);
         $pageTitle = pathinfo($safeFile, PATHINFO_FILENAME);
         return ucfirst($pageTitle);
     }
}

Class DBHelper
{
    /**
     * Class constructor for DBHelper.
     * Defines class-wide variables for
     * database connection and maintenance.
     * 
     * We declare TicketApp\Config here via 'new'
     * to keep our DB values out of source control
     * for security reasons.
     */
    public function __construct() {
        
        $this->dbuser = 'TicketApp';
        $this->dbpass = 'vZvFqpLxc5dEq749';
        $this->dbhost = 'localhost';
        $this->dbname = 'TicketApp';
    }
    
    /**
     * Class destructor for DBHelper
     * Disconnects any open DB connection.
     */
    public function __destruct() {
        $this->disconnect();
    }
    
    /**
     * Function that attempts to establish a connection
     * to MySQL via PDO. Uses values established in
     * parent constructor as connection values.
     * 
     * @return class $dbConn Returns a new PDO class object on success, false on failure.
     */
    public function connect() {
        try {
            $this->dbConn = new \PDO("mysql:host=" . $this->dbhost . ";database=" . $this->dbname . "", $this->dbuser, $this->dbpass);
            $this->dbConn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $this->dbConn;
        } 
        catch (\PDOException $ex) {
            $errorMessage =  "PDO caught an error! MySQL said: " . $ex->GetMessage() . "<br />";
            return $errorMessage;
        }
    }
    
    /**
     * Function that sets class object
     * dbConn to null, therefore closing
     * any open SQL PDO connections.
     */
    public function disconnect() {
        $this->dbConn = null;
    }
}
?>