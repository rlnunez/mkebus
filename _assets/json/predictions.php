<?php 	require '../mkecore.php';
		$stid = "";
		$rt = "";
		$result = "Error: invalid entry";

		if(isset($_GET["stid"])){
			$stid = htmlspecialchars($_GET["stid"]);
		}
		if(isset($_GET["rt"])){
			$rt = htmlspecialchars($_GET["rt"]);
		}

		if ($stid != ""){
			$bus = new MKEBus();
			$predictions = $bus->getpredictions($stid, $rt);
			$result = $predictions;
		}

		echo json_encode($result);;

?>
