<?php 

include 'connect2.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Order Details</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
	<style type="text/css">
		body {
			background-color: #f8f9fa;
		}
		.header, .footer {
			background-color:blue; /* Seafoam background */
			color: #ffffff;
			padding: 15px;
			text-align: center;
		}
		.footer {
			margin-top: 20px;
		}
		a {
			text-decoration: none;
		}
	</style>
</head>
<body>
	<!-- Header -->
	<div class="header">
		<h2>Order Status</h2>
		<p>View your order and status using contact number, food, category, or name</p>
	</div>

	<div class="container my-4">
		<!-- Navigation Buttons -->
		<div class="mb-3">
			<button class="btn btn-success"><a href="./">Home</a></button>
		</div>

		<!-- Search Form -->
		<form method="GET" class="mb-4">
			<div class="form-group">
				<label for="searchContact">Search by Contact:</label>
				<input type="text" class="form-control" id="searchContact" name="search_contact" placeholder="Enter contact number">
			</div>
			<div class="form-group">
				<label for="searchFood">Search by Food:</label>
				<input type="text" class="form-control" id="searchFood" name="search_food" placeholder="Enter food name">
			</div>
			
			<div class="form-group">
				<label for="searchName">Search by Customer Name:</label>
				<input type="text" class="form-control" id="searchName" name="search_name" placeholder="Enter customer name">
			</div>
			<button type="submit" class="btn btn-primary">Search</button>
		</form>

		<!-- Table (Visible only after search) -->
		<?php 
		$search_contact = isset($_GET['search_contact']) ? $_GET['search_contact'] : '';
		$search_food = isset($_GET['search_food']) ? $_GET['search_food'] : '';
		$search_category = isset($_GET['search_category']) ? $_GET['search_category'] : '';
		$search_name = isset($_GET['search_name']) ? $_GET['search_name'] : '';

		// Building the SQL query
		$conditions = [];
		if (!empty($search_contact)) $conditions[] = "customer_contact LIKE '%$search_contact%'";
		if (!empty($search_food)) $conditions[] = "food LIKE '%$search_food%'";
		if (!empty($search_category)) $conditions[] = "category LIKE '%$search_category%'";
		if (!empty($search_name)) $conditions[] = "customer_name LIKE '%$search_name%'";

		if (!empty($conditions)) {
			$sql = "SELECT * FROM tbl_order WHERE " . implode(' OR ', $conditions);
			$result = mysqli_query($conn, $sql);

			echo '<table class="table mt-4">
				<thead class="thead-dark">
					<tr>
						<th scope="col">No</th>
						<th scope="col">Food</th>
						<th scope="col">Category</th>
						<th scope="col">Price</th>
						<th scope="col">Quantity</th>
						<th scope="col">Total</th>
						<th scope="col">Order Date</th>
						<th scope="col">Status</th>
						<th scope="col">Customer Name</th>
						<th scope="col">Contact</th>
						<th scope="col">Email</th>
						<th scope="col">Address</th>
					</tr>
				</thead>
				<tbody>';

			if ($result && mysqli_num_rows($result) > 0) {
				while ($row = mysqli_fetch_assoc($result)) {
					$id = $row['id'];
					$food = $row['food'];
					$category = isset($row['category']) ? $row['category'] : 'N/A';
					$price = $row['price'];
					$qty = $row['qty'];
					$total = $row['total'];
					$order_date = $row['order_date'];
					$status = $row['status'];
					$customer_name = $row['customer_name'];
					$customer_contact = $row['customer_contact'];
					$customer_email = $row['customer_email'];
					$customer_address = $row['customer_address'];

					echo '<tr>
						<th scope="row">'.$id.'</th>
						<td>'.$food.'</td>
						<td>'.$category.'</td>
						<td>'.$price.'</td>
						<td>'.$qty.'</td>
						<td>'.$total.'</td>
						<td>'.$order_date.'</td>
						<td>'.$status.'</td>
						<td>'.$customer_name.'</td>
						<td>'.$customer_contact.'</td>
						<td>'.$customer_email.'</td>
						<td>'.$customer_address.'</td>
					</tr>';
				}
			} else {
				echo '<tr><td colspan="12" class="text-center">No records found</td></tr>';
			}

			echo '</tbody>
			</table>';
		}
		?>
	</div>

	<!-- Footer -->
	<div class="footer">
		<p>&copy; 2025 Food Order.</p>
	</div>
</body>
</html>
