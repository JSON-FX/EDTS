@extends('layouts.app')
@section('content')
	<div class="container">
		@include('flash::message')
		<form action="{{ url('/store/office') }}" method ="POST">
			@csrf
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-5">
						<div class="grid">
							<div class="grid-header">Office Registration</div>
							<div class="grid-body">
								<div class="item-wrapper">
									<div class="form-group">
										<label for="inputOfficename">Name of Office</label>
										<input type="text" class="form-control" id="inputOfficename" name="name" aria-describedby="officenameHelp" required>
										<small id="officenameHelp" class="form-text text-muted">Please enter office name.</small>
									</div>	
									<div align="center">	
										<button type="submit" class="btn btn-primary">Submit</button>
									</div>		
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-7">
				        <div class="grid">
				        	<div class="grid-header">Registered Offices</div>
				          	<div class="grid-body">
					            <div class="item-wrapper">
					              <div class="table-responsive">
					                <table id="offices-data-table" class="table table-bordered">
					                  <thead>
					                    <tr>
											{{-- <th>ID</th> --}}
					                    	<th>Office</th>
					                    	<th align="center">Action</th>
					                    </tr>
					                  </thead>
					                  <tbody>
					                  	@foreach($offices as $office)
					                  		<tr>
					                  			<td>{{ $office->name }}</td>  			
					                  			<td align="center">
						                           <a href="/edit/office/{{ $office->id }}" class="btn btn-sm btn-outline-primary">Edit</a></td>
					                  		</tr>

					                  	@endforeach
					                  </tbody>
					                  <tfoot>
					                    <tr>
					                    	{{-- <th>ID</th> --}}
					                      	<th>Office</th>
					                      	<th align="center">Action</th>
					                    </tr>
					                  </tfoot>
					                </table>
					              </div>
					            </div>
					        </div>
				        </div>
        			</div>
				</div>
			</div>
		</form>
	</div>
@endsection
@section('script')
	<script>
		$('div.alert').not('.alert-important').delay(3000).fadeOut(350);
	</script>

	<script>
		$(function() {
		    $('#offices-data-table').DataTable();
		});
	</script>
@endsection
