<?php
	require_once('../../inc/config/constants.php');
	require_once('../../inc/config/db.php');

	// Execute the script if the POST request is submitted
	if(isset($_POST['reorderDetailsReorderID'])){
		
		$reorderID = htmlentities($_POST['reorderDetailsReorderID']);
		
		$reorderDetailsSql = 'SELECT * FROM reorder WHERE reorderID = :reorderID';
		$reorderDetailsStatement = $conn->prepare($reorderDetailsSql);
		$reorderDetailsStatement->execute(['reorderID' => $reorderID]);
		
		// If data is found for the given reorder id, return it as a json object
		if($reorderDetailsStatement->rowCount() > 0) {
			$row = $reorderDetailsStatement->fetch(PDO::FETCH_ASSOC);
			echo json_encode($row);
		}
		$reorderDetailsStatement->closeCursor();
	}
?>