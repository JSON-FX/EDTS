@extends('layouts.app')
@section('content')
	<div class="container">
		@include('flash::message')
		<form action="{{ url('/store/prdescription') }}" method ="POST">
			@csrf
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-5">
						<div class="grid">
							<div class="grid-header">Purchase Request Description Registration</div>
							<div class="grid-body">
								<div class="item-wrapper">
									<div class="form-group">
										<label for="inputPrDesc">Purchase Request Description</label>
										<input type="text" class="form-control" id="inputPrDesc" name="name" aria-describedby="prdescHelp" required>
										<small id="prdescHelp" class="form-text text-muted">Please enter purchase request description.</small>
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
				        	<div class="grid-header">Registered Descriptions</div>
				          	<div class="grid-body">
					            <div class="item-wrapper">
					              <div class="table-responsive">
					                <table id="prdescriptions-data-table" class="table table-bordered">
					                  <thead>
					                    <tr>
											{{-- <th>ID</th> --}}
					                    	<th>Description</th>
					                    	<th align="center">Action</th>
					                    </tr>
					                  </thead>
					                  <tbody>
					                  	@foreach($prdescriptions as $prdescription)
					                  		<tr>
					                  			<td>{{ $prdescription->name }}</td>  			
					                  			<td align="center">
						                           <a href="/edit/prdescription/{{ $prdescription->id }}" class="btn btn-sm btn-outline-primary">Edit</a></td>
					                  		</tr>

					                  	@endforeach
					                  </tbody>
					                  <tfoot>
					                    <tr>
					                    	{{-- <th>ID</th> --}}
					                      	<th>Description</th>
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
		    $('#prdescriptions-data-table').DataTable();
		});
	</script>
@endsection
