<?php
  error_reporting( E_ALL );
  ini_set( "display_errors", 1 );
  include_once('./header.php');
?>

<section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12 main-chart">
            <!--CUSTOM CHART -->
              <?php include_once('user_visits_chart.php') ?>
            <div class="row mt" style="margin-bottom: 9%;">
              <!-- SERVER STATUS PANELS -->
              <?php include_once('server_status.php') ?>
              
              <div class="col-md-4 col-sm-4 mb">
                <!-- REVENUE PANEL -->
                <?php include_once('revenue.php') ?>
              </div>

            </div>

          </div>

          <!-- /col-lg-3 -->
        </div>
        <!-- /row -->
      </section>
    </section>
    <!--main content end-->
    <!--footer start-->
    <footer class="site-footer">
      <div class="text-center">
        <p>
          &copy; Copyrights <strong>Dashio</strong>. All Rights Reserved
        </p>
        <div class="credits">
          <!--
            You are NOT allowed to delete the credit link to TemplateMag with free version.
            You can delete the credit link only if you bought the pro version.
            Buy the pro version with working PHP/AJAX contact form: https://templatemag.com/dashio-bootstrap-admin-template/
            Licensing information: https://templatemag.com/license/
          -->
          Created with Dashio template by <a href="https://templatemag.com/">TemplateMag</a>
        </div>
        <a href="index.html#" class="go-top">
          <i class="fa fa-angle-up"></i>
          </a>
      </div>
    </footer>
    <!--footer end-->
  </section>

<?php include_once('./footer.php') ?>