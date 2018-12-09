<?php
require_once 'views/header.admin.view.php';
?>
<div class="be-content">
  <div class="main-content container-fluid">
    <div class="row wizard-row">
      <div class="col-md-12">
          <div class="panel panel-default panel-table">
            <div class="panel-heading">
              Regions
              <a href="createregion.php" class="btn btn-primary pull-right">New Region</a>
            </div>
            <div class="panel-body">
              <table id="table1" class="table table-striped table-hover table-fw-widget">
                <thead>
                  <tr>
                    <th width="2%">ID</th>
                    <th width="10%">Region Name</th>
                    <th width="20%">Estimated Time</th>
                    <th width="10%">&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $db->where('del', '0');
                    $db->orderBy('id', 'DESC');
                    $regions = $db->get('regions');
                    if(count($regions) > 0)
                    {
                      foreach ($regions as $k => $v)
                      {
                        echo '
                        <tr class="'.(($k % 2 == 0)?'even':'odd').' gradeX">
                          <td>'.$v['id'].'</td>
                          <td>'.$v['region'].'</td>
                          <td>'.$v['estimatedt'].' minute</td>
                          <td class="text-center">
                            <a href="editregion.php?id='.$v['id'].'" class="btn btn-primary">Edit</a>
                            <button type="button" class="btn btn-danger" data-delete="true" data-id="'.$v['id'].'" data-table="regions">Delete</button>
                          </td>
                        </tr>';
                      }
                    }
                  ?>

                </tbody>
              </table>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
<?php
$appendFooter = <<<BERK
<script src="assets/lib/datatables/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="assets/lib/datatables/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
<script src="assets/lib/datatables/plugins/buttons/js/dataTables.buttons.js" type="text/javascript"></script>
<script src="assets/lib/datatables/plugins/buttons/js/buttons.html5.js" type="text/javascript"></script>
<script src="assets/lib/datatables/plugins/buttons/js/buttons.flash.js" type="text/javascript"></script>
<script src="assets/lib/datatables/plugins/buttons/js/buttons.print.js" type="text/javascript"></script>
<script src="assets/lib/datatables/plugins/buttons/js/buttons.colVis.js" type="text/javascript"></script>
<script src="assets/lib/datatables/plugins/buttons/js/buttons.bootstrap.js" type="text/javascript"></script>
<script src="assets/js/app-tables-datatables.js" type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function(){
    //initialize the javascript
    App.init();
    App.dataTables();
  });
</script>
BERK;
require_once 'views/footer.view.php';
