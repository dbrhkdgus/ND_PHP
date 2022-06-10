<?php
echo '<div class="col-md-4 col-sm-4 mb">
<div class="grey-panel pn donut-chart">
  <div class="grey-header">
    <h5>SERVER LOAD</h5>
  </div>
  <canvas id="serverstatus01" height="120" width="120"></canvas>
  <script>
    var doughnutData = [{
        value: 70,
        color: "#FF6B6B"
      },
      {
        value: 30,
        color: "#fdfdfd"
      }
    ];
    var myDoughnut = new Chart(document.getElementById("serverstatus01").getContext("2d")).Doughnut(doughnutData);
  </script>
  <div class="row">
    <div class="col-sm-6 col-xs-6 goleft">
      <p>Usage<br/>Increase:</p>
    </div>
    <div class="col-sm-6 col-xs-6">
      <h2>21%</h2>
    </div>
  </div>
</div>
<!-- /grey-panel -->
</div>
<!-- /col-md-4-->
<div class="col-md-4 col-sm-4 mb">
<div class="darkblue-panel pn">
  <div class="darkblue-header">
    <h5>DROPBOX STATICS</h5>
  </div>
  <canvas id="serverstatus02" height="120" width="120"></canvas>
  <script>
    var doughnutData = [{
        value: 60,
        color: "#1c9ca7"
      },
      {
        value: 40,
        color: "#f68275"
      }
    ];
    var myDoughnut = new Chart(document.getElementById("serverstatus02").getContext("2d")).Doughnut(doughnutData);
  </script>
  <p>April 17, 2014</p>
  <footer>
    <div class="pull-left">
      <h5><i class="fa fa-hdd-o"></i> 17 GB</h5>
    </div>
    <div class="pull-right">
      <h5>60% Used</h5>
    </div>
  </footer>
</div>
<!--  /darkblue panel -->
</div>';
?>