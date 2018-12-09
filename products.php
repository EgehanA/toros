<?php
require_once 'views/header.admin.view.php';
?>
<div class="be-content">
  <div class="main-content container-fluid">
    <div class="row wizard-row">
      <div class="col-md-12">
          <div class="panel panel-default panel-table">
            <div class="panel-heading">
              Products
              <a href="createproduct.php" class="btn btn-primary pull-right">New Product</a>
            </div>
            <div class="panel-body">
              <table id="table1" class="table table-striped table-hover table-fw-widget">
                <thead>
                  <tr>
                    <th width="2%">ID</th>
                    <th width="20%">Product Name</th>
                    <th width="10%">Price</th>
                    <th width="10%">Stock</th>
                    <th width="20%">Last Update</th>
                    <th width="10%">&nbsp;</th>
                  </tr>
                </thead>
                <tbody> 
                  <?php
                    $db->where('del', '0'); // WHERE del = 0 silenen kayıtları görmemesi için 
                    $db->orderBy('id', 'DESC');
                    $products = $db->get('products'); // SELECT * FROM products WHERE del = 0 ORDER BY id DESC
                    if(count($products) > 0)
                    {
                      foreach ($products as $k => $v)
                      {
                        echo '
                        <tr class="'.(($v['stock'] <= 0)?'danger':null).' '.(($k % 2 == 0)?'even':'odd').' gradeX">
                          <td>'.$v['id'].'</td>
                          <td>'.$v['name'].'</td>
                          <td>'.number_format($v['price'],2).' TRY</td> <!--1000 => 1.000,00-->
                          <td>'.$v['stock'].' Unit</td>
                          <td>'.((empty($v['updated_at']))?'-':date('F d,Y H:i:s', strtotime($v['updated_at']))).'</td>
                          <td class="text-center">
                            <a href="editproduct.php?id='.$v['id'].'" class="btn btn-'.(($v['stock'] <= 0)?'default':'primary').'">Edit</a>
                            <button type="button" class="btn btn-'.(($v['stock'] <= 0)?'default':'danger').'" data-delete="true" data-id="'.$v['id'].'" data-table="products">Delete</button>
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
