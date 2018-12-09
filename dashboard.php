<?php
  require_once 'views/header.admin.view.php';
?>
<div class="be-content">
  <div class="main-content container-fluid">
    <div class="row">
      <div class="col-xs-12 col-md-6 col-lg-3">
          <div class="widget widget-tile">
            <span class="mdi mdi-chevron-right" style="font-size:28px"> <?php
              $db->where('del', '0'); echo $db->getValue('products', 'COUNT(id)'); ?> Products</span>
          </div>
      </div>
      <div class="col-xs-12 col-md-6 col-lg-3">
          <div class="widget widget-tile">
            <span class="mdi mdi-chevron-right" style="font-size:28px"> <?php
              $db->where('del', '0'); echo $db->getValue('customers', 'COUNT(id)'); ?> Customers</span>
          </div>
      </div>
      <div class="col-xs-12 col-md-6 col-lg-3">
          <div class="widget widget-tile">
            <span class="mdi mdi-chevron-right" style="font-size:28px"> <?php
              $db->where('del', '0'); echo $db->getValue('orders', 'COUNT(id)'); ?> Orders</span>
          </div>
      </div>
      <div class="col-xs-12 col-md-6 col-lg-3">
          <div class="widget widget-tile">
            <span class="mdi mdi-chevron-right" style="font-size:28px"> <?php
              $db->where('del', '0'); echo $db->getValue('regions', 'COUNT(id)'); ?> Regions</span>
          </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-md-6">
        <div class="panel panel-default">
          <div class="panel-heading">Latest Orders</div>
          <div class="panel-body">
            <ul class="user-timeline user-timeline-compact">
              <?php
                $db->where('del', '0');
                $db->orderBy('id', 'DESC');
                $lastOrders = $db->get('orders', 5);
                if(count($lastOrders) > 0)
                {
                  foreach ($lastOrders as $key => $value) {
                    $db->where('id', $value['cid']);
                    $username = $db->getValue('customers', 'username');
                    $db->where('id', $value['region']);
                    $region = $db->getValue('regions', 'region');
                    echo '<li class="'.(($key == '0')?'latest':null).'">
                      <div class="user-timeline-date">'.date('F d,Y H:i:s', strtotime($value['created_at'])).'</div>
                      <div class="user-timeline-title">'.$username.'</div>
                      <div class="user-timeline-description">To: '.$region.' Region - Amount: '.$value['totalprice'].' TRY</div>
                    </li>';

                  }
                }
                ?>
            </ul>
          </div>
          <a href="orders.php" class="btn btn-primary btn-block">Show All Orders</a>
        </div>
      </div>
      <div class="col-sm-12 col-md-6">
        <div class="panel panel-default panel-table">
          <div class="panel-heading">
             <div class="title">Latest Customers</div>
          </div>
          <div class="panel-body table-responsive">
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th style="width:25%;">Username</th>
                  <th style="width:36%;">Adress</th>
                  <th>Date</th>
                </tr>
              </thead>
              <tbody>

                <?php
                  $db->where('del', '0');
                  $db->orderBy('id', 'DESC');
                  $lastCustomers = $db->get('customers', 5);
                  if(count($lastCustomers) > 0)
                  {
                    foreach ($lastCustomers as $key => $value) {
                      echo '<tr>
                            <td class="user-avatar"> <img src="assets/img/avatar1.png" alt="Avatar">'.$value['username'].'</td>
                            <td>'.$value['adress'].'</td>
                            <td>'.date('F d,Y H:i:s', strtotime($value['created_at'])).'</td>
                          </tr>';
                    }
                  }
                  ?>
              </tbody>
            </table>
            <a href="customers.php" class="btn btn-primary btn-block">Show All Customers</a>
          </div>
        </div>
      </div>
    </div>
  <?php
  require_once 'views/footer.view.php';
