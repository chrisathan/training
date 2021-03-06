<!doctype html>
<html>
	<head>
		<title>View project</title>
	</head>
	<body>
		<b><h1>View project</h1></b>
		<div class="content">
			<form class="" action="{{ route('projects.index') }}" method="get">
				
				@csrf

				<div>
					Name:<br>
					<input type="text" name="name" value="{{ $project->name }}" readonly>
				</div>

				<div>
					<br>Customer:<br>
					<input type="text" name="customer" value="{{App\Customer::find($project->customer_id)->first_name}} {{App\Customer::find($project->customer_id)->last_name}}" readonly>
				</div>

				<div>
					<br>Start date:<br>
					<input type="date" name="start_date" value="{{ $project->start_date }}" readonly>
				</div>

				<div>
					<br>End date:<br>
					<input type="date" name="end_date" value="{{ $project->end_date }}" readonly>
				</div>

				<div>
					<br>Active:<br>
						@if ($project->active == 1)
							<input type="text" value="Yes" readonly>
						@else
							<input type="text" value="No" readonly>
						@endif	
				</div>

				<div>
					<br>Budget:<br>
					<input type="text" name="budget" value="{{ $project->budget }}" readonly>
				</div>

				<div>
					<br>Description:<br> 
					<textarea rows="6" cols="21" name="description" readonly>
						{{ $project->description }}
					</textarea>
				</div>

				<div>
					<br>Created at:<br>
					{{ $project->created_at->format('m/d/Y') }}
				</div>

				<div>
					<br>Updated at:<br>
					{{ $project->updated_at->format('m/d/Y') }}
				</div>

				<div>
					<br>
					<button type="submit" name="button">Return</button>
					
				</div>
			</form>
		</div>	
	</body>	
</html>	