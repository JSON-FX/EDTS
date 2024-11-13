@extends('layouts.app')
@section('content')
	<div class="container">
		@include('flash::message')
		<form action="/update/prdescription/{{ $prdescriptions->id }}" method ="POST">
			@csrf
			<div class="col-md-9 offset-3">
				<div class="row">
					<div class="col-md-8">
						<div class="grid">
							<div class="grid-header">Update Purchase Request Description</div>
								<div class="grid-body">
									<div class="item-wrapper">
										<div class="form-group">
											
											<label for="inputPrDesc">Purchase Request Description</label>
											<input type="text" class="form-control" id="inputPrDesc" name="name" aria-describedby="prdescHelp" value="{{ $prdescriptions->name }}" required>
											<small id="prdescHelp" class="form-text text-muted"> Please enter Purchased Request Description.</small>
										</div>	
										<div align="center">	
											<button type="submit" class="btn btn-outline-primary">Update</button>
											<a href="/create/prdescription" class="btn btn-outline-primary">Back</a>
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
