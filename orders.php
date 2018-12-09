<?php
require_once 'views/header.admin.view.php';
?>
<div class="be-content">
  <div class="main-content container-fluid">
    <div class="row wizard-row">
      <div class="col-md-12">
          <div class="panel panel-default panel-table">
            <div class="panel-heading">Orders</div>
            <div class="panel-body">
              <table id="table1" class="table table-striped table-hover table-fw-widget">
                <thead>
                  <tr>
                    <th width="2%">ID</th>
                    <th width="10%">Username</th>
                    <th width="30%">Adress</th>
                    <th width="10%">Region</th>
                    <th width="10%">Total</th>
                    <th width="15%">Create at</th>
                    <th width="10%">&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $db->where('del', '0');
                    $db->orderBy('id', 'DESC');
                    $orders = $db->get('orders');
                    if(count($orders) > 0)
                    {
                      foreach ($orders as $k => $v)
                      {
                        $db->where('id', $v['cid']);
                        $user = $db->getOne('customers', 'username, adress');
                        $db->where('id', $v['region']);
                        echo '
                        <tr class="'.(($k % 2 == 0)?'even':'odd').' gradeX">
                          <td>'.$v['id'].'</td>
                          <td>'.$user['username'].'</td>
                          <td>'.$user['adress'].'</td>
                          <td>'.$db->getValue('regions', 'region').'</td>
                          <td>'.$v['totalprice'].' TRY</td>
                          <td class="center">'.$v['created_at'].'</td>
                          <td class="text-center">
                            <a href="detailorderc.php?id='.$v['id'].'" class="btn btn-primary">Detail</a>
                            <button type="button" class="btn btn-danger" data-delete="true" data-id="'.$v['id'].'" data-table="orders">Delete</button>
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
