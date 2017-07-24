<?php
/**
 * 
 * autoload.php - Global autoload file
 * 
 * Contains require statements for all global
 * includes needed. This allows custom autloading,
 * while not modifying default composer vendor/autoload.php
 * 
 * PHP 7.1.1-1+deb.sury.org~trusty+1
 * 
 * @author Robert cato <saiwolf@swmnu.net>
 * @license https://opensource.org/licenses/mit-license.php MIT
 * 
 */
 
 // Start our session here, since it's always included. (NOT IN USE YET)
 // session_start();
 
 /**
  * Add requires here as relevant
  */
//require __DIR__."/../vendor/autoload.php";     // Composer not in use!
require __DIR__."/include.php";     // Classes and Functions.