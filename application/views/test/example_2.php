<!DOCTYPE html>

<html lang="en">

<head>

	<meta charset="UTF-8">

	<title>Datatable - Search By Column</title>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">

	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">

</head>

<body>

	<div class="container">

		<div class="row justify-content-md-center">

			<div class="col-8">

				<div class="text-muted">

					Advanced Search

				</div>

				<div class="row">

					<div class="col-md-5">

						<select class="form-control" id="select-column">

							<option value="0">ID</option>

							<option selected value="1">Name</option>

							<option value="2">Email</option>

						</select>

					</div>

					<div class="col-md-7">

						<input class="form-control" type="text" id="search-by-column" placeholder="Search By Column">

					</div>

				</div>

			</div>

		</div>

		<table id="example" class="table table-striped table-bordered" style="width:100%">

			<thead>

				<tr>

					<th>ID</th>

					<th>Name</th>

					<th>Email</th>

				</tr>

			</thead>

			<tbody>

				<tr>

					<td>1</td>

					<td>Demo Name</td>

					<td>demo1@gmail.com</td>

				</tr>

				<tr>

					<td>2</td>

					<td>Sample Name</td>

					<td>demo2@gmail.com</td>

				</tr>

				<tr>

					<td>3</td>

					<td>Example Name</td>

					<td>example@gmail.com</td>

				</tr>

			</tbody>

		</table>

	</div>

	<div class="container">
		<button onclick="javascript:if(confirm('Are you sure to reload page?')) { location = location; } else { window.close(); } ">CLick this?</button>
		<a onclick="javascript:if(confirm('Are you sure to reload page?')) { window.open('../employee/delete/180618'); }">CLick this?</a>
	</div>

	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>

	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

	<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

	<script>

		$(document).ready(function() {

			function searchByColumn(table) {

				var defaultSearch = 1 //Name

				$(document).on('change keyup', '#select-column', function() {

					defaultSearch = this.value;

				});

				$(document).on('change keyup', '#search-by-column', function() {

					table.search('').columns().search('').draw();

					table.column(defaultSearch).search(this.value).draw();

				});

			}

		    var table = $('#example').DataTable();

		    searchByColumn(table);

		} );

	</script>

</body>

</html>