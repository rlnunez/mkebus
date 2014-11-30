
<!DOCTYPE html>
<html lang="en" manifest="./cache.manifest">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MKE Realtime Bus Info</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="//cdn.leafletjs.com/leaflet-0.7.3/leaflet.css" />
    <link href="./_assets/css/ripples.min.css" rel="stylesheet">
    <link href="./_assets/css/material-wfont.min.css" rel="stylesheet">
	  <link href="./_assets/css/customizations.css" rel="stylesheet">
    <link href="//fezvrasta.github.io/snackbarjs/dist/snackbar.min.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

<nav class="slide-menu">
    <i class='close-slide mdi-navigation-arrow-back'></i> 
    <h1 class="navbar-brand text-primary">Menu</h1>
    <hr />
    <ul>
        <li><a href="#" class='alt-close-slide' data-toggle='modal' data-target="#about-popup">About</a></li>
        <li><a href="https://github.com/rlnunez/mkebus/issues" class='alt-close-slide' target="_blank">Feedback</a></li>
    </ul>
    <div class="bottom-menu-holder">
    <hr />
    <ul class="bottom-menu">
        <!--<li><a href="#"><i class="mdi-action-settings"></i> Settings</a></li>-->
        <li>Version 0.2</li>
    </ul>
    </div>
</nav><!-- /slide menu left -->

    <div class="navbar navbar-primary navbar-static-top" role="navigation">
      <div class="navbar-header">
          <button type="button" class="toggle-slide">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
          </button>
          <h1 class="navbar-brand" >MKE Bus</h1>
          <h2 class="navbar-brand bus-des-info"></h2>
        </div>
        <ul class="nav navbar-nav navbar-right">
          <li>
            <a type="button" class="close close-info" aria-hidden="true">×</a>
          </li>
        </ul>
      </div>
    </div>
	<div id='info-container'>
		<div class="spacer10" id="map" style="height: 350px"></div>
		<div class="col-md-5">ETA to your Destination <select id="eta-select"></select></div>
		<div class="col-md-7"><h3 id="eta-time" class="eta-time"></h3></div>
    <div class="clear clearfix"></div>
    <hr />
	</div>
    <div class="container">

		<div class="list-group"></div>
                <!-- Stop Info by Number -->
                <div class="modal fade" id="modal-stop-number" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                              <h4 class="modal-title">Stop Predictions</h4>
                          </div>
                          <div class="modal-body">
              							<form class="navbar-form form-inline" id="bus-predict" role="search" method="get" action="./">
              							    <div class="form-group">
              							    	<input type="number" class="form-control empty" id="stid" name="stid" min="1" max="9999" placeholder="Stop#">
              							    </div>
              							    <div class="form-group">
              							    	<select class="form-control" id="rt" class='slt-rt' name="rt"></select>
              							    </div>
              							    <div class="form-group">
              							    	<button type="submit" class="btn btn-primary btn-raised btn-xs" id="bus-predict-btn" data-dismiss="modal">Get Predictions</button>
              								</div>
              							</form>
                          </div>
                          <div class="modal-footer">
                          </div>
                      </div>
                  </div>
                </div>

                <!-- Stop Info by Route Info -->
                <div class="modal fade" id="modal-bus-rt" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                              <h4 class="modal-title">Route Predictions</h4>
                          </div>
                          <div class="modal-body">
                            <form class="navbar-form form-inline" id="bus-rt" role="search" method="get" action="./">
                              <div class="form-group">
                                <select class="form-control" class='slt-rt' id='bus-rt-num' name="bus-rt-num"></select>
                              </div>
                              <div class='form-group'>
                                <select class="form-control" id='rt-dir'></select>
                              </div>
                              <div class='form-group'>
                                <select class="form-control" id='rt-stop'></select>
                              </div>
                              <div class='form-group'>
                                  <button type="submit" class="btn btn-primary btn-raised btn-xs" id="rt-predict-btn" data-dismiss="modal">Get Predictions</button>
                              </div>
                            </form>
                          </div>
                          <div class="modal-footer">
                          </div>
                      </div>
                  </div>
                </div>

                <!-- Bus Search by VID -->
                <div class="modal fade" id="modal-vid-info" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                              <h4 class="modal-title">Bus ID Search</h4>
                          </div>
                          <div class="modal-body">
                            <form class="navbar-form form-inline" id="bus-vid-ind" role="search" method="get" action="./">
                                <div class="form-group">
                                  <input type="number" class="form-control empty" id="vid-num" name="vid-num" min="1" max="9999" placeholder="Bus ID ">
                                  <button type="submit" class="btn btn-primary btn-raised btn-xs" id="vid-btn" data-dismiss="modal">Get Vehicle Info</button>
                              </div>
                            </form>
                          </div>
                          <div class="modal-footer">
                          </div>
                      </div>
                  </div>
                </div>

                <!-- About -->
                <div class="modal fade" id="about-popup" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                              <h4 class="modal-title">About</h4>
                          </div>
                          <div class="modal-body">
                            <p>This is a random side project by <a href='http://rlnunez.com'>Rob Nunez</a>. Thanks to <a href='http://fezvrasta.github.io/bootstrap-material-design/'>@FezVrasta</a> for the Material Design addon to Bootstrap.</p>
                            <p>The offical MCTS RealTime site is located at <a href="http://realtime.ridemcts.com/">realtime.ridemcts.com</a></p>
                          </div>
                          <div class="modal-footer">
                          </div>
                      </div>
                  </div>
                </div>

    <div id="loadingSpinner" ><i class="mdi-action-autorenew loading-icon"></i> Loading...</div>
   <!-- <a class="btn btn-primary btn-fab btn-raised mdi-maps-directions-bus btn-bus-fab" id="btn-bus-vid" data-placement="left" title="" data-original-title="Search by Bus ID" data-toggle-beta="tooltip" data-toggle='modal' data-target="#modal-vid-info"></a>-->
    <a class="btn btn-warning btn-fab btn-raised mdi-maps-local-movies btn-bus-fab" id="btn-bus-route" data-placement="left" title="" data-original-title="Search by Route Info" data-toggle-beta="tooltip" data-toggle='modal' data-target="#modal-bus-rt"></a>
    <a class="btn btn-danger btn-fab btn-raised mdi-action-view-quilt btn-bus-fab" id="btn-bus-stop-num" data-placement="left" title="" data-original-title="Search by Stop Number" data-toggle-beta="tooltip" data-toggle='modal' data-target="#modal-stop-number"></a>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>
    <script src="//fezvrasta.github.io/snackbarjs/dist/snackbar.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/noUiSlider/6.2.0/jquery.nouislider.min.js"></script>
    <script src="./_assets/js/ripples.min.js"></script>
    <script src="./_assets/js/material.min.js"></script>
    <script src="./_assets/js/typed.js"></script>


    <script src="./_assets/js/slide-menu.js"></script>
    <script src="./_assets/js/global-vars.js"></script>
    <script src="./_assets/js/getroutes.js"></script>
    <script src="./_assets/js/predict-list.js"></script>
    <script src="./_assets/js/osm.js"></script>
    <script src="./_assets/js/eta.js"></script>
    <script src="./_assets/js/getdirections.js"></script>
    <script src="./_assets/js/getstops.js"></script>
    <script src="./_assets/js/vid-info.js"></script>
    <script src="./_assets/js/extrainfo.js"></script>

        <script>
            $(function() {
                $.material.init();
                $('[data-toggle-beta="tooltip"]').tooltip();
                $('#loadingSpinner, .close-info').hide();
            });


        </script>
    <script src="./_assets/js/appCache.js"></script>
  </body>
</html>


