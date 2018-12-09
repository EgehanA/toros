<?php
require_once 'views/header.view.php';
$db->where('id', $_SESSION['uid']);
$user = $db->getOne('customers');
$lastID = '1';
$oid = $db->getValue('orders', 'id');
if($oid > 0)
  $lastID = $oid+1;

$_SESSION['order'] = $_POST;
?>
<div class="be-content">
  <div class="main-content container-fluid">
    <div class="row wizard-row">
      <div class="col-md-12 fuelux">
        <div class="block-wizard panel panel-default">
          <div id="wizard1" class="wizard wizard-ux">
            <ul class="steps">
              <li>1. Choose Our Region<span class="chevron"></span></li>
              <li>2. Select Products<span class="chevron"></span></li>
              <li data-step="3" class="active">3. Order Summary<span class="chevron"></span></li>
              <li data-step="4">4. Complete Order<span class="chevron"></span></li>
            </ul>
               <div class="step-content">
                <div data-step="3" class="step-pane">
                  <div class="form-group no-padding">
                    <div class="col-sm-7">
                      <h3 class="wizard-title">Order Summary</h3>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="invoice">
                        <div class="row invoice-header">
                          <div class="col-xs-7">
                            <img src="assets/img/logo-xx.png" alt="" width="204">
                          </div>
                          <div class="col-xs-5 invoice-order"><span class="invoice-id">Order #<?php echo str_pad($lastID, 4, "0", STR_PAD_LEFT); ?></span><span class="incoice-date"><?php echo date('F d, Y') ?></span></div>
                        </div>
                        <div class="row invoice-data">
                          <div class="col-xs-5 invoice-person"><span class="name">Toros Cafe</span></div>
                          <div class="col-xs-2 invoice-payment-direction"><i class="icon mdi mdi-chevron-right"></i></div>
                          <div class="col-xs-5 invoice-person"><span class="name"><?php echo $user['username']; ?></span><span><?php echo $user['adress']; ?></span></div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <table class="invoice-details">
                              <tr>
                                <th style="width:50%">Description</th>
                                <th style="width:17%" class="hours">Piece</th>
                                <th style="width:15%" class="amount">Amount</th>
                                <th style="width:15%" class="amount">Amount (VAT)</th>
                              </tr>
                              <?php
                                $subtotal = 0;
                                if(isset($_POST) && count($_POST['product']) > 0)
                                {
                                  foreach ($_POST['product'] as $k => $v)
                                  {
                                    $db->where('id', $v);
                                    $product = $db->getOne('products');
                                    echo '<tr>
                                            <td class="description">'.$product['name'].'</td>
                                            <td class="hours">'.$_POST['pieces'][$product['id']].'</td>
                                            <td class="amount">'.number_format($_POST['pieces'][$product['id']]*$product['price'],2).' TRY</td>
                                            <td class="amount">'.(number_format($_POST['pieces'][$product['id']]*$product['price'],2)*1.18).' TRY</td>
                                          </tr>';
                                    $subtotal += $product['price']*$_POST['pieces'][$product['id']];
                                  }
                                }
                                else
                                {
                                  echo '<div class="alert alert-primary">Not Found Selected Product</div>';
                                }
                              ?>
                              <tr>
                                <td></td>
                                <td></td>
                                <td class="summary">Subtotal</td>
                                <td class="amount"><?php echo number_format($subtotal,2); ?> TRY</td>
                              </tr>
                              <tr>
                                <td></td>
                                <td></td>
                                <td class="summary">VAT (18%)</td>
                                <td class="amount"><?php echo number_format($subtotal*0.18,2); ?> TRY</td>
                              </tr>
                              <tr>
                                <td></td>
                                <td></td>
                                <td class="summary total">Total</td>
                                <td class="amount total-value"><?php echo number_format($subtotal*1.18,2); ?> TRY</td>
                              </tr>
                            </table>
                          </div>
                        </div>
                        <div class="row invoice-footer">
                          <div class="col-md-12">
                            <form action="complete.php" method="post">
                              <button type="submit" name="ordercomplete" class="btn btn-lg btn-space btn-primary">Order Complete</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
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
