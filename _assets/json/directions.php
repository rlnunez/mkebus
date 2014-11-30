<?php 	require '../mkecore.php';
		$rt = "";
		$result = "Error: invalid entry";

		if(isset($_GET["rt"])){
			$rt = htmlspecialchars($_GET["rt"]);
		}

		if ($rt != ""){
			$bus = new MKEBus();
			$directions = $bus->getdir($rt);
			if (isset($directions)){
				$result = $directions;
			}
		}

		echo json_encode($result);;

?>
