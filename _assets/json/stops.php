<?php 	require '../mkecore.php';
		$rt = "";
		$dir = "";
		$result = "Error: invalid entry";

		if(isset($_GET["rt"])){
			$rt = htmlspecialchars($_GET["rt"]);
		}

		if(isset($_GET["dir"])){
			$dir = strtoupper(htmlspecialchars($_GET["dir"]));
		}

		if ($rt != "" && $dir != ""){
			$bus = new MKEBus();
			$stops = $bus->getstops($rt, $dir);

			$result = $stops;
		}

		echo json_encode($result);

?>
