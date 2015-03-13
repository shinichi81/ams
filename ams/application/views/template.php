<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
      <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <link rel="shortcut icon" href="http://www.kompas.com/favicon.ico">
                  <title>KCM - Ads Management System</title>
                  <?php
                  echo css("theme.css");
                  echo css("style.css");
                  echo css("jquery-ui/jquery.ui.all.css");
                  echo css("jquery.fancybox-1.3.4.css");
                  echo js("jquery-1.7.1.min.js");
                  ?>
                  <!--[if IE]>
                  <?php echo css("ie-sucks.css"); ?>
                  <![endif]-->
      </head>
      <body>
            <?php
            $submenu = get_submenu($this->session->userdata("menu"), $menu);
            $menu = get_menu($menu);
            ?>
            <div id="container">
                  <div id="header">
                        <div class="left">
                              <img src="<?php echo image_path("logo_kcm.png"); ?>" title="Show" width="35" height="35" />
                        </div>
                        <div class="left ml_10">
                              <h2>KCM - Ads Management System</h2>
                              <h3>PT Kompas Cyber Media (Kompas.com)</h3>
                        </div>
                        <div class="right">
                              <h4>Selamat datang,</h4>
                              <h4><?php echo $this->session->userdata("name"); ?></h4>
                        </div>
                        <?php echo $menu; ?>
                  </div>
                  <div id="top-panel">
                        <?php echo $submenu; ?>
                  </div>
                  <div id="wrapper">
                        <div id="content">
                              <!-- s: content here -->
                              <?php $this->load->view($page); ?>
                              <!-- e: content here -->                
                        </div>
                  </div>
                  <div id="footer">&copy; 2008 - <?php echo date("Y"); ?> KOMPAS.com - All Rights Reserved</div>
            </div>
            <div id="confirmation" title="Konfirmasi"></div>
            <div id="show" title="Data Detail"></div>
            <?php
            echo js("ajax.min.js");
            echo js("jquery.mousewheel-3.0.4.pack.js");
            echo js("jquery.fancybox-1.3.4.pack.js");
            echo js("jquery-ui/jquery.ui.core.js");
            echo js("jquery-ui/jquery.ui.widget.js");
            echo js("jquery-ui/jquery.ui.mouse.js");
            echo js("jquery-ui/jquery.ui.button.js");
            echo js("jquery-ui/jquery.ui.draggable.js");
            echo js("jquery-ui/jquery.ui.position.js");
            echo js("jquery-ui/jquery.ui.resizable.js");
            echo js("jquery-ui/jquery.ui.dialog.js");

            // dashboard
            echo js("highcharts/highcharts.js");
            echo js("highcharts/modules/exporting.js");

            // order & order space & receive & request
            echo js("jquery-ui/jquery.ui.datepicker.js");
            echo js("jquery-ui/jquery.ui.autocomplete.js");

            // progress dan show dashboard
            echo js("jquery-ui/jquery.ui.slider.js");
            ?>

            <?php /* if ($this->uri->segment(1) <> "timeline" and $this->uri->segment(1) <> "calendar" and $this->uri->segment(1) <> "myaccount"): ?>
              <script type="text/javascript">
              $(document).ready(function() {
              // untuk proses submit di form
              $("#form").live("submit", function() {
              $('#button1').trigger('click');
              return false;
              });
              $('#button1').unbind('trigger');
              });
              </script>
              <?php endif; */ ?>

            <?php $this->load->view("javascript"); ?>
      </body>
</html>