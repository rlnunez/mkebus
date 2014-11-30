<?php 	require '../mkecore.php';
		$bus = new MKEBus();
		$routes = $bus->getroutes();
		$result = $routes['bustime-response']['routes'];
		echo json_encode($result);
?>
