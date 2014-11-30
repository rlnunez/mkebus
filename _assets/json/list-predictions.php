<?php 	require '../mkecore.php';
		$stid = "";
		$rt = "";

		$result = "<div class='alert alert-dismissable alert-warning'><h4>Error</h4><p>Invalid Bus Stop Number/Route Number</p></div>";
		$masterArray = array();

		if(isset($_GET["stid"])){
			$stid = htmlspecialchars($_GET["stid"]);
		}
		if(isset($_GET["rt"])){
			$rt = htmlspecialchars($_GET["rt"]);
		}

		if ($stid != ""){
			$bus = new MKEBus();
			$predictions = $bus->getpredictions($stid, $rt);

			if(isset($predictions['prd'])) {
				foreach ($predictions['prd'] as $predict) {
					$note = "";
					$temphtml = "";
				    $bg = "btn-primary";
				    if ($predict['dly']){
				      $bg = "btn-danger";
				    } elseif($predict['vid'] == "") {
				      $bg = "btn-info";
				      $note = "Planned Arrival";
				    }  

				    $Arriving = "Arriving";
				    if($predict['prdctdn'] != "DUE"){
				        $Arriving = $predict['prdctdn'] . " Minutes";
				        if (strtoupper($predict['prdctdn']) == "DLY"){
				          $Arriving = "Delayed";
				        } //end if strtoupper($predict['prdctdn']) == "DLY"
				    } //end if $predict['prdctdn'] != "DUE"
								

				    $temphtml .= "<div class='list-group-item'>";
				    if ($predict['vid'] != "") {
				    	$temphtml .= "<a class='btn btn-flat btn-default no-padding btn-rt' data-vid='" . utf8_encode($predict['vid']) . "' data-rt='" . utf8_encode($predict['rt']) . "' data-des='" . utf8_encode($predict['des']) . "''>";
				    }
				    $temphtml .= "<div class='row-action-primary'>";
				    $temphtml .= "<h2 class='circle " . utf8_encode($bg) . "'>" . utf8_encode($predict['rt']) . "</h2>";
				    $temphtml .= "</div>";
				    $temphtml .= "<div class='row-content'>";
				    $temphtml .= "<h4 class='list-group-item-heading'>" . utf8_encode($predict['des']) . "</h4>";
				    $temphtml .= "<p class='list-group-item-text'>" . utf8_encode($Arriving) . "<br />" . utf8_encode($note) . "</p>";
				    $temphtml .= "<div class='least-content'>";
				    $temphtml .= "</div>";
				    $temphtml .= "</div>";
				    if ($predict['vid'] != ""){
				    	$temphtml .= "</a>";
				    }
				    $temphtml .= "</div>";
				    $temphtml .= "<div class='list-group-separator'></div>";

				   // $temphtml = htmlentities($temphtml);

				    // push this prediction into the main array;
				    array_push($masterArray, $temphtml);

				} //end foreach (predictions->prd)
			} //end if isset($predictions['prd'])
			if (count($masterArray) > 0){
				$result = $masterArray;
			} else {
				array_push($masterArray, $result);
				$result = $masterArray;
			}
			
		} // end if $stid != ""


		echo json_encode($result);

?>