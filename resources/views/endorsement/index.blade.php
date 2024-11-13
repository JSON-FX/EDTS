@extends('layouts.app')
<style>
	.text-wrap{
    white-space:normal;
	}
	.width-200{
		width:200px;
	}
</style>
@section('content')
	<div class="container">
		@include('flash::message')

    	<div class="row">
    		<div class="col-md-12">
    			<div class="grid">
					<div class="grid-header bg-primary">
						<p class="card-title text-white ml-n1">Endorse Document</p>
					</div>
					    <div class="grid-body">
						    <div class="item-wrapper">
						        <div class="table-responsive">
						            <table id="transactions-data-table" class="table table-bordered table-condensed" width="100%"
									>
						                <thead>
						                	<tr>
												{{-- <th>ID</th> --}}
						                    	<th>Date of Entry</th>
												<th>Ref. #</th>
												<th>Process</th>
												<th>End User / Supplier / Payee</th>
												<th>Description</th>
						                    	<th>Status</th>
						                    	<th align="center">Action</th>
						                    </tr>
						                </thead>
						                <tbody>
						                  	@foreach($transactions as $transaction)
						                  		@if($transaction->statuses_id == 1 && $transaction->receiving_offices_id == null)
						                  			<tr>
														<td>{{ $transaction->transactions->date_of_entry }}</td>
														<td>{{ $transaction->transactions->reference_id }}</td>
														<td>{{ $transaction->transactions->process_types->name }}</td>
														<td>
															@switch($transaction->transactions->process_types_id)
																{{-- Purchase Request --}}
																@case($transaction->transactions->process_types->name = 1)
																	{{ $transaction->transactions->offices->name }}
																	@break
																{{-- Purchase Request --}}
																@case($transaction->transactions->process_types->name = 2)
																	{{ $transaction->transactions->client }}
																	@break
																{{-- Voucher --}}
																@case($transaction->transactions->process_types->name = 3)
																	{{ $transaction->transactions->client }}
																	@break
																@default
																	
															@endswitch
														</td>
														<td>{{ $transaction->transactions->description }}</td>
														@switch($transaction->statuses->name)
															@case($transaction->statuses->name = "None")
																<td>
																	<span class="badge badge-inverse-primary">
																		<span class="status-indicator rounded-indicator bg-primary"></span>
																		<p><strong>Not Endorsed</strong></p>
																	</span>
																</td>
																@break
															@case($transaction->statuses->name = "Complete")
																<td>
																	<span class="badge badge-inverse-success">
																		<span class="status-indicator rounded-indicator bg-success"></span>
																		{{ $transaction->statuses->name }}
																	</span>
																</td>
																@break
															@case($transaction->statuses->name = "In Progress")
																<td>
																	<span class="badge badge-inverse-warning">
																		<span class="status-indicator rounded-indicator bg-warning"></span>
																		{{ $transaction->statuses->name }}
																	</span>
																</td>
																@break
															@case($transaction->statuses->name = "Cancelled")
																<td>
																	<span class="badge badge-inverse-danger">
																		<span class="status-indicator rounded-indicator bg-danger"></span>
																		{{ $transaction->statuses->name }}
																	</span>
																</td>
																@break
															@default
														@endswitch
							                  			<td align="center">
								                           <a href="/create/endorsement/{{ $transaction->id }}" class="btn btn-xs btn-outline-primary"><i class="mdi mdi-note-plus"></i></a>
								                           <a href="/find/records/{{ $transaction->transactions->id }}" class="btn btn-xs btn-outline-primary"><i class="mdi mdi-magnify"></i></a>
								                       	</td>
							                  		</tr>
						                  		@else
						      						{{-- null --}}
						                  		@endif
						                  	@endforeach
						                </tbody>
						                <tfoot>
						                    <tr>
						                    	{{-- <th>ID</th> --}}
						                      	<th>Date of Entry</th>
												<th>Ref. #</th>
												<th>Process</th>
												<th>End User / Supplier / Payee</th>
												<th>Description</th>
						                    	<th>Status</th>
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

    		<div class="row">
    			<div class="col-md-12">
    				<div class="grid">
						<div class="grid-header bg-primary">
							<p class="card-title text-white ml-n1">Receive Document</p>
						</div>
						    <div class="grid-body">
							<div class="item-wrapper">
								<div class="table-responsive">
									<table id="office-data-table" class="table table-bordered table-condensed" width="100%">
										<thead>
											<tr>
												{{-- <th>ID</th> --}}
												<th>Endorsement Date</th>
												<th>Ref. #</th>
												<th>End User / Supplier / Payee</th>
												<th>Description</th>
												<th align="center">Action</th>
											</tr>
										</thead>
										<tbody>
											@foreach($endorsements as $endorsement)
												@if($endorsement->receiving_offices_id == auth()->user()->offices_id && $endorsement->date_received == null)
													<tr>
														<td>{{ $endorsement->date_endorsed }}</td>
														<td>{{ $endorsement->transactions->reference_id }}</td>
														<td>
															@switch($endorsement->transactions->process_types_id)
																{{-- Purchase Request --}}
																@case($endorsement->transactions->process_types->name = 1)
																	{{ $endorsement->transactions->offices->name }}
																	@break
																{{-- Purchase Request --}}
																@case($endorsement->transactions->process_types->name = 2)
																	{{ $endorsement->transactions->client }}
																	@break
																{{-- Voucher --}}
																@case($endorsement->transactions->process_types->name = 3)
																	{{ $endorsement->transactions->client }}
																	@break
																@default
																	
															@endswitch
															<td>{{ $endorsement->transactions->description }}</td>
														</td>
														<td align="center">
															<a href="/endorsement/status/accepted/{{ $endorsement->id }}" class="btn btn-xs btn-outline-primary"><i class="mdi mdi-note-plus"></i></a>
														</td>
													</tr>
												@else
													{{-- null --}}
												@endif
											@endforeach
										</tbody>
										<tfoot>
											<tr>
												{{-- <th>ID</th> --}}
												<th>Endorsement Date</th>
												<th>Ref. #</th>
												<th>End User / Supplier / Payee</th>
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
	</div>
@endsection
@section('script')
	<script>
		$('div.alert').not('.alert-important').delay(3000).fadeOut(350);
	</script>

	<script>
		$(function() {
			$('#transactions-data-table').DataTable({
			deferRender: true,

			columnDefs: [
				{
					render: function (data, type, full, meta) {
						return "<div class='text-wrap width-201'>" + data + "</div>";
					},
					targets: 3
				},
				{
					render: function (data, type, full, meta) {
                        return "<div class='text-wrap width-201'>" + data + "</div>";
                    },
                    targets: 4,
				}	
			]
			});
			$('div.dataTables_filter input').focus()
		});
	</script>

	<script>
		$(function() {
		    $('#office-data-table').DataTable({
				deferRender: true,
				scrollX: true,
				scrollY: 201,
				scrollCollapse: true,
				scroller: true,
				paging: true,

				columnDefs: [
					{
						render: function (data, type, full, meta) {
							return "<div class='text-wrap width-201'>" + data + "</div>";
						},
						targets: 2
					},
					{
						render: function (data, type, full, meta) {
							return "<div class='text-wrap width-201'>" + data + "</div>";
						},
						targets: 3
					}
				]
			});
		});
	</script>
@endsection
