@extends('layouts.app')
@section('content')
	<div class="container">
		@include('flash::message')
		<form action="{{ url('/store/processtype') }}" method ="POST">
			@csrf
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-5">
						<div class="grid">
							<div class="grid-header">Process Type Registration</div>
							<div class="grid-body">
								<div class="item-wrapper">
									<div class="form-group">
										<label for="inputProtype">Process Type</label>
										<input type="text" class="form-control" id="inputProtype" name="name" aria-describedby="protypeHelp" required>
										<small id="protypeHelp" class="form-text text-muted">Please enter process type.</small>
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
				        	<div class="grid-header">Registered Process Types</div>
				          	<div class="grid-body">
					            <div class="item-wrapper">
					              <div class="table-responsive">
					                <table id="processtypes-data-table" class="table table-bordered">
					                  <thead>
					                    <tr>
											{{-- <th>ID</th> --}}
					                    	<th>Process Type</th>
					                    	<th align="center">Action</th>
					                    </tr>
					                  </thead>
					                  <tbody>
					                  	@foreach($processtypes as $processtype)
					                  		<tr>
					                  			<td>{{ $processtype->name }}</td>  			
					                  			<td align="center">
						                           <a href="/edit/processtype/{{ $processtype->id }}" class="btn btn-sm btn-outline-primary">Edit</a></td>
					                  		</tr>

					                  	@endforeach
					                  </tbody>
					                  <tfoot>
					                    <tr>
					                    	{{-- <th>ID</th> --}}
					                      	<th>Process Type</th>
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
		    $('#processtypes-data-table').DataTable();
		});
	</script>
@endsection
