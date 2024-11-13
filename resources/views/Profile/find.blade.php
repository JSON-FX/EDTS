@extends('layouts.app')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-6">
					<div class="grid">
						<div class="grid-header bg-primary">
							<p class="card-title text-white ml-n1">User Details</p>
						</div>
						<div class="grid-body">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="labelDateOfEntry"><strong>Name</strong></label>
										<p><small>{{ $users->name }}</small></p>
									</div>

									<div class="form-group">
										<label for="labelDateOfEntry"><strong>Office</strong></label>
										<p><small>{{ $users->offices->name }}</small></p>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="labelDateOfEntry"><strong>Total Endorsed Documents</strong></label>
										<p><small>0</small></p>
									</div>
									<div class="form-group">
										<label for="labelDateOfEntry"><strong>Longest Holding Time</strong></label>
										<p><small>0</small></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-6">
					<div class="grid">
						<div class="grid-header bg-primary">
							<p class="card-title text-white ml-n1">User Settings</p>
						</div>
						<div class="grid-body">
							<a href="#" class="btn btn-sm btn-primary">Change Name</a>&emsp;
							<a href="#" class="btn btn-sm btn-primary">Reset Password</a>&emsp;
							<a href="#" class="btn btn-sm btn-primary">Export Logs</a>
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
					<p class="card-title text-white ml-n1">Endorsed Documents</p>
				</div>
				<div class="grid-body">
					<div class="item-wrapper">
	                    <div class="table-responsive">
	                        <table id="history-data-table" class="table table-bordered table-condensed" width="100%">
	                            <thead>
	                                <tr>
	                                    <th>Date</th>
	                                    <th>Ref. #</th>
	                                    <th>Sub. Ref. #</th>
	                                    <th>Endorsed </th>
	                                    <th>Endorsing Office</th>
	                                    <th>Receiving Office</th>
	                                    <th>Action</th>
	                                </tr>
	                            </thead>
	                            <tbody>
	                            </tbody>
	                            <tfoot>
	                                <tr>
	                                    <th>Date</th>
	                                    <th>Ref. #</th>
	                                    <th>Sub. Ref. #</th>
	                                    <th>Description</th>
	                                    <th>Endorsing Office</th>
	                                    <th>Receiving Office</th>
	                                    <th>Action</th> 
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

@endsection
@section('script')
	<script>
	        $(function() {
	            $('#history-data-table').DataTable({
	                processing: true,   
	                serverSide: true,
	                deferRender: true,
	                ajax: '/endorsement/history/',
	                columns: [
	                    { data: 'date_endorsed', name: 'date_endorsed'},
	                    { data: 'transactions.reference_id', name: 'transactions.reference_id'},
	                    { data: 'transactions.sub_reference_id', name: 'transactions.sub_reference_id'},
	                    { data: 'transactions.description', name: 'transactions.description'},
	                    { data: 'endorsing_offices.name', name: 'endorsing_offices.name'},
	                    { data: 'receiving_offices.name', name: 'receiving_offices.name' },
	                    { data: 'action', name: 'action'}
	                ],
	                order: [[0, 'Desc']]
	            });
	            $('div.dataTables_filter input').focus();
	        });
    </script>
@endsection