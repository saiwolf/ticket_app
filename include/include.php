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


namespace TicketApp;

use PDO;
use DateTime;

// Define DB config
define("DB_HOST", "localhost");
define("DB_USER", "TicketApp");
define("DB_PASS", "vZvFqpLxc5dEq749");
define("DB_NAME", "TicketApp");


/**
 * Generic Helper Class
 * Non-specific functions go here.
 */
 
class GenericHelper
{
    /**
     * Private variable declarations
     * 
     */
     // private var = value;
     
    /**
     * public function chopExt()
     * 
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
     
     /**
      * public function daysOpen()
      * 
      * Returns the difference between today's date
      * and a date specified as a parameter using DateTime.
      * 
      * @param date $submittedOn The date the item was submitted on.
      * @return int $interval-d The difference between now() and $submittedOn
      */
     public function daysOpen($submittedOn) {
         $submitDate = new DateTime($submittedOn);
         $today = new DateTime('now');
         $interval = $today->diff($submitDate);
         return $interval->d;
     }
     
     /**
      * public function displayDate()
      * 
      * Function to format dates dynamically with DateTime::format().
      * 
      * @param date $date The date to format. Should be in UNIX timestamp form.
      * @param string $format A string containing the format for the date. Should
      * adhere to what PHP's date() expects. (http://php.net/manual/en/function.date.php)
      * 
      * @return date $formatDate The date formatted as specified.
      */
     public function displayDate($date, $format) {
         $formatDate = new DateTime($date);
         return $formatDate->format($format);
     }
}

/**
 * DBHelper Class.
 * FQN: TicketApp\DBHelper
 * 
 * Contains functions related to SQL operations.
 */
class DBHelper {
    /**
     * Private variable declarations
     * 
     */
    private $host   = DB_HOST; //
    private $user   = DB_USER; //
    private $pass   = DB_PASS; // Look, ma, DB variables!
    private $dbname = DB_NAME; //
    private $dbh;
    private $error;
    private $stmt;
    
    /**
     * public function __construct()
     * 
     * Constructor class for DBHelper. Automatically invoked 
     * upon class instantation. Sets connection values and 
     * attempts DB connection.
     * 
     * @param null Nothing
     * @return PDO PDO connection object
     */
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
    
    /**
     * public function query()
     * 
     * Prepares a SQL statement for execution
     * 
     * @param string $query SQL Query
     * @return string $stmt Properly Prepared SQL Query
     */
    public function query($query) {
        $this->stmt = $this->dbh->prepare($query);
    }
    
    
    /**
     * public function bind()
     * 
     * Binds values for use in prepared statements.
     * For use with DBHelper::query()
     * 
     * @param string $param Name of param in SQL query
     * @param string $value Value of $param
     * @param PDO::PARAM $type PDO Param Type for explicit declaration.
     * Defaults to PDO::PARAM_STR for 'VARCHAR'
     * 
     * @return string $stmt Fully prepared and bound SQL query.
     */
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