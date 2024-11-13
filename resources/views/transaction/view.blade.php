@extends('layouts.app')
@section('content')
	<div class="container">
		@include('flash::message')
		
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-12">
					<div class="grid">
						<div class="grid-header">Current Information <span class="badge badge-pill badge-warning">{{ $transactions->statuses->name }}</span></div>
						<div class="grid-body">
							<div class="item-wrapper">
								<div class="row">
									<div class="col-sm-4">
										<div class="form-group">
											<label for="oldDate"><strong>Reference No.: </strong></label>
											{{ $transactions->bar_code }}
										</div>
										<div class="form-group">
											<label for="oldDate"><strong>Date: </strong></label>
											{{ $transactions->date_of_entry }}
										</div>
										<div class="form-group">
											<label for="oldOffice"><strong>Office: </strong></label>
											{{ $transactions->offices->name }}
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label for="oldPRN"><strong>Purchase Request No.: </strong></label>
											{{ $transactions->reference_id }}
										</div>
										<div class="form-group">
											<label for="oldPRDescription"><strong>Purchase Description: </strong></label>
											{{ $transactions->pr_descriptions->name }}
										</div>
										<div class="form-group">
											<label for="oldEstEstAmount"><strong>Estimated Amount: </strong></label>
											{{ number_format($transactions->amount, 2, '.', ',') }}
										</div>
										<div class="form-group">
											<label for="oldEstActAmount"><strong>Actual Amount: </strong></label>
											{{ number_format($transactions->pr_actual_amount, 2, '.', ',') }}
										</div>
									</div>
									<div class="col-sm-4">
										<div class="form-group">
											<label for="oldEstSupplier"><strong>Supplier: </strong></label>
											{{ $transactions->client }}
										</div>
										<div class="form-group">
											<label for="oldEstAddress"><strong>Address: </strong></label>
											{{ $transactions->address }}
										</div>
										<div class="form-group">
											<label for="oldEstEndorsementDate"><strong>Endorsement Date: </strong></label>
											{{ $transactions->endorsement_date }}
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12" align="right">
						<a href="/create/transaction" class="btn btn-outline-primary">Back</a>
					</div>
				</div>
			</div>
		</div>	       	   
	</div>
@endsection