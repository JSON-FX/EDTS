@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="grid">
				<div class="grid-header bg-primary">
					<p class="card-title text-white ml-n1">Endorsement Details</p>
				</div>

				<div class="grid-body">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label><strong>Reference #</strong></label>
								<p><small>{{ $endorsements->transactions->reference_id }}</small></p>
							</div>

							<div class="form-group">
								<label><strong>Sub Reference #</strong></label>
								@if($endorsements->transactions->sub_reference_id != null)
									<p><small>{{ $endorsements->transactions->sub_reference_id }}</small></p>
								@else
									<p><small>None</small></p>
								@endif
							</div>

							<div class="form-group">
								<label><strong>Description</strong></label>
								<p><small>{{ $endorsements->transactions->description }}</small></p>
							</div>

							<div class="form-group">
								<label><strong>Classification</strong></label>
								<p><small>{{ $endorsements->transactions->process_types->name }}</small></p>
							</div>

							<div class="form-group">
								<label><strong>Office</strong></label>
								<p><small>{{ $endorsements->transactions->offices->name }}</small></p>
							</div>

							<div class="form-group">
								<label><strong>Philgeps Description</strong></label>
								<p><small>{{ $endorsements->transactions->pr_descriptions->name }}</small></p>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label><strong>Endorsing Office</strong></label>
								<p><small>{{ $endorsements->endorsing_offices->name }}</small></p>
							</div>

							<div class="form-group">
								<label><strong>Date Endorsed</strong></label>
								<p><small>{{ $endorsements->date_endorsed }}</small></p>
							</div>

							<div class="form-group">
								<label><strong>Receiving Office</strong></label>
								@if($endorsements->receiving_offices_id != null)
									<p><small>{{ $endorsements->receiving_offices->name }}</small></p>
								@else
									<p><small><strong style="color:red">Not yet endorsed</strong></small></p>
								@endif
							</div>

							<div class="form-group">
								<label><strong>Date Received</strong></label>
								@if($endorsements->date_received != null)
									<p><small>{{ $endorsements->receiving_received }}</small></p>
								@else
									<p><small><strong style="color:red">Not yet received</strong></small></p>
								@endif
							</div>

							<div class="form-group">
								<label><strong>Currently Assigned To</strong></label>
								<p><small>{{ $endorsements->users->name }}</small></p>
								<p><small>{{ $endorsements->users->offices->name }}</small></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scripts')
@endsection