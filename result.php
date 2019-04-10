<?php

?>

<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<style type="text/css">
    .table-body tr{
        border-color: black;
        border-width: thin;
        border-style: solid;
        collapse:false;
    }
</style>

</head>
<body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


<div class="row">
	<p class="col-xl-12" style="text-align: center">Ad Website</p>
</div>
<div class="row">
	<button class="col-xl-12 btn btn-primary" style="position: fixed" data-toggle="collapse" data-target="#menu">MENU</button>
</div>

<div id="menu" class="collapse button-group row">
	<button class="btn btn-primary">Francais</button>
	<button class="btn btn-primary">English</button>
	<button class="btn btn-primary">Register</button>
	<button class="btn btn-primary">Post Ad</button>
</div>
<br/>
<br/>
<br/>
<div class="mx-auto">
<ul class="pagination">
	<li class="page-item"><a class="page-link" href="#">first</a></li>
	<li class="page-item"><a class="page-link" href="#">1</a></li>
	<li class="page-item"><a class="page-link" href="#">2</a></li>
	<li class="page-item"><a class="page-link" href="#">last</a></li>
</ul>
</div>

<table class="table-hover table-stripped" width="100%" id="tableResult">
<thead class="table-primary">
	<tr>
		<th>header_1</th>
		<th>header_2</th>
		<th>header_3</th>
		<th>header_4</th>
		<th>header_5</th>
	</tr>
	</thead>
	<tbody class="table-body">
	<tr>
		<td>1</td>
		<td>2</td>
		<td>3</td>
		<td>4</td>
		<td>5</td>
	</tr>
	<tr>
		<td>6</td>
		<td>7</td>
		<td>8</td>
		<td>9</td>
		<td>10</td>
	</tr>
	<tr>
		<td>11</td>
		<td>12</td>
		<td>13</td>
		<td>14</td>
		<td>15</td>
	</tr>
	</tbody>
</table>
</body>

</html>