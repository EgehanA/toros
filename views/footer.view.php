<script src="assets/lib/jquery/jquery.min.js" type="text/javascript"></script>
<script src="node_modules/sweetalert/dist/sweetalert.min.js" type="text/javascript"></script>
<script src="assets/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
<script src="assets/js/main.js" type="text/javascript"></script>
<script src="assets/lib/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/lib/fuelux/js/wizard.js" type="text/javascript"></script>
<script src="assets/lib/select2/js/select2.min.js" type="text/javascript"></script>
<script src="assets/lib/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="assets/lib/bootstrap-slider/js/bootstrap-slider.js" type="text/javascript"></script>
<script src="assets/js/app-form-wizard.js" type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function(){
    App.init();
    $(document).on('submit', 'form[data-xhr]', function(event) {
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
        var options = {
          title:    result.t,
          text:     result.m,
          icon:     result.s,
          button:  "OK"
        };
        if(result.r != null){
          options['timer']   = 3000;
          options['button']  = false;
          options['closeOnClickOutside ']   = false;
          options['closeOnEsc']             = false;
          setTimeout(function(){
            window.location.assign(result.r);
          }, 3000);
        }
        swal(options);
      })
      .fail(function() {
        swal("Oh noes!", "The request failed! Please, try again.", "error");
      });
    });
  });
</script>
<?php echo isset($appendFooter)?$appendFooter:null; ?>
</body>
</html>
