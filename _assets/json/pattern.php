<?php 	require '../mkecore.php';
		$pid = "";
		$result = "Error: invalid entry";

		if(isset($_GET["pid"])){
			$pid = htmlspecialchars($_GET["pid"]);
		}

		if ($pid != ""){
			$bus = new MKEBus();
			$patterns = $bus->getpatterns($pid);

			$result = $patterns;
		}

		echo json_encode($result);

?>
