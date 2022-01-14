<?php
require_once('inc/config/constants.php');
require_once('inc/config/db.php');
	
if(isset($_POST['reorderDetailsItemNumber'])){

	$itemNumber = htmlentities($_POST['reorderDetailsItemNumber']);
	$itemName = htmlentities($_POST['reorderDetailsItemName']);
	$maxSales = htmlentities($_POST['reorderDetailsMaximumSales']);
	$minSales = htmlentities($_POST['reorderDetailsMinimumSales']);
	$averageSales = htmlentities($_POST['reorderDetailsAverageSales']);
	$deliveryTime = htmlentities($_POST['reorderDetailsDeliveryTime']);
	$stockThreshold = htmlentities($_POST['reorderDetailsStockThreshold']);
	
	// Check if mandatory fields are not empty
		if(!empty($itemNumber)  && isset($maxSales) && isset($minSales) && isset($deliveryTime)){
			
			// Sanitize item number
			$itemNumber = filter_var($itemNumber, FILTER_SANITIZE_STRING);
			
			// Validate maximum sales . It has to be a number
			if(filter_var($maxSales, FILTER_VALIDATE_INT) === 0 || filter_var($maxSales, FILTER_VALIDATE_INT)){
				// Valid max sale
			} else {
				// max sle is not a valid number
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid number for maximum sales</div>';
				exit();
			}
			// Validate Minimum sales . It has to be a integer 
			if(filter_var($minSales, FILTER_VALIDATE_INT) === 0 || filter_var($minSales, FILTER_VALIDATE_INT)){
				// Valid min sale
			} else {
				// Min sales is not a valid number
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid number for minimum sales</div>';
				exit();
			}
			// Check if itemNumber is empty
			if($itemNumber == ''){ 
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter Item Number.</div>';
				exit();
			}
			// Check if max sales is empty
			if($maxSales == ''){ 
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter maximum sales amount.</div>';
				exit();
			}
			// Check if min sales is empty
			if($minSales == ''){ 
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a minimum sale amount.</div>';
				exit();
			}
			// Check if delivery time is empty
			if($deliveryTime == ''){ 
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter delivery time (days).</div>';
				exit();
			}
// Calculate the stock values
			$stockSql = 'SELECT stock FROM item WHERE itemNumber = :itemNumber';
			$stockStatement = $conn->prepare($stockSql);
			$stockStatement->execute(['itemNumber' => $itemNumber]);
			if($stockStatement->rowCount() > 0){
				// Item exits in DB, therefore, can proceed to a sale
				$row = $stockStatement->fetch(PDO::FETCH_ASSOC);
				$currentQuantityInItemsTable = $row['stock'];
				
				if($currentQuantityInItemsTable <= $stockThreshold) {
					// If currentQuantityInItemsTable is <= $stockThreshold , stock is at threshold that means we have to reorder to cater for delivery time.
					echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Stock is at THRESHOLD! . Therefore you need to reorder this item .</div>';
					exit();
				} elseif ($currentQuantityInItemsTable > $stockThreshold) {
					// if stock is  > than set threshold. 
					echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Stock is in good levels !.</div>';
					exit();
				}
			if($currentQuantityInItemsTable <= $stockThreshold){
				
			// INSERT data to reorder table
						$insertreorderSql = 'INSERT INTO reorder(itemNumber, itemName, maxSales, minSales, averageSales, deliveryTime, stockThreshold) VALUES(:itemNumber, :itemName, :maxSales, :minSales, :averageSales, :deliveryTime, :stockThreshold, )';
						$insertreorderStatement = $conn->prepare($insertreorderSql);
						$insertreorderStatement->execute(['itemNumber' => $itemNumber, 'itemName' => $itemName, 'maxSales' => $maxSales, 'minSales' => $minSales, 'averageSales' => $averageSales, 'deliveryTime' => $deliveryTime, 'stockThreshold' => $stockThreshold, ]);
					echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>reorder details added to DB .</div>';
						exit();
						
					}
					
			else {
				echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>current stock greater than threshold.</div>';
				exit();
	
			 }
			}
		}
}
	
?>