<?php
	require_once('../../inc/config/constants.php');
	require_once('../../inc/config/db.php');
	
	$ReorderDetailsSearchSql = 'SELECT * FROM reorder';
	$ReorderDetailsSearchStatement = $conn->prepare($ReorderDetailsSearchSql);
	$ReorderDetailsSearchStatement->execute();
	
	$output = '<table id="ReorderDetailsTable" class="table table-sm table-striped table-bordered table-hover" style="width:100%">
				<thead>
					<tr>
						<th>Reorder ID</th>
						<th>Item Number</th>
						<th>Item Name</th>
						<th>Maximum Sales </th>
						<th>Minimum Sales</th>
						<th>Average Sales</th>
						<th>Delivery Time</th>
						<th>Stock Threshold</th>
					</tr>
				</thead>
				<tbody>';
	
	// Create table rows from the selected data
	while($row = $ReorderDetailsSearchStatement->fetch(PDO::FETCH_ASSOC)){
		
		$output .= '<tr>' .
						'<td>' . $row['reorderID'] . '</td>' .
						'<td>' . $row['itemNumber'] . '</td>' .
						'<td>' . $row['maxSales'] . '</td>' .
						'<td>' . $row['minSales'] . '</td>' .
						'<td>' . $row['averageSales'] . '</td>' .
						'<td>' . $row['deliveryTime'] . '</td>' .
						'<td>' . $row['stockThreshold'] . '</td>' .
					'</tr>';
	}
	
	$ReorderDetailsSearchStatement->closeCursor();
	
	$output .= '</tbody>
					<tfoot>
						<tr>
							<th>Reorder ID</th>
						<th>Item Number</th>
						<th>Item Name</th>
						<th>Maximum Sales </th>
						<th>Minimum Sales</th>
						<th>Average Sales</th>
						<th>Delivery Time</th>
						<th>Stock Threshold</th>
						</tr>
					</tfoot>
				</table>';
	echo $output;
?>