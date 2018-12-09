<?php
require_once 'views/header.view.php';
$db->where('id', $_SESSION['uid']);
$user = $db->getOne('customers');
$lastID = '1';
$oid = $db->getValue('orders', 'id');
if($oid > 0)
$lastID = $oid;
if(isset($_POST['ordercomplete']))
{

  $subtotal = 0;
  if(isset($_SESSION['order']) && count($_SESSION['order']['product']) > 0)
  {
    $data = [
      'cid'   =>  $_SESSION['uid'],
      'region'=>  $_SESSION['order']['region']
    ];
    foreach ($_SESSION['order']['product'] as $k => $v)
    {
      $db->where('id', $v);
      $product = $db->getOne('products');
      $subtotal += $product['price']*$_SESSION['order']['pieces'][$v];
      $dataDetail[] = [
        'pid'   =>  $product['id'],
        'number'=>  $_SESSION['order']['pieces'][$product['id']],
        'totalp'=>  $subtotal
      ];
    }
    $data['totalprice'] = $subtotal*1.18;
    $data['created_at'] = $db->now();
    $oid = $db->insert('orders',$data);
    foreach ($dataDetail as $k => $v)
    {
      $dataDetail[$k]['oid']  = $oid;
    }

    $db->insertMulti('orderdetails', $dataDetail);
    if($oid > 0)
    {
      header('Location: complete.php?status=1');
    }
  }
  else
  {
    echo '<div class="alert alert-primary">Not Found Selected Product</div>';
  }
}
?>
<div class="be-content">
  <div class="main-content container-fluid">
    <div class="row wizard-row">
      <div class="col-md-12 fuelux">
        <?php
        if(isset($_GET['status']))
        {
          if($_GET['status'] == '1')
            echo '<div class="alert alert-success">Order successfully created.</div>';
          else
            echo '<div class="alert alert-success">An error occurred while creating the order. Please try again.</div>';

        }

        ?>
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
                        if(isset($_SESSION['order']) && count($_SESSION['order']['product']) > 0)
                        {
                          foreach ($_SESSION['order']['product'] as $k => $v)
                          {
                            $db->where('id', $v);
                            $product = $db->getOne('products');
                            echo '<tr>
                                    <td class="description">'.$product['name'].'</td>
                                    <td class="hours">'.$_SESSION['order']['pieces'][$product['id']].'</td>
                                    <td class="amount">'.number_format($_SESSION['order']['pieces'][$product['id']]*$product['price'],2).' TRY</td>
                                    <td class="amount">'.(number_format($_SESSION['order']['pieces'][$product['id']]*$product['price'],2)*1.18).' TRY</td>
                                  </tr>';
                            $subtotal += $product['price']*$_SESSION['order']['pieces'][$product['id']];
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
