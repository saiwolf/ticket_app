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