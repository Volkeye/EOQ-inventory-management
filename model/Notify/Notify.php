<?php
	/*require_once('inc/config/constants.php');
	require_once('inc/config/db.php');

$sql = "SELECT * FROM item WHERE status = 'Active' ";
$query = $conn->query($sql);
$countProduct = $query->num_rows;
	
$lowStockSql = "SELECT * FROM item WHERE stock <= 2 AND status = 'Active' ";
$lowStockQuery = $conn->query($lowStockSql);
$countLowStock = $lowStockQuery->num_rows;
*/
?>

<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">  
   
  <style>
	body{
		margin:10px;
	}
	
.icon-button{
  position:relative;
  display:flex;
  align-items: center;
  justify-content: center;
  width: 20px;
  height: 20px;
  color: #ffffff;
  background: #000000;
  border: none;
  border-radius: 20%;
}

.icon-button:hover {
  cursor: pointer;
}

.icon-button:active {
  background: ##2FA4E7;
}

.icon-button__badge {
  position: absolute;
  top: -10px;
  right: -10px;
  width: 15px;
  height: 15px;
  background: red;
  color: #ffffff;
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: 50%;
}
	}
  </style>
  </head>
  <body>
  <!--navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
	<div class="container">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-3 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <button type="button" class="icon-button">
			<?php// echo $countLowStock; ?> 
			<span class="material-icons">notifications</span>
			<span class="icon-button__badge">0</span>
			</button>
			
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        </ul>
      
    </div>
  </div>
  </div>
</nav>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    
  </body>
</html>












