<?php
	require_once('../../inc/config/constants.php');
	require_once('../../inc/config/db.php');
	
	$itemNumber = htmlentities($_POST['reorderDetailsItemNumber']);
	
	if(isset($_POST['reorderDetailsItemNumber'])){
		
		// Check if mandatory fields are not empty
		if(!empty($itemNumber)){
			
			// Sanitize item number
			$itemNumber = filter_var($itemNumber, FILTER_SANITIZE_STRING);

			// Check if the item is in the database
			$reorderSql = 'SELECT itemNumber FROM reorder WHERE itemNumber=:itemNumber';
			$reorderStatement = $conn->prepare($reorderSql);
			$reorderStatement->execute(['itemNumber' => $itemNumber]);
			
			if($reorderStatement->rowCount() > 0){
				
				// reorder exists in DB. Hence start the DELETE process
				$deletereorderSql = 'DELETE FROM item WHERE itemNumber=:itemNumber';
				$deletereorderStatement = $conn->prepare($deletereorderSql);
				$deletereorderStatement->execute(['itemNumber' => $itemNumber]);

				echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Reorder deleted.</div>';
				exit();
				
			} else {
				// reorder does not exist, therefore, tell the user that he can't delete that reorder 
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>reorder does not exist in DB. Therefore, can\'t delete.</div>';
				exit();
			}
			
		} else {
			// Item number is empty. Therefore, display the error message
			echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter the item number</div>';
			exit();
		}
	}
?>