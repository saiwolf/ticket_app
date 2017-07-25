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

use PDO;

// Define DB config
define("DB_HOST", "localhost");
define("DB_USER", "TicketApp");
define("DB_PASS", "vZvFqpLxc5dEq749");
define("DB_NAME", "TicketApp");

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

class DBHelper {
    // Define configuration
    private $host   = DB_HOST;
    private $user   = DB_USER;
    private $pass   = DB_PASS;
    private $dbname = DB_NAME;
    private $dbh;
    private $error;
    private $stmt;
    
    public function __construct() {
        // Set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        
        // Set options
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        }
        // Catch any errors
        catch (PDOException $e) {
            $this->error = $e->getMessage();
        }
    }
    
    public function query($query) {
        $this->stmt = $this->dbh->prepare($query);
    }
    
    public function bind($param, $value, $type = null) {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        
        $this->stmt->bindValue($param, $value, $type);
    }
    
    public function execute() {
        return $this->stmt->execute();
    }
    
    public function resultset() {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function single() {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    
    public function rowCount() {
        return $this->stmt->rowCount();
    }
    
    public function lastInsertId() {
        return $this->dbh->lastInsertId();
    }
    
    public function beginTransaction() {
        return $this->dbh->beginTransaction();
    }
    
    public function endTransaction() {
        return $this->dbh->commit();
    }
    
    public function cancelTransaction() {
        return $this->dbh->rollBack();
    }
    
    public function debugDumpParams() {
        return $this->stmt->debugDumpParams();

    }
}
?>