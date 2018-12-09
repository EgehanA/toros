<?php
require_once 'views/header.admin.view.php';

if(!isset($_GET['id']) || empty($_GET['id']))
{
  header('Location: orders.php');
  return;
}
$db->where('del', '0');
$db->where('id', $db->escape($_GET['id']));
if(!$db->has('orders'))
{
  header('Location: orders.php');
  return;
}
$db->where('id', $db->escape($_GET['id']));
$orderDetail = $db->getOne('orders');

$db->where('id', $orderDetail['cid']);
$user = $db->getOne('customers');

$db->where('id', $orderDetail['region']);
$region = $db->getOne('regions', 'region, estimatedt');
?>
<div class="be-content">
  <div class="main-content container-fluid">
    <div class="row wizard-row">
      <div class="col-md-12 fuelux">
        <div class="panel panel-default">
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
                  <div class="col-xs-5 invoice-order"><span class="invoice-id">Order #<?php echo str_pad($orderDetail['id'], 4, "0", STR_PAD_LEFT); ?></span><span class="incoice-date"><?php echo date('F d, Y', strtotime($orderDetail['created_at'])) ?></span></div>
                </div>
                <div class="row invoice-data">
                  <div class="col-xs-5 invoice-person"><span class="name">Toros Cafe</span></div>
                  <div class="col-xs-2 invoice-payment-direction"><i class="icon mdi mdi-chevron-right"></i></div>
                  <div class="col-xs-5 invoice-person"><span class="name"><?php echo $user['username']; ?></span><span><?php echo $user['adress']; ?></span><span><?php echo $region['region'].' ('.$region['estimatedt'].' min.)'; ?></span></div>
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
                        if(isset($orderDetail) && count($orderDetail) > 0)
                        {
                          $db->where('oid', $orderDetail['id']);
                          $details = $db->get('orderdetails');
                          foreach ($details as $k => $v)
                          {
                            $db->where('id', $v['pid']);
                            $product = $db->getOne('products');
                            echo '<tr>
                                    <td class="description">'.$product['name'].'</td>
                                    <td class="hours">'.$v['number'].'</td>
                                    <td class="amount">'.number_format($v['totalp'],2).' TRY</td>
                                    <td class="amount">'.number_format($v['totalp']*1.18,2).' TRY</td>
                                  </tr>';
                            $subtotal += $v['totalp'];
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
