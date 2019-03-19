<?php
	require 'inc/db.php';

	if (isset($_GET['search'])) {
        $search_name = $_GET['search'];
        $sql = "SELECT * FROM searchs WHERE name like '%$search_name%'";
        $all_data = mysqli_query($conn, $sql);

    } else {
        $sql = "SELECT * FROM searchs";

        $all_data = mysqli_query($conn, $sql);
    }
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Live Search</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div class="container mt-5">
		<div class="row">
			<div class="col-12 col-md-8 mx-auto">
				<div class="card">
					<div class="card-header text-center ">
						New Page Search
					</div>
					<div class="card-body">
						<div class="search-box form-group">
					        <input type="text" class="form-control" placeholder="Search" id="search_box" value="<?= (isset($search_name)) ? $search_name : ''; ?>">
					        <div class="result bg-light text-dark my-1" id="result"></div>
				    	</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8 mx-auto">
				<div class="card mt-3">
					<table class="table table-bordered">
						<tr>
							<th>id</th>
							<th>name</th>
							<th>email</th>
							<th>phone</th>
						</tr>
						<?php foreach($all_data as $data): ?>
						<tr>
							<td><?php echo $data['id']; ?></td>
							<td><?php echo $data['name']; ?></td>
							<td><?php echo $data['email']; ?></td>
							<td><?php echo $data['phone']; ?></td>
						</tr>
						<?php endforeach; ?>
					</table>
				</div>
			</div>
		</div>
	</div>

    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
	<script>
		$(function(){
			// Variable for input box
			var search_box = $("#search_box");
			// result variable
			var result = $("#result");

		    $('#search_box').on("keyup input", function(){
		        /* Get input value on change */
		        var inputVal = $(this).val();
		        if(inputVal.length){
		            $.get("backend_search.php", {term: inputVal}).done(function(data){
		                // Display the returned data in browser
		                result.html(data);
		            });
		        } else{
		            result.empty();
		        }
		    });
		    
		    // Set search input value on click of result item
		    $(document).on("click", "#result ul li", function(){
		        search_box.val($(this).text());
		        result.empty();
		        var bro_url = window.location.pathname;
                var cre_url = bro_url + "?search=" + $(this).text();
                window.location.href = cre_url;
		    });
		});
	</script>
</body>
</html>