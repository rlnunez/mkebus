<?php 	require '../mkecore.php';
		$vid = "";
		$currentstop = "";
		$result = "Error: invalid entry";

		if(isset($_GET["vid"])){
			$vid = htmlspecialchars($_GET["vid"]);
		}

		if(isset($_GET["currentstop"])){
			$currentstop = htmlspecialchars($_GET["currentstop"]);
		}

		if ($vid != ""){
			$bus = new MKEBus();
			$vehicle = $bus->getvehicles($vid);
			$pid = $vehicle['pid'];
			$stops = $bus->getpatterns($pid);
			$futurestops = array();
			$myStop = false;

			if ($currentstop == '') {
				$myStop = true;
			}

			foreach ($stops['pt'] as $stop) {
				if($stop['typ'] == "S" && ($stop['stpid'] == $currentstop || $myStop == true)){
					$myStop = true;
					array_push($futurestops, $stop);
				}
			}
			array_pop($futurestops);
			$result = $futurestops;
		}

		echo json_encode($result);

?>
