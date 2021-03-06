<!doctype html>
<html>
	<head>
		<title>New project</title>
	</head>
	<body>
		@if ($errors->any())
    		<div class="alert alert-danger">
        		<ul>
            		@foreach ($errors->all() as $error)
                		<li>{{ $error }}</li>
            		@endforeach
        		</ul>
   			 </div>
		@endif
		<b><h1>New project</h1></b>
		<div class="content">
			<form class="" action="{{ route('projects.store') }}" method="post">

				@csrf

				<div>
					Name:<br>
					<input type="text" name="name" value="{{ old('name') }}">
				</div>

				<div>
					<br>Customer:<br>
					<select name="customer_id">

						@if ( old('customer_id') != NULL)
							<option selected value="{{ old('customer_id') }}">
								{{ App\Customer::find(old('customer_id'))->first_name }}
								{{ App\Customer::find(old('customer_id'))->last_name }}
							</option>
						@else
							<option selected disabled>choose by full name</option>
						@endif

						@foreach ($customers as $i)
							<option value="{{ $i->id }}">
								{{$i->first_name }} {{ $i->last_name }}
							</option>
						@endforeach
					</select>
				</div>

				<div>
					<br>Start date:<br>
					<input type="date" name="start_date" value="{{ old('start_date') }}">
				</div>

				<div>
					<br>End date:<br>
					<input type="date" name="end_date" value="{{ old('end_date') }}">
				</div>

				<div>
					<br>Active:<br>
					<select name="active">
						@if ( old('active') == 1)
							<option value=""></option>
							<option selected value="1">Yes</option>
							<option value="0">No</option>
						@else
							<option value=""></option>
							<option value="1">Yes</option>
							<option selected value="0">No</option>
						@endif
					</select>
				</div>

				<div>
					<br>Budget:<br>
					<input type="text" name="budget" value="{{ old('budget') }}">
				</div>

				<div>
					<br>Description:<br> 
					<textarea rows="6" cols="21" name="description">{{ old('description') }}</textarea>
				</div>

				<div>
					<br>
					<button type="submit" name="button">OK</button>
					<a href="{{ route('projects.index') }}">Cancel</a>
				</div>
			</form>
		</div>	
	</body>	
</html>	