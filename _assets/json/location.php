<?php 	require '../mkecore.php';
		$vid = "";
		$result = "Error: invalid entry";

		if(isset($_GET["vid"])){
			$vid = htmlspecialchars($_GET["vid"]);
		}

		if ($vid != ""){
			$bus = new MKEBus();
			$vinfo = $bus->getvehicles($vid);
			if (isset($vinfo)){
				$result = $vinfo;
			}
		}

		echo json_encode($result);;

?>
