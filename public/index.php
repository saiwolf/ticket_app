<?php
  /**
   * Require the head layout
   * 
   */
  require(__DIR__ . '/../include/layouts/head.inc');
  
  /**
   * Invoking DBHelper Class. We need it for SQL operations.
   * 
   */
  use TicketApp\DBHelper;
  $db = new DBHelper;
  $dbConn = $db->connect();
  echo var_dump($dbConn);
  
  $stmt = $dbConn->query("SELECT * FROM tickets WHERE EXISTS (SELECT name FROM people)");
  echo $stmt;
  
?>
<div class="row">
    <p></p>
    <h1>Tickets</h1>
<?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default panel-table">
              <div class="panel-heading">
                <div class="row">
                  <div class="col col-xs-12">
                    <h3 class="panel-title"><?php echo $row['AssignedTo']; ?></h3>
                  </div>
                </div>
              </div>
              <div class="panel-body">
                <table class="table table-striped table-bordered table-list">
                  <thead>
                    <tr>
                        <th><em>Edit</em></th>
                        <th class="hidden-xs">Ticket #</th>
                        <th>Submitted On</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Department</th>
                        <th>Assigned To</th>
                        <th>Days Open</th>
                        <th>Date Completed</th>
                        <th><em>Delete</em></th>
                    </tr> 
                  </thead>
                  <tbody>
                          <tr>
                            <td align="center">
                              <a class="btn btn-default"><em class="fa fa-pencil fa-fw"></em></a>
                            </td>
                            <td class="hidden-xs"><?php echo $row['id']; ?></td>
                            <td><?php echo $row['SubmittedOn']; ?></td>
                            <td><?php echo $row['RequestorName']; ?></td>
                            <td><?php echo $row['Description']; ?></td>
                            <td><?php echo $row['Department']; ?></td>
                            <td><?php echo $row['AssignedTo']; ?></td>
                            <td>TODO - Days open</td>
                            <td><?php echo $row['CompletedOn']; ?></td>
                            <td><a class="btn btn-danger"><em class="fa fa-trash fa-fw"></em></a></td>
                          </tr>
                        </tbody>
                </table>
              </div>
            </div>
        </div>
    </div>
<?php } // End DB While Loop ?>
</div>
<?php require(__DIR__ . '/../include/layouts/footer.inc'); ?>

