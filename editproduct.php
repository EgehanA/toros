<?php
require_once 'views/header.admin.view.php';
if(!isset($_GET['id']) || !(int)$_GET['id'] || empty($_GET['id'])){
  header('Location: products.php');
  return;
}
$db->where('del', '0');
$db->where('id', $db->escape($_GET['id']));
if ($db->has('products')){
  $db->where('id', $db->escape($_GET['id']));
  $data = $db->getOne('products');
}
else
{
  header('Location: products.php');
  return;
}
?>
<div class="be-content">
  <div class="main-content container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default panel-border-color panel-border-color-primary">
            <div class="panel-heading panel-heading-divider">Edit Product Form</div>
            <div class="panel-body">
              <form action="post.php" method="POST" style="border-radius: 0px;" class="form-horizontal group-border-dashed" data-xhr="true">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Product Name</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" placeholder="Product Name" value="<?php echo $data['name']; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Product Price</label>
                  <div class="col-sm-6">
                    <input type="number" class="form-control" name="price" placeholder="0.00"  value="<?php echo $data['price']; ?>" step=".01">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Stock (unit)</label>
                  <div class="col-sm-6">
                    <input type="number" class="form-control" name="stock" placeholder="0"  value="<?php echo $data['stock']; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <input type="hidden" name="type" value="updateProduct">
                  <input type="hidden" name="id" value="<?php echo (int)$_GET['id']; ?>">
                  <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-primary btn-block">Update Product</button>
                  </div>
                </div>
              </form>
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
