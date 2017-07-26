<?php

  /**
   * Require the head layout
   * 
   */
  require(__DIR__ . '/../include/layouts/head.inc');
  

use TicketApp\DBHelper;

$db1 = new DBHelper;
$db2 = new DBHelper;

$db1->query("SELECT name FROM people");
$nameset = $db1->resultSet();


?>
<div class="row">
  <div class="col-md-10 col-md-offset-1">
    <h3>Tickets!</h3>
  </div>
</div>

<?php
  foreach ($nameset as $data) {
    $db2->query("SELECT * FROM tickets WHERE AssignedTo = :name");
    $db2->bind('name', $data['name'], PDO::PARAM_STR);
    $dataset = $db2->resultSet();
?>
<div class="row">
  <div class="col-md-10 col-md-offset-1">
    <div class="panel panel-default panel-table">

              <div class="panel-heading">
                <div class="row">
                  <div class="col col-xs-12">
                    <h3 class="panel-title"><?php echo $data['name']; ?></h3>
                  </div>
                </div>
              </div>
              
              <div class="panel-body">
                <table class="table table-striped table-bordered table-list">
                  <thead>
                    <tr>
                        <th><em>Edit</em></th>
                        <th>Ticket #</th>
                        <th>Submitted On</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Department</th>
                        <th>Assigned To</th>
                        <th>Days Open</th>
                        <th>Date Completed</th>
                    </tr> 
                  </thead>
                  <tbody>
                    <?php foreach ($dataset as $row) { ?>
                          <tr>
                            <td align="center">
                              <a class="btn btn-default"><em class="fa fa-pencil"></em></a>
                              <a class="btn btn-danger"><em class="fa fa-trash"></em>
                            </td>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $genericHelper->displayDate($row['SubmittedOn'], 'm/d/Y'); ?></td>
                            <td><?php echo $row['RequesterName']; ?></td>
                            <td><?php echo $row['Description']; ?></td>
                            <td><?php echo $row['department']; ?></td>
                            <td><?php echo $row['AssignedTo']; ?></td>
                            <td><?php echo $genericHelper->daysOpen($row['SubmittedOn']); ?></td>
                            <td><?php echo $genericHelper->displayDate($row['CompletedOn'], 'm/d/Y'); ?></td>
                          </tr>
                      <?php } ?>
                    </tbody>
                </table>
              </div>
            </div>
        </div>
    </div>
<?php } ?>
</div>
<?php require(__DIR__ . '/../include/layouts/footer.inc'); ?>