</div>



<!-- Footer Start-->

<div class="footer-copyright-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="footer-copy-right">
                    <p>Copyright &#169; {{date('Y')}} EOS All rights reserved.</a>.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End-->

<!-- jquery
============================================ -->
<script src="{{url('admin_design')}}/js/vendor/jquery-1.11.3.min.js"></script>
<!-- bootstrap JS
============================================ -->
<script src="{{url('admin_design')}}/js/bootstrap.min.js"></script>
<!-- meanmenu JS
============================================ -->
<script src="{{url('admin_design')}}/js/jquery.meanmenu.js"></script>
<!-- mCustomScrollbar JS
============================================ -->
<script src="{{url('admin_design')}}/js/jquery.mCustomScrollbar.concat.min.js"></script>
<!-- sticky JS
============================================ -->
<script src="{{url('admin_design')}}/js/jquery.sticky.js"></script>
<!-- scrollUp JS
============================================ -->
<script src="{{url('admin_design')}}/js/jquery.scrollUp.min.js"></script>
<!-- counterup JS
============================================ -->
<script src="{{url('admin_design')}}/js/counterup/jquery.counterup.min.js"></script>
<script src="{{url('admin_design')}}/js/counterup/waypoints.min.js"></script>
<!-- peity JS
============================================ -->
<script src="{{url('admin_design')}}/js/peity/jquery.peity.min.js"></script>
<script src="{{url('admin_design')}}/js/peity/peity-active.js"></script>
<!-- sparkline JS
============================================ -->
<script src="{{url('admin_design')}}/js/sparkline/jquery.sparkline.min.js"></script>
<script src="{{url('admin_design')}}/js/sparkline/sparkline-active.js"></script>


<!-- data table JS
============================================ -->
<script src="{{url('admin_design')}}/js/data-table/bootstrap-table.js"></script>
<script src="{{url('admin_design')}}/js/data-table/tableExport.js"></script>
<script src="{{url('admin_design')}}/js/data-table/data-table-active.js"></script>
<script src="{{url('admin_design')}}/js/data-table/bootstrap-table-editable.js"></script>
<script src="{{url('admin_design')}}/js/data-table/bootstrap-editable.js"></script>
<script src="{{url('admin_design')}}/js/data-table/bootstrap-table-resizable.js"></script>
<script src="{{url('admin_design')}}/js/data-table/colResizable-1.5.source.js"></script>
<script src="{{url('admin_design')}}/js/data-table/bootstrap-table-export.js"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<!-- main JS
============================================ -->
<script src="{{url('admin_design')}}/js/main.js"></script>
<script>
  $( function() {
    $( "#datepicker" ).datepicker({
			dateFormat: 'yy-mm-dd',
			changeMonth: true,
			changeYear: true,
		});
  } );
  </script>

@stack('adminjs')

</body>

</html>