<?php require_once 'db.php';
  // Proccess All POST Requests
  if(isset($_POST) && !empty($_POST))
  {
    $type = isset($_POST['type'])?strip_tags($_POST['type']):NULL;
    if($type == NULL)
    {
      header($_SERVER['SERVER_PROTOCOL'].' 400 Bad Request');
      return;
    }
    else
    {
      $output = [];
      if($type == 'loginAsAdmin')
      {
        if($db->escape($_POST['username']) == 'admin' && $db->escape($_POST['password']) == '1234')
        {
          $_SESSION['token']  = md5('berkyildiz');
          $output = ['t'=>'Succesfull!','m'=>'Login successfully. Please wait..', 's'=>'success', 'r'=>'dashboard.php'];
        }
        else
        {
          $output = ['t' => 'Unauthorized!','m' => 'Your username or password is incorrect. Please try again.', 's' => 'warning'];
        }
      }
      if($type == 'registerCustomer')
      {
        if(isset($_POST['username']) && !empty($_POST['username'])
          && isset($_POST['adress']) && !empty($_POST['adress']))
          {
            $db->where('username', $db->escape($_POST['username']));
            if($db->has('customers')){
              $output = ['t'=>'Username Exists!','m'=>'This user is already registered.', 's'=>'warning'];
            }
            else
            {
              $data = [
                  'username'    =>  $db->escape($_POST['username']),
                  'adress'      =>  $db->escape($_POST['adress']),
                  'created_at'  =>  $db->now()
              ];
              $uid = $db->insert('customers', $data);
              if($uid > 0)
              {
                $output = ['t'=>'Customer Number is '.$uid,'m'=>'Succesfully created customer account. Please keep your customer number for login.', 's'=>'success'];
              }
              else
              {
                $output = ['t'=>'Error!','m'=>'There was an error while creating the customer. Customer not created. Try again please.', 's'=>'error'];
              }
            }
          }
          else
          {
            $output = ['t'=>'Warning!','m'=>'Please fill all the field completely.', 's'=>'warning'];
          }
      }
      if($type == 'loginCustomer')
      {
        if(isset($_POST['id']) && !empty($_POST['id']))
        {
          $db->where('id', $db->escape($_POST['id']));
          if($db->has('customers'))
          {
            $_SESSION['uid'] = $db->escape($_POST['id']);
            $output = ['t'=>'Logged in', 'm'=>'Succesfully logged. Please wait..', 's'=>'success', 'r'=>'order.php'];
          }
          else
          {
            $output = ['t'=>'Warning!','m'=>'Customer number is incorrect. Please try again.', 's'=>'warning'];
          }
        }
        else
        {
          $output = ['t'=>'Warning!','m'=>'Please fill all the field completely.', 's'=>'warning'];
        }
      }
      if($type == 'createProduct')
      {
        $data = [
            'name'        =>  $db->escape($_POST['name']),
            'stock'       =>  $db->escape($_POST['stock']),
            'price'       =>  $db->escape($_POST['price']),
            'updated_at'  =>  $db->now()
        ];
        if($db->insert('products', $data))
        {
          $output = ['t'=>'Succesfull!','m'=>'Product is succesfully add.', 's'=>'success'];
        }
        else
        {
          $output = ['t'=>'Error!','m'=>'Product isn\'t add.', 's'=>'error'];
        }
      }
      if($type == 'updateProduct')
      {
        $data = [
            'name'        =>  $db->escape($_POST['name']),
            'stock'       =>  $db->escape($_POST['stock']),
            'price'       =>  $db->escape($_POST['price']),
            'updated_at'  =>  $db->now()
        ];
        $db->where('id', $_POST['id']);
        if($db->update('products', $data))
        {
          $output = ['t'=>'Succesfull!','m'=>'Product is succesfully updated.', 's'=>'success'];
        }
        else
        {
          $output = ['t'=>'Error!','m'=>'Product isn\'t updated.', 's'=>'error'];
        }
      }
      if($type == 'updateRegion')
      {
        $data = [
            'region'        =>  $db->escape($_POST['region']),
            'estimatedt'       =>  $db->escape($_POST['estimatedt'])
        ];
        $db->where('id', $_POST['id']);
        if($db->update('regions', $data))
        {
          $output = ['t'=>'Succesfull!','m'=>'Region info is succesfully updated.', 's'=>'success'];
        }
        else
        {
          $output = ['t'=>'Error!','m'=>'Region info isn\'t updated.', 's'=>'error'];
        }
      }
      if($type == 'createRegion')
      {
        $data = [
            'region'      =>  $db->escape($_POST['region']),
            'estimatedt'  =>  $db->escape($_POST['estimatedt'])
        ];
        if($db->insert('regions', $data))
        {
          $output = ['t'=>'Succesfull!','m'=>'Region info is succesfully inserted.', 's'=>'success'];
        }
        else
        {
          $output = ['t'=>'Error!','m'=>'Region info isn\'t inserted.', 's'=>'error'];
        }
      }
      if($type == 'updateCustomer')
      {
        $data = [
            'username'  =>  $db->escape($_POST['username']),
            'adress'    =>  $db->escape($_POST['adress'])
        ];
        $db->where('id', $db->escape($_POST['id']));
        if($db->update('customers', $data))
        {
          $output = ['t'=>'Succesfull!','m'=>'Customers info is succesfully updated.', 's'=>'success'];
        }
        else
        {
          $output = ['t'=>'Error!','m'=>'Customers info isn\'t updated.', 's'=>'error'];
        }
      }
      if($type == 'delete')
      {
        $tables = ['products', 'regions', 'customers', 'orders'];
        if(in_array($_POST['table'], $tables))
        {
          $db->where('id', $db->escape($_POST['id']));
          if($db->update($_POST['table'], ['del'=>'1']))
          {
            $output = ['t'=>'Succesfull!','m'=>'Data is deleted.', 's'=>'success'];
          }
          else
          {
            $output = ['t'=>'Error!','m'=>'Data isn\'t delete.', 's'=>'error'];
          }
        }
      }
      echo json_encode($output);
    }
  }
  else
      header('Location: index.php');
