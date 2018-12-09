<?php
require_once 'views/header.view.php';
?>
<div class="be-content">
  <div class="main-content container-fluid">
    <div class="row wizard-row">
      <div class="col-md-12 fuelux">
        <div class="block-wizard panel panel-default">
          <div id="wizard1" class="wizard wizard-ux">
            <ul class="steps">
              <li data-step="1" class="active">1. Choose Our Region<span class="chevron"></span></li>
              <li data-step="2">2. Select Products<span class="chevron"></span></li>
              <li data-step="3">3. Order Summary<span class="chevron"></span></li>
              <li data-step="3">4. Complete Order<span class="chevron"></span></li>
            </ul>
            <form action="order2.php" method="post" data-parsley-namespace="data-parsley-" data-parsley-validate="" novalidate="" class="form-horizontal group-border-dashed">
              <div class="step-content">
                <div data-step="1" class="step-pane active">
                  <div class="table-responsive noSwipe">
                    <table class="table table-striped table-hover">
                      <thead>
                        <tr>
                          <th style="width:5%;">&nbsp;</th>
                          <th style="width:20%;">Region Name</th>
                          <th style="width:17%;">Estimated Time</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $db->where('del', '0');
                        $regions = $db->get('regions');
                        if(count($regions) > 0)
                        {
                          foreach ($regions as $key => $region)
                          {
                            echo '
                            <tr>
                              <td>
                                <div class="be-checkbox be-checkbox-sm">
                                  <input id="check'.$region['id'].'" type="radio" name="region" value="'.$region['id'].'" '.(($key=='0')?'checked':null).'>
                                  <label for="check'.$region['id'].'"></label>
                                </div>
                              </td>
                              <td class="cell-detail"><span>'.$region['region'].'</span></td>
                              <td class="cell-detail"><span>'.$region['estimatedt'].' minute</span></td>
                            </tr>';
                          }
                        }
                        else
                        {
                          echo '<tr class="primary">
                                  <td colspan="3">
                                  There are no region registrations you can order now. Please try again later.
                                  </td>
                                </tr>';
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                  <div class="form-group pull-right">
                    <div class="col-sm-12">
                      <button class="btn btn-default btn-space wizard-previous" disabled>Previous</button>
                      <button data-wizard="#wizard1" type="submit" class="btn btn-primary btn-space wizard-next">Next Step</button>
                    </div>
                  </div>
                </div>
                <div data-step="2" class="step-pane">
                  <div class="form-group no-padding">
                    <div class="col-sm-7">
                      <h3 class="wizard-title">Select Products</h3>
                    </div>
                  </div>
                  <div class="table-responsive noSwipe">
                    <table class="table table-striped table-hover">
                      <thead>
                        <tr>
                          <th style="width:5%;">&nbsp;</th>
                          <th>Product Name</th>
                          <th>Price</th>
                          <th>Piece</th>
                          <th width="10%">Availability</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $products = $db->get('products');
                        if(count($products) > 0)
                        {
                          foreach ($products as $key => $product)
                          {
                            echo '
                            <tr>
                              <td>
                                <div class="be-checkbox be-checkbox-sm">
                                  <input id="product'.$product['id'].'" type="checkbox" name="product[]" value="'.$product['id'].'" '.(($product['stock'] <= 0)?'disabled':NULL).'>
                                  <label for="product'.$product['id'].'"></label>
                                </div>
                              </td>
                              <td><span>'.$product['name'].'</span></td>
                              <td><span>'.$product['price'].' TRY</span></td>
                              <td><input type="number" class="form-control" name="pieces['.$product['id'].']" value="0" min="0"  tabindex="'.$key++.'" max="'.(($product['stock'] < 0)?0:$product['stock']).'" '.(($product['stock'] <= 0)?'disabled':NULL).'></td>
                              <td><input type="number" class="form-control" readonly value="'.$product['stock'].'"></td>
                            </tr>';
                          }
                        }
                        else
                        {
                          echo '<tr class="primary">
                                  <td colspan="3">
                                  There are no region registrations you can order now. Please try again later.
                                  </td>
                                </tr>';
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <button data-wizard="#wizard1" class="btn btn-default btn-space wizard-previous">Previous</button>
                      <button class="btn btn-primary btn-space">Next Step</button>
                    </div>
                  </div>
                </div>
              </form>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
// EOT, HEREDOC değişken tanımlama
$appendFooter = <<<BERK
<script type="text/javascript">
    $(document).ready(function(){
      App.wizard();
    });
   $(document).on('change', 'input[type=checkbox]', function(){
    var el = $(this);
    var status = $(this).is(":checked");
    console.log($(el));
    if(status)
    {
      $(el).parent('div').parent('td').parent('tr').addClass('primary');
      $(el).parent('div').parent('td').parent('tr').find('input[type=number]:first').val(1);
      $(el).parent('div').parent('td').parent('tr').find('input[type=number]:first').attr('required', 'required');
    }
    else
    {
      $(el).parent('div').parent('td').parent('tr').removeClass('primary');
      $(el).parent('div').parent('td').parent('tr').find('input[type=number]:first').val(0);
      $(el).parent('div').parent('td').parent('tr').find('input[type=number]:first').removeAttr('required');
    }
  });
</script>
BERK;
require_once 'views/footer.view.php';
