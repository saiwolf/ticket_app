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
define("DB_USER", "username");
define("DB_PASS", "password");
define("DB_NAME", "database");

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

}
?>