<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Berk Yıldız">
    <link rel="shortcut icon" href="assets/img/logo-fav.png">
    <title>Toros Cafe</title>
    <link rel="stylesheet" type="text/css" href="assets/lib/perfect-scrollbar/css/perfect-scrollbar.min.css"/>
    <link rel="stylesheet" type="text/css" href="assets/lib/material-design-icons/css/material-design-iconic-font.min.css"/>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="assets/css/style.css" type="text/css"/>
  </head>
  <body class="be-splash-screen">
    <div class="be-wrapper be-login">
      <div class="be-content">
        <div class="main-content container-fluid">
          <div class="splash-container">

              <div class="panel panel-default panel-border-color panel-border-color-primary">
                <div class="panel-heading"><img src="assets/img/logo-xx.png" alt="logo" width="250" class="logo-img"><span class="splash-description">Please enter your user information.</span></div>
                <div class="panel-body">
                  <form action="post.php" method="post">
                    <div class="login-form">
                      <div class="form-group">
                        <input id="username" type="text" name="username" placeholder="Username" autocomplete="off" class="form-control">
                      </div>
                      <div class="form-group">
                        <textarea id="adress" type="text" name="adress" placeholder="Adress" autocomplete="off" class="form-control"></textarea>
                      </div>
                      <div class="form-group row login-submit">
                        <div class="col-xs-12">
                          <input type="hidden" name="type" value="registerCustomer">
                          <button data-dismiss="modal" type="submit" class="btn btn-primary btn-xl">Kayıt Ol</button>
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
    <script src="assets/lib/jquery/jquery.min.js" type="text/javascript"></script>
    <script src="assets/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
    <script src="assets/js/main.js" type="text/javascript"></script>
    <script src="assets/lib/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="node_modules/sweetalert/dist/sweetalert.min.js" type="text/javascript"></script>
    <script type="text/javascript">
      $(document).ready(function(){
      	App.init();

        $(document).on('submit', 'form', function(event) {
          event.preventDefault();
          var action = $(this).attr('action');
          var method = $(this).attr('method');
          $.ajax({
            url: action,
            type: method,
            dataType: 'json',
            data: $(this).serialize()
          })
          .done(function(result){
            swal({
              title: result.t,
              text: result.m,
              icon: result.s,
              button: "OK",
            });
          })
          .fail(function() {
            swal("Oh noes!", "The request failed! Please, try again.", "error");
          });
        });
      });
    </script>
  </body>
</html>
