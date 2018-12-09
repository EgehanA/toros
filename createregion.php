<?php
require_once 'views/header.admin.view.php';
?>
<div class="be-content">
  <div class="main-content container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default panel-border-color panel-border-color-primary">
            <div class="panel-heading panel-heading-divider">New Region Form</div>
            <div class="panel-body">
              <form action="post.php" method="POST" style="border-radius: 0px;" class="form-horizontal group-border-dashed" data-xhr="true">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Region Name</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="region" placeholder="Region Name">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Estimated Time</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" name="estimatedt" placeholder="Estimated Time">
                  </div>
                  <div class="col-sm-1">
                    minutes
                  </div>
                </div>
                <div class="form-group">
                  <input type="hidden" name="type" value="createRegion">
                  <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-primary btn-block">Create Region</button>
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
