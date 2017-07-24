<?php
  /**
   * head.inc - Global Header file.
   * Akin to Site.Master in ASP.NET
   * 
   * PHP 7.1.7-1+ubuntu14.04.1+deb.sury.org+1
   * 
   * @author Robert Cato <saiwolf@swmnu.net>
   * @license https://opensource.org/licenses/mit-license.php MIT
   * 
   **/
   
   /* Include our autoloader */
   require(__DIR__ . '/../autoload.php');
   
  /**
   * Initialize new GenericHelper class, as the chopExt() function is used
   * in the <title> tag. This also gives all pages access to the class.
   * 
   * @see GenericHelper::chopExt($file)
   */
   use TicketApp\GenericHelper;
   $genericHelper = new GenericHelper;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Ticket App">
    <meta name="author" content="Robert Cato <saiwolf@swmnu.net>">
    
    <!-- See include.php -> TicketApp\GenericHelper::chopExt($file) -->
    <!-- Returns the sanitized file name sans extension. -->
    <title><?php echo $genericHelper->chopExt($_SERVER['PHP_SELF']) . "!" ?></title>

    <!-- Bootstrap -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Optional Bootstrap Theme -->
    <link href="/assets/css/bootstrap-theme.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="/assets/css/font-awesome.min.css" rel="stylesheet">
    <!-- Custom Site CSS -->
    <link href="/assets/css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container">