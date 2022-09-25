 <!-- footer content -->
        <footer>
          <div class="pull-right">
            Copyright &copy; <?php echo date('Y');?> 
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
		
	
	<!-- jQuery -->
    
   
	<!-- Bootstrap -->
    
	{!!Html::script('local/resources/assets/admin/vendors/bootstrap/dist/js/bootstrap.min.js')!!}
    <!-- FastClick -->
	{!!Html::script('local/resources/assets/admin/vendors/fastclick/lib/fastclick.js')!!}
    
    <!-- NProgress -->
    
	{!!Html::script('local/resources/assets/admin/vendors/nprogress/nprogress.js')!!}
    <!-- Chart.js -->
   
	{!!Html::script('local/resources/assets/admin/vendors/Chart.js/dist/Chart.min.js')!!}
    <!-- gauge.js -->
   
	{!!Html::script('local/resources/assets/admin/vendors/gauge.js/dist/gauge.min.js')!!}
    <!-- bootstrap-progressbar -->
   
	{!!Html::script('local/resources/assets/admin/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')!!}
    <!-- iCheck -->
    
	{!!Html::script('local/resources/assets/admin/vendors/iCheck/icheck.min.js')!!}
    <!-- Skycons -->
    
	{!!Html::script('local/resources/assets/admin/vendors/skycons/skycons.js')!!}
    <!-- Flot -->
    
	{!!Html::script('local/resources/assets/admin/vendors/Flot/jquery.flot.js')!!}
	{!!Html::script('local/resources/assets/admin/vendors/Flot/jquery.flot.pie.js')!!}
    {!!Html::script('local/resources/assets/admin/vendors/Flot/jquery.flot.time.js')!!}
    {!!Html::script('local/resources/assets/admin/vendors/Flot/jquery.flot.stack.js')!!}
    {!!Html::script('local/resources/assets/admin/vendors/Flot/jquery.flot.resize.js')!!}
    
    <!-- Flot plugins -->
   
	{!!Html::script('local/resources/assets/admin/vendors/flot.orderbars/js/jquery.flot.orderBars.js')!!}
	{!!Html::script('local/resources/assets/admin/vendors/flot-spline/js/jquery.flot.spline.min.js')!!}
	{!!Html::script('local/resources/assets/admin/vendors/flot.curvedlines/curvedLines.js')!!}
    
    <!-- DateJS -->
    
	{!!Html::script('local/resources/assets/admin/vendors/DateJS/build/date.js')!!}
    <!-- JQVMap -->
    
	{!!Html::script('local/resources/assets/admin/vendors/jqvmap/dist/jquery.vmap.js')!!}
	{!!Html::script('local/resources/assets/admin/vendors/jqvmap/dist/maps/jquery.vmap.world.js')!!}
	{!!Html::script('local/resources/assets/admin/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js')!!}
   
    <!-- bootstrap-daterangepicker -->
	{!!Html::script('local/resources/assets/admin/vendors/moment/min/moment.min.js')!!}
    
	{!!Html::script('local/resources/assets/admin/vendors/bootstrap-daterangepicker/daterangepicker.js')!!}
    

    <!-- Custom Theme Scripts -->
   	
	{!!Html::script('local/resources/assets/admin/build/js/custom.min.js')!!}
	
	
	{!!Html::script('local/resources/assets/admin/js/jquery.dataTables.min.js')!!}
	{!!Html::script('local/resources/assets/admin/js/dataTables.bootstrap.min.js')!!}
	{!!Html::script('local/resources/assets/admin/js/validator.js')!!}
	
	{!!Html::script('local/resources/assets/admin/js/canvasjs.min.js')!!}
	
    {!!Html::script('local/resources/assets/admin/js/custom.js')!!}
    
    {!!Html::script('local/resources/assets/js/tagsinput.js')!!}
    
     {!!Html::script('local/resources/assets/admin/fontscript/jquery.fontselect.js')!!}
     {!!Html::script('local/resources/assets/admin/fontscript/color.js')!!} 
     
     
     
     <script type="text/javascript">
	$("#select_all").change(function(){  //"select all" change 
    $(".checkboxy").prop('checked', $(this).prop("checked")); //change all ".checkboxy" checked status
});

//".checkboxy" change 
$('.checkboxy').change(function(){ 
    //uncheck "select all", if one of the listed checkbox item is unchecked
    if(false == $(this).prop("checked")){ //if this item is unchecked
        $("#select_all").prop('checked', false); //change "select all" checked status to false
    }
    //check "select all" if all checkbox items are checked
    if ($('.checkboxy:checked').length == $('.checkboxy').length ){
        $("#select_all").prop('checked', true);
    }
});


</script>
     
     
     