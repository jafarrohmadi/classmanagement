<style type="text/css">
	.table1 {
	    font-family: sans-serif;
	    color: #444;
	    border-collapse: collapse;
	    width: 100%;
	    border: 1px solid #f2f5f7;
	}
	 
	.table1 tr th{
	    background: #35A9DB;
	    color: #fff;
	    font-weight: normal;
	}
	 
	.table1, th, td {
	    padding: 8px 20px;
	}
	 
	.table1 tr:hover {
	    background-color: #f5f5f5;
	}
	 
	.table1 tr:nth-child(even) {
	    background-color: #f2f2f2;
	}
	span 
	{
	    display: block;
	}
</style>

<div class="container">
	<br/>
	<h1 style="text-align: center;">Lists all the Classrooms</h1>
	<table class="table1">
		<tr>
			<th>No</th>
			<th>Class</th>
			<th>Teacher</th>
			<th>Students</th>
		</tr>

		@foreach ($allclass as $key => $class)
		<tr>
			<td>{{ ++$key }}</td>
			<td>{{ $class->name}}</td>
			<td>{{ $class->teacher->name }}</td>
			@if(count($class->students) > 0)
				<td>
					@foreach($class->students as $students)
					<span>- {{ $students->name }} </span>
					@endforeach
				</td>
			@else
				<td> No Students </td>
			@endif
		</tr>
		@endforeach
	</table>
</div>