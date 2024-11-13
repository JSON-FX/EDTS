@extends('layouts.app')
@section('content')
	<div class="container">
		@include('flash::message')
		<form action="/update/processtype/{{ $processtypes->id }}" method ="POST">
			@csrf
			<div class="col-md-9 offset-3">
				<div class="row">
					<div class="col-md-8">
						<div class="grid">
							<div class="grid-header">Update Process Type</div>
								<div class="grid-body">
									<div class="item-wrapper">
										<div class="form-group">
											
											<label for="inputProType">Process Type</label>
											<input type="text" class="form-control" id="inputProType" name="name" aria-describedby="protypeHelp" value="{{ $processtypes->name }}" required>
											<small id="protypeHelp" class="form-text text-muted"> Please enter Process Type.</small>
										</div>	
										<div align="center">	
											<button type="submit" class="btn btn-outline-primary">Update</button>
											<a href="/create/processtype" class="btn btn-outline-primary">Back</a>
										</div>		
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
@endsection
