@extends('layouts.app')
@section('content')
	<div class="container">
		@include('flash::message')
	<form action="/store/endorsement/{{ $endorsements->id }}" method ="POST" onSubmit='disableFunction()'>
			@csrf
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-12">
						<div class="grid">
							<div class="grid">
								<div class="grid-header bg-primary">
									<p class="card-title text-white ml-n1">Endorsement Details</p>
								</div>
							<div class="grid-body">
								@switch($endorsements->transactions->process_types->name)
									@case($endorsements->transactions->process_types->name = "Purchase Request")
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="labelDateOfEntry"><strong>Date of Entry</strong></label>
													<p><small>{{ $endorsements->transactions->date_of_entry }}</small></p>
												</div>
		
												<div class="form-group">
													<label for="labelReferenceNo"><strong>Reference No.</strong></label>
													<p><small>{{ $endorsements->transactions->reference_id }}</small></p>
												</div>
		
												<div class="form-group">
													<label for="labelOffices"><strong>Office</strong></label>
													<p><small>{{ $endorsements->transactions->offices->name }}</small></p>
												</div>
		
												<div class="form-group">
													<label for="labelApprovedBudgetForTheContract"><strong>Approved Budget for the Contract <i>(ABC)</i></strong></label>
													<div class="col-md-5">
														<input type="text" class="form-control" id="inputType5" value="{{ number_format($endorsements->transactions->amount, 2, '.', ',') }}" disabled="">
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="labelDescription"><strong>Description</strong></label>
													<p><small>{{ $endorsements->transactions->description }}</small></p>
												</div>
		
												<div class="form-group">
													<label for="labelParticulars"><strong>Particulars</strong></label>
													<p><small>{{ $endorsements->transactions->pr_descriptions->name }}</small></p>
												</div>
		
												<div class="form-group">
													<label for="labelDocumentHolder"><strong>Document Created By</strong></label>
													<p><small>{{ $endorsements->transactions->users->name }}</small></p>
													<p><small>{{ $endorsements->transactions->users->offices->name }}</small></p>
												</div>

												<div class="form-group">
													<label for="labelDocumentHolder"><strong>Currently Assigned To</strong></label>
													@switch($endorsements->transactions->statuses->name)
														@case($endorsements->transactions->statuses->name = "None")
															<p><small>{{ $endorsements->transactions->users->name }}</small></p>
															<p><small>{{ $endorsements->transactions->users->offices->name }}</small></p>
															<p><strong style="color:red">Document has not been endorsed yet.</strong></p>
															@break
														@case($endorsements->transactions->statuses->name = "Complete")
															<p><small>{{ $endorsements->users->name }}</small></p>
															<p><small>{{ $endorsements->users->offices->name }}</small></p>
															<p><strong style="color:green">Document has been completely processed</strong></p>							
															@break
														@case($endorsements->transactions->statuses->name = "In Progress")
															<p><small>{{ $endorsements->users->name }}</small></p>
															<p><small>{{ $endorsements->users->offices->name }}</small></p>
															@break
														@default
													@endswitch
												</div>
											</div>
										</div>
										@break
									@case($endorsements->transactions->process_types->name = "Voucher")
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="labelDateOfEntry"><strong>Date of Entry</strong></label>
													<p><small>{{ $endorsements->transactions->date_of_entry }}</small></p>
												</div>
		
												<div class="form-group">
													<label for="labelReferenceNo"><strong>Reference No.</strong></label>
													<p><small>{{ $endorsements->transactions->reference_id }}</small></p>
												</div>
		
												<div class="form-group">
													<label for="labelSubReferenceNo"><strong>Sub Reference No.</strong></label>
													<p><small>{{ $endorsements->transactions->sub_reference_id }}</small></p>
												</div>
		
												<div class="form-group">
													<label for="labelPRDescription"><strong>Particulars</strong></label>
													<p><small>{{ $endorsements->transactions->pr_descriptions->name }}</small></p>
												</div>
		
												<div class="form-group">
													<label for="labelOffice"><strong>Office</strong></label>
													<p><small>{{ $endorsements->transactions->offices->name }}</small></p>
												</div>

												<div class="form-group">
													<label for="labelContract Price"><strong>Contract Price</strong></label>
													<div class="col-md-5">
														<input type="text" class="form-control" id="inputType5" value="{{ number_format($endorsements->transactions->amount, 2, '.', ',') }}" disabled="">
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="labelDescription"><strong>Description</strong></label>
													<p><small>{{ $endorsements->transactions->description }}</small></p>
												</div>
		
												<div class="form-group">
													<label for="labelSupplier"><strong>Payee</strong></label>
													<p><small>{{ $endorsements->transactions->client }}</small></p>
												</div>
		
												<div class="form-group">
													<label for="labelStatus"><strong>Status</strong></label>
													@switch($endorsements->transactions->statuses->name)
														@case($endorsements->transactions->statuses->name = "None")
															<p><span class="badge badge-primary"><small>Not Endorsed</small></span></p>
															@break
														@case($endorsements->transactions->statuses->name = "Complete")
															<p><span class="badge badge-success"><small>{{ $endorsements->transactions->statuses->name }}</small></span></p>								@break
														@case($endorsements->transactions->statuses->name = "In Progress")
															<p><span class="badge badge-warning"><small>{{ $endorsements->transactions->statuses->name }}</small></span></p>
															@break
														@case($endorsements->transactions->statuses->name = "Cancelled")
															<p><span class="badge badge-danger"><small>{{ $endorsements->transactions->statuses->name }}</small></span></p>
															@break
														@default
													@endswitch
												</div>

												<div class="form-group">
													<label for="labelDocumentHolder"><strong>Document Created By</strong></label>
													<p><small>{{ $endorsements->transactions->users->name }}</small></p>
													<p><small>{{ $endorsements->transactions->users->offices->name }}</small></p>
												</div>

												<div class="form-group">
													<label for="labelDocumentHolder"><strong>Currently Assigned To</strong></label>
													@switch($endorsements->transactions->statuses->name)
														@case($endorsements->transactions->statuses->name = "None")
															<p><small>{{ $endorsements->transactions->users->name }}</small></p>
															<p><small>{{ $endorsements->transactions->users->offices->name }}</small></p>
															<p><strong style="color:red">Document has not been endorsed yet.</strong></p>
															@break
														@case($endorsements->transactions->statuses->name = "Complete")
															<p><small>{{ $endorsements->users->name }}</small></p>
															<p><small>{{ $endorsements->users->offices->name }}</small></p>
															<p><strong style="color:green">Document has been completely processed</strong></p>							
															@break
														@case($endorsements->transactions->statuses->name = "In Progress")
															<p><small>{{ $endorsements->users->name }}</small></p>
															<p><small>{{ $endorsements->users->offices->name }}</small></p>
															@break
														@default
													@endswitch
												</div>
											</div>
										</div>
										@break
									@case($endorsements->transactions->process_types->name = "Purchase Order")
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="labelDateOfEntry"><strong>Date of Entry</strong></label>
													<p><small>{{ $endorsements->transactions->date_of_entry }}</small></p>
												</div>
		
												<div class="form-group">
													<label for="labelReferenceNo"><strong>Reference No.</strong></label>
													<p><small>{{ $endorsements->transactions->reference_id }}</small></p>
												</div>
		
												<div class="form-group">
													<label for="labelSubReferenceNo"><strong>Sub Reference No.</strong></label>
													<p><small>{{ $endorsements->transactions->sub_reference_id }}</small></p>
												</div>
		
												<div class="form-group">
													<label for="labelPRDescription"><strong>Particulars</strong></label>
													<p><small>{{ $endorsements->transactions->pr_descriptions->name }}</small></p>
												</div>
		
												<div class="form-group">
													<label for="labelOffice"><strong>Office</strong></label>
													<p><small>{{ $endorsements->transactions->offices->name }}</small></p>
												</div>

												<div class="form-group">
													<label for="labelContract Price"><strong>Contract Price</strong></label>
													<div class="col-md-5">
														<input type="text" class="form-control" id="inputType5" value="{{ number_format($endorsements->transactions->amount, 2, '.', ',') }}" disabled="">
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="labelDescription"><strong>Description</strong></label>
													<p><small>{{ $endorsements->transactions->description }}</small></p>
												</div>
		
												<div class="form-group">
													<label for="labelSupplier"><strong>Supplier</strong></label>
													<p><small>{{ $endorsements->transactions->client }}</small></p>
												</div>
		
												<div class="form-group">
													<label for="labelSupplierAddress"><strong>Address</strong></label>
													<p><small>{{ $endorsements->transactions->address }}</small></p>
												</div>
		
												<div class="form-group">
													<label for="labelStatus"><strong>Status</strong></label>
													@switch($endorsements->transactions->statuses->name)
														@case($endorsements->transactions->statuses->name = "None")
															<p><span class="badge badge-primary"><small>Not Endorsed</small></span></p>
															@break
														@case($endorsements->transactions->statuses->name = "Complete")
															<p><span class="badge badge-success"><small>{{ $endorsements->transactions->statuses->name }}</small></span></p>								@break
														@case($endorsements->transactions->statuses->name = "In Progress")
															<p><span class="badge badge-warning"><small>{{ $endorsements->transactions->statuses->name }}</small></span></p>
															@break
														@case($endorsements->transactions->statuses->name = "Cancelled")
															<p><span class="badge badge-danger"><small>{{ $endorsements->transactions->statuses->name }}</small></span></p>
															@break
														@default
													@endswitch
												</div>

												<div class="form-group">
													<label for="labelDocumentHolder"><strong>Document Created By</strong></label>
													<p><small>{{ $endorsements->transactions->users->name }}</small></p>
													<p><small>{{ $endorsements->transactions->users->offices->name }}</small></p>
												</div>

												<div class="form-group">
													<label for="labelDocumentHolder"><strong>Currently Assigned To</strong></label>
													@switch($endorsements->transactions->statuses->name)
														@case($endorsements->transactions->statuses->name = "None")
															<p><small>{{ $endorsements->transactions->users->name }}</small></p>
															<p><small>{{ $endorsements->transactions->users->offices->name }}</small></p>
															<p><strong style="color:red">Document has not been endorsed yet.</strong></p>
															@break
														@case($endorsements->transactions->statuses->name = "Complete")
															<p><small>{{ $endorsements->users->name }}</small></p>
															<p><small>{{ $endorsements->users->offices->name }}</small></p>
															<p><strong style="color:green">Document has been completely processed</strong></p>							
															@break
														@case($endorsements->transactions->statuses->name = "In Progress")
															<p><small>{{ $endorsements->users->name }}</small></p>
															<p><small>{{ $endorsements->users->offices->name }}</small></p>
															@break
														@default
													@endswitch
												</div>
											</div>
										</div>
										@break
									@default
										<p><i>No Record</i></p>
							@endswitch
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					@switch(auth()->user()->offices_id)
						{{-- MTO --}}
						@case(auth()->user()->offices_id == 20)
							<div class="col-md-12">
								<div class="grid">
									<div class="grid">
										<div class="grid-header bg-primary">
											<p class="card-title text-white ml-n1">Endorse Document</p>
										</div>
									<div class="grid-body">
										<div class="item-wrapper">
											<div class="row">
												<div class="col-sm-6">							
													<div class="form-group">
														<label for="inputDOE">Date of Endorsement</label>
														<input type="date" class="form-control" id="inputDOE" name="date_endorsed" aria-describedby="DOEHelp" placeholder="Date of Endorse" required>
														<small id="DOEHelp" class="form-text text-muted">Please enter the date of endorsement.</small>
													</div>	
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<label for="selectROffice">Receiving Office</label>
														<select class="custom-select" name="receiving_offices_id">
														<option value="">Click to select</option>		
														{{-- @foreach ($receiving_offices as $office)					 --}}
															{{-- <option value="{{$office->id}}"> {{ $office->name}} </option> --}}
														{{-- @endforeach --}}
														<option value="18">Municipal Budget Office</option>
														<option value="24">Municipal Mayor's Office</option>
														<option value="5">Bids & Awards Committee</option>
														<option value="6">Purchasing Office</option>
														<option value="9">General Services Office</option>
														<option value="19">Municipal Accounting Office</option>
														<option value="20">Municipal Treasurer's Office</option>
														
														</select>
														<small id="rofficeHelp" class="form-text text-muted">Please select receiving office.</small>
													</div>

													<input type="hidden" class="form-control" id="inputTransactionid" name="endorsing_offices_id" value="{{ auth()->user()->offices_id }}">

													<input type="hidden" class="form-control" id="inputTransactionid" name="transactions_id" value="{{ $endorsements->transactions->id }}">
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<label for="selectStatus">Endorsement Status</label>
														<select class="custom-select" name="statuses_id"  required>
														<option value="">Select Status</option>
														<option value="2">Endorse Document</option>
														<option value="4">Complete Transaction</option>
														</select>
														<small id="rofficeHelp" class="form-text text-muted">Please select endorsement status.</small>
													</div>

													<div class="form-group">
														<label for="selectRS">Receiving Staff</label>
														<select class="custom-select" name="receivingstaff_id">
															{{-- @foreach($users as $user)
																<option value="{{ $user->id }}">{{ $user->name }} - {{ $user->initials }}</option>
															@endforeach --}}
															<option value="1">MMO - Rhea Jill Palahang - R.J.P</option>
															<option value="2">BAC - Hazel Acusar - H.A</option>
															<option value="3">MBO - Neil Darwin Cadampog - N.D.C</option>
															<option value="8">MBO - Nikki Lou Cortes - N.L.C</option>
															<option value="5">PO - Arnel Lacubtan - A.L</option>
															<option value="7">PO - Melven Abaquita - M.A</option>
															<option value="9">GSO - Bernadette Quipit - B.Q</option>
															<option value="15">GSO - Julius Jerome Alo - J.J.A</option>
															<option value="27">MACCO - Mytha Zeana R. Aganon - M.Z.A</option>
															<option value="17">MTO - Annie Relacion - A.R</option>
															<option value="18">MTO - Dindo Yecyec - D.Y</option>
														</select>
													</div>
												</div>
												{{-- <div class="col-sm-6">
													<div class="form-group">
														<label for="selectStatus">Action Taken</label>
														<select class="custom-select" name="remarks"  required>
															<option value="">Select Status</option>
															@foreach($actions as $action)
																<option value="{{ $action->id }}">{{ $action->name }}</option>
															@endforeach
															</select>
														<small id="rofficeHelp" class="form-text text-muted">Please select action status.</small>
													</div>
												</div> --}}

												{{-- Attachments --}}

												<div class="col-sm-12">
													<div class="form-group">
														<label for="inputAttachments">Attachments</label><br>
														{{-- <input type="text" class="form-control" id="inputAttachments" name="attachments" aria-describedby="doeHelp" placeholder="Attachments" required> --}}
														<select class="js-example-basic-multiple" name="attachments[]" multiple="multiple" style="width: 100%">
															@foreach ($attachmentLists as $data)
																<option value="{{ $data->id }}">{{ $data->name }}</option>
															@endforeach
														</select>
														<input type="text" name="attachment_ref_id" hidden>
														<small id="docHelp" class="form-text text-muted">Please Select Attachments.</small>
													</div>
												</div>
												<hr>
												<div class="col-sm-12" align="center">
													<h5>Document Update</h5><br><hr>	
												</div>
												<div class="col-sm-6">
													<textarea id="simpleMde" name="report" style="display: none;"></textarea>
											   </div>
											   <div class="col-md-6">
												<div class="table-responsive">
													<table id="words-data-table" class="table table-bordered table-condensed" width="100%">
														<thead>
															<tr>
																<th>Actions</th>
															</tr>
														</thead>
														<tbody>
															@foreach($actions as $action)
																<tr>
																	<td>{{ $action->name }}</td>
																</tr>
															@endforeach
														</tbody>
														<tfoot>
															<tr>
																<th>Actions</th>
															</tr>
														</tfoot>
													</table>
												</div>
											</div>
											</div>										
										</div>
										<div align="center" style="margin-top: 2em;">	
											{{-- <button disabled class="btn btn-outline-primary" type=button id="btnverzenden2" style="display: none"><span class="glyphicon glyphicon-refresh"></span>Submitting</button>    --}}
											<button class="btn btn-outline-primary" type=submit name=verzenden id="btnverzenden">Submit</button>
											<a href="/endorsement" class="btn btn-outline-primary">Back</a>
										</div>	
									</div>
								</div>
							</div>
							@break

						{{-- MMO --}}
						@case(auth()->user()->offices_id == 24)
							<div class="col-md-12">
								<div class="grid">
									<div class="grid-header bg-primary">
										<p class="card-title text-white ml-n1">Endorse Document</p>
									</div>
									<div class="grid-body">
										<div class="item-wrapper">
											<div class="row">
												<div class="col-sm-6">							
													<div class="form-group">
														<label for="inputDOE">Date of Endorsement</label>
														<input type="date" class="form-control" id="inputDOE" name="date_endorsed" aria-describedby="DOEHelp" placeholder="Date of Endorse" required>
														<small id="DOEHelp" class="form-text text-muted">Please enter the date of endorsement.</small>
													</div>	
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<label for="selectROffice">Receiving Office</label>
														<select class="custom-select" name="receiving_offices_id">
														<option value="">Click to select</option>		
														{{-- @foreach ($receiving_offices as $office)					 --}}
															{{-- <option value="{{$office->id}}"> {{ $office->name}} </option> --}}
														{{-- @endforeach --}}
														<option value="18">Municipal Budget Office</option>
														<option value="24">Municipal Mayor's Office</option>
														<option value="5">Bids & Awards Committee</option>
														<option value="6">Purchasing Office</option>
														<option value="9">General Services Office</option>
														<option value="19">Municipal Accounting Office</option>
														<option value="20">Municipal Treasurer's Office</option>
														
														</select>
														<small id="rofficeHelp" class="form-text text-muted">Please select receiving office.</small>
													</div>

													<input type="hidden" class="form-control" id="inputTransactionid" name="endorsing_offices_id" value="{{ auth()->user()->offices_id }}">

													<input type="hidden" class="form-control" id="inputTransactionid" name="transactions_id" value="{{ $endorsements->transactions->id }}">
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<label for="selectStatus">Endorsement Status</label>
														<select class="custom-select" name="statuses_id"  required>
														<option value="">Select Status</option>
														<option value="2">Endorse Document</option>
														<option value="3">Cancel Document</option>
														</select>
														<small id="rofficeHelp" class="form-text text-muted">Please select endorsement status.</small>
													</div>
													<div class="form-group">
														<label for="selectRS">Receiving Staff</label>
														<select class="custom-select" name="receivingstaff_id">
															{{-- @foreach($users as $user)
																<option value="{{ $user->id }}">{{ $user->name }} - {{ $user->initials }}</option>
															@endforeach --}}
															<option value="1">MMO - Rhea Jill Palahang - R.J.P</option>
															<option value="2">BAC - Hazel Acusar - H.A</option>
															<option value="3">MBO - Neil Darwin Cadampog - N.D.C</option>
															<option value="8">MBO - Nikki Lou Cortes - N.L.C</option>
															<option value="5">PO - Arnel Lacubtan - A.L</option>
															<option value="7">PO - Melven Abaquita - M.A</option>
															<option value="9">GSO - Bernadette Quipit - B.Q</option>
															<option value="15">GSO - Julius Jerome Alo - J.J.A</option>
															<option value="27">MACCO - Mytha Zeana R. Aganon - M.Z.A</option>
															<option value="17">MTO - Annie Relacion - A.R</option>
															<option value="18">MTO - Dindo Yecyec - D.Y</option>
														</select>
													</div>
												</div>
												{{-- <div class="col-sm-6">
													<div class="form-group">
														<label for="selectStatus">Action Taken</label>
														<select class="custom-select" name="remarks"  required>
															<option value="">Select Status</option>
															@foreach($actions as $action)
																<option value="{{ $action->id }}">{{ $action->name }}</option>
															@endforeach
														</select>
														<small id="rofficeHelp" class="form-text text-muted">Please select action status.</small>
													</div>
												</div> --}}
												{{-- Attachments --}}

												<div class="col-sm-12">
													<div class="form-group">
														<label for="inputAttachments">Attachments</label><br>
														{{-- <input type="text" class="form-control" id="inputAttachments" name="attachments" aria-describedby="doeHelp" placeholder="Attachments" required> --}}
														<select class="js-example-basic-multiple" name="attachments[]" multiple="multiple" style="width: 100%">
															@foreach ($attachmentLists as $data)
																<option value="{{ $data->id }}">{{ $data->name }}</option>
															@endforeach
														</select>
														<input type="text" name="attachment_ref_id" hidden>
														<small id="docHelp" class="form-text text-muted">Please Select Attachments.</small>
													</div>
												</div>	
												<hr>
												<div class="col-sm-12" align="center">
													<h5>Document Update</h5><br><hr>
												</div>
												<div class="col-sm-6">
													<textarea id="simpleMde" name="report" style="display: none;"></textarea>
											   </div>
											   <div class="col-md-6">
												<div class="table-responsive">
													<table id="words-data-table" class="table table-bordered table-condensed" width="100%">
														<thead>
															<tr>
																<th>Actions</th>
															</tr>
														</thead>
														<tbody>
															@foreach($actions as $action)
																<tr>
																	<td>{{ $action->name }}</td>
																</tr>
															@endforeach
														</tbody>
														<tfoot>
															<tr>
																<th>Actions</th>
															</tr>
														</tfoot>
													</table>
												</div>
											</div>
											</div>										
										</div>
										<div align="center" style="margin-top: 2em;">	
											{{-- <button disabled class="btn btn-outline-primary" type=button id="btnverzenden2" style="display: none"><span class="glyphicon glyphicon-refresh"></span>Submitting</button>    --}}
											<button class="btn btn-outline-primary" type=submit name=verzenden id="btnverzenden">Submit</button>
											<a href="/endorsement" class="btn btn-outline-primary">Back</a>
										</div>	
									</div>
								</div>
							</div>
							@break
						{{-- MACCO --}}
						@case(auth()->user()->offices_id == 19)
							<div class="col-md-12">
								<div class="grid">
									<div class="grid-header bg-primary">
										<p class="card-title text-white ml-n1">Endorse Document</p>
									</div>
									<div class="grid-body">
										<div class="item-wrapper">
											<div class="row">
												<div class="col-sm-6">							
													<div class="form-group">
														<label for="inputDOE">Date of Endorsement</label>
														<input type="date" class="form-control" id="inputDOE" name="date_endorsed" aria-describedby="DOEHelp" placeholder="Date of Endorse" required>
														<small id="DOEHelp" class="form-text text-muted">Please enter the date of endorsement.</small>
													</div>	
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<label for="selectROffice">Receiving Office</label>
														<select class="custom-select" name="receiving_offices_id">
														<option value="">Click to select</option>		
														{{-- @foreach ($receiving_offices as $office)					 --}}
															{{-- <option value="{{$office->id}}"> {{ $office->name}} </option> --}}
														{{-- @endforeach --}}
														<option value="18">Municipal Budget Office</option>
														<option value="24">Municipal Mayor's Office</option>
														<option value="5">Bids & Awards Committee</option>
														<option value="6">Purchasing Office</option>
														<option value="9">General Services Office</option>
														<option value="19">Municipal Accounting Office</option>
														<option value="20">Municipal Treasurer's Office</option>
														
														</select>
														<small id="rofficeHelp" class="form-text text-muted">Please select receiving office.</small>
													</div>

													<input type="hidden" class="form-control" id="inputTransactionid" name="endorsing_offices_id" value="{{ auth()->user()->offices_id }}">

													<input type="hidden" class="form-control" id="inputTransactionid" name="transactions_id" value="{{ $endorsements->transactions->id }}">
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<label for="selectStatus">Endorsement Status</label>
														<select class="custom-select" name="statuses_id"  required>
														<option value="">Select Status</option>
														<option value="2">Endorse Document</option>
														<option value="4">Complete Transaction</option>
														</select>
														<small id="rofficeHelp" class="form-text text-muted">Please select endorsement status.</small>
													</div>
													<div class="form-group">
														<label for="selectRS">Receiving Staff</label>
														<select class="custom-select" name="receivingstaff_id">
															{{-- @foreach($users as $user)
																<option value="{{ $user->id }}">{{ $user->name }} - {{ $user->initials }}</option>
															@endforeach --}}
															<option value="1">MMO - Rhea Jill Palahang - R.J.P</option>
															<option value="2">BAC - Hazel Acusar - H.A</option>
															<option value="3">MBO - Neil Darwin Cadampog - N.D.C</option>
															<option value="8">MBO - Nikki Lou Cortes - N.L.C</option>
															<option value="5">PO - Arnel Lacubtan - A.L</option>
															<option value="7">PO - Melven Abaquita - M.A</option>
															<option value="9">GSO - Bernadette Quipit - B.Q</option>
															<option value="15">GSO - Julius Jerome Alo - J.J.A</option>
															<option value="27">MACCO - Mytha Zeana R. Aganon - M.Z.A</option>
															<option value="17">MTO - Annie Relacion - A.R</option>
															<option value="18">MTO - Dindo Yecyec - D.Y</option>
														</select>
													</div>
												</div>
												{{-- <div class="col-sm-6">
													<div class="form-group">
														<label for="selectStatus">Action Taken</label>
														<select class="custom-select" name="remarks"  required>
															<option value="">Select Status</option>
															@foreach($actions as $action)
																<option value="{{ $action->id }}">{{ $action->name }}</option>
															@endforeach
														</select>
														<small id="rofficeHelp" class="form-text text-muted">Please select action status.</small>
													</div>
												</div> --}}

												{{-- Attachments --}}

												<div class="col-sm-12">
													<div class="form-group">
														<label for="inputAttachments">Attachments</label><br>
														{{-- <input type="text" class="form-control" id="inputAttachments" name="attachments" aria-describedby="doeHelp" placeholder="Attachments" required> --}}
														<select class="js-example-basic-multiple" name="attachments[]" multiple="multiple" style="width: 100%">
															@foreach ($attachmentLists as $data)
																<option value="{{ $data->id }}">{{ $data->name }}</option>
															@endforeach
														</select>
														<input type="text" name="attachment_ref_id" hidden>
														<small id="docHelp" class="form-text text-muted">Please Select Attachments.</small>
													</div>
												</div>
												<hr>
												<div class="col-sm-12" align="center">
													<h5>Document Update</h5><br><hr>
												</div>
												<div class="col-sm-6">
													<textarea id="simpleMde" name="report" style="display: none;"></textarea>
											   </div>	
											   <div class="col-md-6">
												<div class="table-responsive">
													<table id="words-data-table" class="table table-bordered table-condensed" width="100%">
														<thead>
															<tr>
																<th>Actions</th>
															</tr>
														</thead>
														<tbody>
															@foreach($actions as $action)
																<tr>
																	<td>{{ $action->name }}</td>
																</tr>
															@endforeach
														</tbody>
														<tfoot>
															<tr>
																<th>Actions</th>
															</tr>
														</tfoot>
													</table>
												</div>
											</div>
											</div>										
										</div>
										<div align="center" style="margin-top: 2em;">	
											{{-- <button disabled class="btn btn-outline-primary" type=button id="btnverzenden2" style="display: none"><span class="glyphicon glyphicon-refresh"></span>Submitting</button>    --}}
											<button class="btn btn-outline-primary" type=submit name=verzenden id="btnverzenden">Submit</button>
											<a href="/endorsement" class="btn btn-outline-primary">Back</a>
										</div>	
									</div>
								</div>
							</div>
							@break
						{{-- MBO --}}
						@case(auth()->user()->offices_id == 18)
							<div class="col-md-12">
								<div class="grid">
									<div class="grid-header bg-primary">
										<p class="card-title text-white ml-n1">Endorse Document</p>
									</div>
									<div class="grid-body">
										<div class="item-wrapper">
											<div class="row">
												<div class="col-sm-6">							
													<div class="form-group">
														<label for="inputDOE">Date of Endorsement</label>
														<input type="date" class="form-control" id="inputDOE" name="date_endorsed" aria-describedby="DOEHelp" placeholder="Date of Endorse" required>
														<small id="DOEHelp" class="form-text text-muted">Please enter the date of endorsement.</small>
													</div>	
												</div>
												<div class="form-group">
													<label for="selectROffice">Receiving Office</label>
													<select class="custom-select" name="receiving_offices_id">
													<option value="">Click to select</option>		
													{{-- @foreach ($receiving_offices as $office)					 --}}
														{{-- <option value="{{$office->id}}"> {{ $office->name}} </option> --}}
													{{-- @endforeach --}}
													<option value="18">Municipal Budget Office</option>
													<option value="24">Municipal Mayor's Office</option>
													<option value="5">Bids & Awards Committee</option>
													<option value="6">Purchasing Office</option>
													<option value="9">General Services Office</option>
													<option value="19">Municipal Accounting Office</option>
													<option value="20">Municipal Treasurer's Office</option>
													
													</select>

													<small id="rofficeHelp" class="form-text text-muted">Please select receiving office.</small>
													
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<label for="selectStatus">Endorsement Status</label>
														<select class="custom-select" name="statuses_id"  required>
														<option value="">Select Status</option>
														<option value="2">Endorse Document</option>
														<option value="4">Complete Transaction</option>
														</select>
														<small id="rofficeHelp" class="form-text text-muted">Please select endorsement status.</small>
													</div>
													<div class="form-group">
														<label for="selectRS">Receiving Staff</label>
														<select class="custom-select" name="receivingstaff_id">
															{{-- @foreach($users as $user)
																<option value="{{ $user->id }}">{{ $user->name }} - {{ $user->initials }}</option>
															@endforeach --}}
															<option value="1">MMO - Rhea Jill Palahang - R.J.P</option>
															<option value="2">BAC - Hazel Acusar - H.A</option>
															<option value="3">MBO - Neil Darwin Cadampog - N.D.C</option>
															<option value="8">MBO - Nikki Lou Cortes - N.L.C</option>
															<option value="5">PO - Arnel Lacubtan - A.L</option>
															<option value="7">PO - Melven Abaquita - M.A</option>
															<option value="9">GSO - Bernadette Quipit - B.Q</option>
															<option value="15">GSO - Julius Jerome Alo - J.J.A</option>
															<option value="27">MACCO - Mytha Zeana R. Aganon - M.Z.A</option>
															<option value="17">MTO - Annie Relacion - A.R</option>
															<option value="18">MTO - Dindo Yecyec - D.Y</option>
														</select>
													</div>
												</div>
												{{-- <div class="col-sm-6">
													<div class="form-group">
														<label for="selectStatus">Action Taken</label>
														<select class="custom-select" name="remarks"  required>
															<option value="">Select Status</option>
															@foreach($actions as $action)
																<option value="{{ $action->id }}">{{ $action->name }}</option>
															@endforeach
														</select>
														<small id="rofficeHelp" class="form-text text-muted">Please select action status.</small>
													</div>
												</div> --}}

												{{-- Attachments --}}

												<div class="col-sm-12">
													<div class="form-group">
														<label for="inputAttachments">Attachments</label><br>
														{{-- <input type="text" class="form-control" id="inputAttachments" name="attachments" aria-describedby="doeHelp" placeholder="Attachments" required> --}}
														<select class="js-example-basic-multiple" name="attachments[]" multiple="multiple" style="width: 100%">
															@foreach ($attachmentLists as $data)
																<option value="{{ $data->id }}">{{ $data->name }}</option>
															@endforeach
														</select>
														<input type="text" name="attachment_ref_id" hidden>
														<small id="docHelp" class="form-text text-muted">Please Select Attachments.</small>
													</div>
												</div>	
												<hr>
												<div class="col-sm-12" align="center">
													<h5>Document Update</h5><br><hr>
												</div>
												<div class="col-sm-6">
													<textarea id="simpleMde" name="report" style="display: none;"></textarea>
											   </div>
											   <div class="col-md-6">
												<div class="table-responsive">
													<table id="words-data-table" class="table table-bordered table-condensed" width="100%">
														<thead>
															<tr>
																<th>Actions</th>
															</tr>
														</thead>
														<tbody>
															@foreach($actions as $action)
																<tr>
																	<td>{{ $action->name }}</td>
																</tr>
															@endforeach
														</tbody>
														<tfoot>
															<tr>
																<th>Actions</th>
															</tr>
														</tfoot>
													</table>
												</div>
											</div>
											</div>										
										</div>
										<div align="center" style="margin-top: 2em;">	
											{{-- <button disabled class="btn btn-outline-primary" type=button id="btnverzenden2" style="display: none"><span class="glyphicon glyphicon-refresh"></span>Submitting</button>    --}}
											<button class="btn btn-outline-primary" type=submit name=verzenden id="btnverzenden">Submit</button>
											<a href="/endorsement" class="btn btn-outline-primary">Back</a>
										</div>	
									</div>
								</div>
							</div>
							@break
						{{-- BAC --}}
						@case(auth()->user()->offices_id == 5)
							<div class="col-md-12">
								<div class="grid">
									<div class="grid-header bg-primary">
										<p class="card-title text-white ml-n1">Endorse Document</p>
									</div>
									<div class="grid-body">
										<div class="item-wrapper">
											<div class="row">
												<div class="col-sm-6">							
													<div class="form-group">
														<label for="inputDOE">Date of Endorsement</label>
														<input type="date" class="form-control" id="inputDOE" name="date_endorsed" aria-describedby="DOEHelp" placeholder="Date of Endorse" required>
														<small id="DOEHelp" class="form-text text-muted">Please enter the date of endorsement.</small>
													</div>	
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<label for="selectROffice">Receiving Office</label>
														<select class="custom-select" name="receiving_offices_id">
														<option value="">Click to select</option>		
														{{-- @foreach ($receiving_offices as $office)					 --}}
															{{-- <option value="{{$office->id}}"> {{ $office->name}} </option> --}}
														{{-- @endforeach --}}
														<option value="18">Municipal Budget Office</option>
														<option value="24">Municipal Mayor's Office</option>
														<option value="5">Bids & Awards Committee</option>
														<option value="6">Purchasing Office</option>
														<option value="9">General Services Office</option>
														<option value="19">Municipal Accounting Office</option>
														<option value="20">Municipal Treasurer's Office</option>
														
														</select>
														<small id="rofficeHelp" class="form-text text-muted">Please select receiving office.</small>

													</div>

													<input type="hidden" class="form-control" id="inputTransactionid" name="endorsing_offices_id" value="{{ auth()->user()->offices_id }}">

													<input type="hidden" class="form-control" id="inputTransactionid" name="transactions_id" value="{{ $endorsements->transactions->id }}">
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<label for="selectStatus">Endorsement Status</label>
														<select class="custom-select" name="statuses_id"  required>
														<option value="">Select Status</option>
														<option value="2">Endorse Document</option>
														<option value="4">Complete Transaction</option>
														</select>
														<small id="rofficeHelp" class="form-text text-muted">Please select endorsement status.</small>
													</div>
													<div class="form-group">
														<label for="selectRS">Receiving Staff</label>
														<select class="custom-select" name="receivingstaff_id">
															{{-- @foreach($users as $user)
																<option value="{{ $user->id }}">{{ $user->name }} - {{ $user->initials }}</option>
															@endforeach --}}
															<option value="1">MMO - Rhea Jill Palahang - R.J.P</option>
															<option value="2">BAC - Hazel Acusar - H.A</option>
															<option value="3">MBO - Neil Darwin Cadampog - N.D.C</option>
															<option value="8">MBO - Nikki Lou Cortes - N.L.C</option>
															<option value="5">PO - Arnel Lacubtan - A.L</option>
															<option value="7">PO - Melven Abaquita - M.A</option>
															<option value="9">GSO - Bernadette Quipit - B.Q</option>
															<option value="15">GSO - Julius Jerome Alo - J.J.A</option>
															<option value="27">MACCO - Mytha Zeana R. Aganon - M.Z.A</option>
															<option value="17">MTO - Annie Relacion - A.R</option>
															<option value="18">MTO - Dindo Yecyec - D.Y</option>
														</select>
													</div>
												</div>
												{{-- <div class="col-sm-6">
													<div class="form-group">
														<label for="selectStatus">Action Taken</label>
														<select class="custom-select" name="remarks"  required>
															<option value="">Select Status</option>
															@foreach($actions as $action)
																<option value="{{ $action->id }}">{{ $action->name }}</option>
															@endforeach
														</select>
														<small id="rofficeHelp" class="form-text text-muted">Please select action status.</small>
													</div>
												</div> --}}

												{{-- Attachments --}}

												<div class="col-sm-6">
													<div class="form-group">
														<label for="inputAttachments">Attachments</label><br>
														{{-- <input type="text" class="form-control" id="inputAttachments" name="attachments" aria-describedby="doeHelp" placeholder="Attachments" required> --}}
														<select class="js-example-basic-multiple" name="attachments[]" multiple="multiple" style="width: 100%">
															@foreach ($attachmentLists as $data)
																<option value="{{ $data->id }}">{{ $data->name }}</option>
															@endforeach
														</select>
														<input type="text" name="attachment_ref_id" hidden>
														<small id="docHelp" class="form-text text-muted">Please Select Attachments.</small>
													</div>
												</div>
												<hr>
												<div class="col-sm-12" align="center">
													<h5>Document Update</h5><br><hr>	
												</div>
												<div class="col-sm-6">
													<textarea id="simpleMde" name="report" style="display: none;"></textarea>
											   </div>	
											   <div class="col-md-6">
												<div class="table-responsive">
													<table id="words-data-table" class="table table-bordered table-condensed" width="100%">
														<thead>
															<tr>
																<th>Actions</th>
															</tr>
														</thead>
														<tbody>
															@foreach($actions as $action)
																<tr>
																	<td>{{ $action->name }}</td>
																</tr>
															@endforeach
														</tbody>
														<tfoot>
															<tr>
																<th>Actions</th>
															</tr>
														</tfoot>
													</table>
												</div>
											</div>
											</div>										
										</div>
										<div align="center" style="margin-top: 2em;">	
											{{-- <button disabled class="btn btn-outline-primary" type=button id="btnverzenden2" style="display: none"><span class="glyphicon glyphicon-refresh"></span>Submitting</button>    --}}
											<button class="btn btn-outline-primary" type=submit name=verzenden id="btnverzenden">Submit</button>
											<a href="/endorsement" class="btn btn-outline-primary">Back</a>
										</div>	
									</div>
								</div>
							</div>
							@break
						{{-- GSO/Purchasing Office --}}
						@case(auth()->user()->offices_id == 6)
							<div class="col-md-12">
								<div class="grid">
									<div class="grid-header bg-primary">
										<p class="card-title text-white ml-n1">Endorse Document</p>
									</div>
									<div class="grid-body">
										<div class="item-wrapper">
											<div class="row">
												<div class="col-sm-6">							
													<div class="form-group">
														<label for="inputDOE">Date of Endorsement</label>
														<input type="date" class="form-control" id="inputDOE" name="date_endorsed" aria-describedby="DOEHelp" placeholder="Date of Endorse" required>
														<small id="DOEHelp" class="form-text text-muted">Please enter the date of endorsement.</small>
													</div>	
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<label for="selectROffice">Receiving Office</label>
														<select class="custom-select" name="receiving_offices_id" id="process_selector">
														<option value="">Click to select</option>		
														{{-- @foreach ($receiving_offices as $office)					 --}}
															{{-- <option value="{{$office->id}}"> {{ $office->name}} </option> --}}
														{{-- @endforeach --}}
														<option value="18">Municipal Budget Office</option>
														<option value="24">Municipal Mayor's Office</option>
														<option value="5">Bids & Awards Committee</option>
														<option value="6">Purchasing Office</option>
														<option value="9">General Services Office</option>
														<option value="19">Municipal Accounting Office</option>
														<option value="20">Municipal Treasurer's Office</option>
														<option value="35">Supplier</option>
														
														</select>
														<small id="rofficeHelp" class="form-text text-muted">Please select receiving office.</small>

													</div>

													<input type="hidden" class="form-control" id="inputTransactionid" name="endorsing_offices_id" value="{{ auth()->user()->offices_id }}">

													<input type="hidden" class="form-control" id="inputTransactionid" name="transactions_id" value="{{ $endorsements->transactions->id }}">
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<label for="selectStatus">Endorsement Status</label>
														<select class="custom-select" name="statuses_id"  required>
														<option value="">Select Status</option>
														<option value="2">Endorse Document</option>
														<option value="4">Complete Transaction</option>
														</select>
														<small id="rofficeHelp" class="form-text text-muted">Please select endorsement status.</small>
													</div>
													<div class="form-group">
														<label for="selectRS">Receiving Staff</label>
														<select class="custom-select" name="receivingstaff_id">
															{{-- @foreach($users as $user)
																<option value="{{ $user->id }}">{{ $user->name }} - {{ $user->initials }}</option>
															@endforeach --}}
															<option value="1">MMO - Rhea Jill Palahang - R.J.P</option>
															<option value="2">BAC - Hazel Acusar - H.A</option>
															<option value="3">MBO - Neil Darwin Cadampog - N.D.C</option>
															<option value="8">MBO - Nikki Lou Cortes - N.L.C</option>
															<option value="5">PO - Arnel Lacubtan - A.L</option>
															<option value="7">PO - Melven Abaquita - M.A</option>
															<option value="9">GSO - Bernadette Quipit - B.Q</option>
															<option value="15">GSO - Julius Jerome Alo - J.J.A</option>
															<option value="27">MACCO - Mytha Zeana R. Aganon - M.Z.A</option>
															<option value="17">MTO - Annie Relacion - A.R</option>
															<option value="18">MTO - Dindo Yecyec - D.Y</option>
														</select>
													</div>
												</div>
												{{-- <div class="col-sm-6">
													<div class="form-group">
														<label for="selectStatus">Action Taken</label>
														<select class="custom-select" name="remarks"  required>
															<option value="">Select Status</option>
															@foreach($actions as $action)
																<option value="{{ $action->id }}">{{ $action->name }}</option>
															@endforeach
														</select>
														<small id="rofficeHelp" class="form-text text-muted">Please select action status.</small>
													</div>
												</div> --}}

												{{-- Attachments --}}

												<div class="col-sm-6">
													<div class="form-group">
														<label for="inputAttachments">Attachments</label><br>
														{{-- <input type="text" class="form-control" id="inputAttachments" name="attachments" aria-describedby="doeHelp" placeholder="Attachments" required> --}}
														<select class="js-example-basic-multiple" name="attachments[]" multiple="multiple" style="width: 100%">
															@foreach ($attachmentLists as $data)
																<option value="{{ $data->id }}">{{ $data->name }}</option>
															@endforeach
														</select>
														<input type="text" name="attachment_ref_id" hidden>
														<small id="docHelp" class="form-text text-muted">Please Select Attachments.</small>
													</div>
												</div>
												<div class="col-sm-6">
													<div class="selectTypePR" id="Canvasser" style="display: none;">
																					
														<div class="form-group">
															<label for="inputCanvasser">Name of Canvasser</label>
															<select class="custom-select" name="canvasser">
															<option value="">Select Status</option>
															<option value="1">Joel Salonoy</option>
															<option value="2">Melvin Abaquita</option>
															<option value="3">Marilou Elemento</option>
															</select>
														</div>	
													
													</div>
												</div>
												<hr>
												<div class="col-sm-12" align="center">
													<h5>Document Update</h5><br><hr>
												</div>
												<div class="col-sm-6">
													<textarea id="simpleMde" name="report" style="display: none;"></textarea>
											   </div>
											   <div class="col-md-6">
												<div class="table-responsive">
													<table id="words-data-table" class="table table-bordered table-condensed" width="100%">
														<thead>
															<tr>
																<th>Actions</th>
															</tr>
														</thead>
														<tbody>
															@foreach($actions as $action)
																<tr>
																	<td>{{ $action->name }}</td>
																</tr>
															@endforeach
														</tbody>
														<tfoot>
															<tr>
																<th>Actions</th>
															</tr>
														</tfoot>
													</table>
												</div>
											</div>	
											</div>										
										</div>
										<div align="center" style="margin-top: 2em;">	
											{{-- <button disabled class="btn btn-outline-primary" type=button id="btnverzenden2" style="display: none"><span class="glyphicon glyphicon-refresh"></span>Submitting</button>    --}}
											<button class="btn btn-outline-primary" type=submit name=verzenden id="btnverzenden">Submit</button>
											<a href="/endorsement" class="btn btn-outline-primary">Back</a>
										</div>	
									</div>
								</div>
							</div>
							@break
						{{-- GSO --}}
						@case(auth()->user()->offices_id == 9)
							<div class="col-md-12">
								<div class="grid">
									<div class="grid-header bg-primary">
										<p class="card-title text-white ml-n1">Endorse Document</p>
									</div>
									<div class="grid-body">
										<div class="item-wrapper">
											<div class="row">
												<div class="col-sm-6">							
													<div class="form-group">
														<label for="inputDOE">Date of Endorsement</label>
														<input type="date" class="form-control" id="inputDOE" name="date_endorsed" aria-describedby="DOEHelp" placeholder="Date of Endorse" required>
														<small id="DOEHelp" class="form-text text-muted">Please enter the date of endorsement.</small>
													</div>	
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<label for="selectROffice">Receiving Office</label>
														<select class="custom-select" name="receiving_offices_id" id="process_selector">
														<option value="">Click to select</option>		
														<option value="18">Municipal Budget Office</option>
														<option value="24">Municipal Mayor's Office</option>
														<option value="5">Bids & Awards Committee</option>
														<option value="6">Purchasing Office</option>
														<option value="9">General Services Office</option>
														<option value="19">Municipal Accounting Office</option>
														<option value="20">Municipal Treasurer's Office</option>
														<option value="35">Supplier</option>
														
														</select>
														<small id="rofficeHelp" class="form-text text-muted">Please select receiving office.</small>

													</div>

													<input type="hidden" class="form-control" id="inputTransactionid" name="endorsing_offices_id" value="{{ auth()->user()->offices_id }}">

													<input type="hidden" class="form-control" id="inputTransactionid" name="transactions_id" value="{{ $endorsements->transactions->id }}">
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<label for="selectStatus">Endorsement Status</label>
														<select class="custom-select" name="statuses_id"  required>
														<option value="">Select Status</option>
														<option value="2">Endorse Document</option>
														<option value="4">Complete Transaction</option>
														</select>
														<small id="rofficeHelp" class="form-text text-muted">Please select endorsement status.</small>
													</div>
													<div class="form-group">
														<label for="selectRS">Receiving Staff</label>
														<select class="custom-select" name="receivingstaff_id">
															{{-- @foreach($users as $user)
																<option value="{{ $user->id }}">{{ $user->name }} - {{ $user->initials }}</option>
															@endforeach --}}
															<option value="1">MMO - Rhea Jill Palahang - R.J.P</option>
															<option value="2">BAC - Hazel Acusar - H.A</option>
															<option value="3">MBO - Neil Darwin Cadampog - N.D.C</option>
															<option value="8">MBO - Nikki Lou Cortes - N.L.C</option>
															<option value="5">PO - Arnel Lacubtan - A.L</option>
															<option value="7">PO - Melven Abaquita - M.A</option>
															<option value="9">GSO - Bernadette Quipit - B.Q</option>
															<option value="15">GSO - Julius Jerome Alo - J.J.A</option>
															<option value="27">MACCO - Mytha Zeana R. Aganon - M.Z.A</option>
															<option value="17">MTO - Annie Relacion - A.R</option>
															<option value="18">MTO - Dindo Yecyec - D.Y</option>
														</select>
													</div>
												</div>
												
												<div class="col-sm-6">
													<div class="form-group">
														<label for="inputAttachments">Attachments</label><br>
														{{-- <input type="text" class="form-control" id="inputAttachments" name="attachments" aria-describedby="doeHelp" placeholder="Attachments" required> --}}
														<select class="js-example-basic-multiple" name="attachments[]" multiple="multiple" style="width: 100%">
															@foreach ($attachmentLists as $data)
																<option value="{{ $data->id }}">{{ $data->name }}</option>
															@endforeach
														</select>
														<input type="text" name="attachment_ref_id" hidden>
														<small id="docHelp" class="form-text text-muted">Please Select Attachments.</small>
													</div>
												</div>
												<hr>
												<div class="col-sm-12" align="center">
													<h5>Document Update</h5><br><hr>
												</div>
												<div class="col-sm-6">
													<textarea id="simpleMde" name="report" style="display: none;"></textarea>
											</div>
											<div class="col-md-6">
												<div class="table-responsive">
													<table id="words-data-table" class="table table-bordered table-condensed" width="100%">
														<thead>
															<tr>
																<th>Actions</th>
															</tr>
														</thead>
														<tbody>
															@foreach($actions as $action)
																<tr>
																	<td>{{ $action->name }}</td>
																</tr>
															@endforeach
														</tbody>
														<tfoot>
															<tr>
																<th>Actions</th>
															</tr>
														</tfoot>
													</table>
												</div>
											</div>	
											</div>										
										</div>
										<div align="center" style="margin-top: 2em;">	
											{{-- <button disabled class="btn btn-outline-primary" type=button id="btnverzenden2" style="display: none"><span class="glyphicon glyphicon-refresh"></span>Submitting</button>    --}}
											<button class="btn btn-outline-primary" type=submit name=verzenden id="btnverzenden">Submit</button>
											<a href="/endorsement" class="btn btn-outline-primary">Back</a>
										</div>	
									</div>
								</div>
							</div>
							@break
						@default
							<div class="col-md-12">
								<div class="grid">
									<div class="grid-header bg-primary">
										<p class="card-title text-white ml-n1">Endorse Document</p>
									</div>
									<div class="grid-body">
										<div class="item-wrapper">
											<div class="row">
												<div class="col-sm-6">							
													<div class="form-group">
														<label for="inputDOE">Date of Endorsement</label>
														<input type="date" class="form-control" id="inputDOE" name="date_endorsed" aria-describedby="DOEHelp" placeholder="Date of Endorse" required>
														<small id="DOEHelp" class="form-text text-muted">Please enter the date of endorsement.</small>
													</div>	
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<label for="selectROffice">Receiving Office</label>
														<select class="custom-select" name="receiving_offices_id">
														<option value="">Click to select</option>		
														{{-- @foreach ($receiving_offices as $office)					 --}}
															{{-- <option value="{{$office->id}}"> {{ $office->name}} </option> --}}
														{{-- @endforeach --}}
														<option value="18">Municipal Budget Office</option>
														<option value="24">Municipal Mayor's Office</option>
														<option value="5">Bids & Awards Committee</option>
														<option value="6">Purchasing Office</option>
														<option value="9">General Services Office</option>
														<option value="19">Municipal Accounting Office</option>
														<option value="20">Municipal Treasurer's Office</option>
														
														</select>
														<small id="rofficeHelp" class="form-text text-muted">Please select receiving office.</small>
													</div>

													<input type="hidden" class="form-control" id="inputTransactionid" name="endorsing_offices_id" value="{{ auth()->user()->offices_id }}">
													<input type="hidden" class="form-control" id="inputTransactionid" name="transactions_id" value="{{ $endorsements->transactions->id }}">
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<label for="selectStatus">Endorsement Status</label>
														<select class="custom-select" name="statuses_id"  required>
														<option value="">Select Status</option>
														<option value="2">Endorse Document</option>
														</select>
														<small id="rofficeHelp" class="form-text text-muted">Please select endorsement status.</small>
													</div>
													<div class="form-group">
														<label for="selectRS">Receiving Staff</label>
														<select class="custom-select" name="receivingstaff_id">
															{{-- @foreach($users as $user)
																<option value="{{ $user->id }}">{{ $user->name }} - {{ $user->initials }}</option>
															@endforeach --}}
															<option value="1">MMO - Rhea Jill Palahang - R.J.P</option>
															<option value="2">BAC - Hazel Acusar - H.A</option>
															<option value="3">MBO - Neil Darwin Cadampog - N.D.C</option>
															<option value="8">MBO - Nikki Lou Cortes - N.L.C</option>
															<option value="5">PO - Arnel Lacubtan - A.L</option>
															<option value="7">PO - Melven Abaquita - M.A</option>
															<option value="9">GSO - Bernadette Quipit - B.Q</option>
															<option value="15">GSO - Julius Jerome Alo - J.J.A</option>
															<option value="27">MACCO - Mytha Zeana R. Aganon - M.Z.A</option>
															<option value="17">MTO - Annie Relacion - A.R</option>
															<option value="18">MTO - Dindo Yecyec - D.Y</option>
														</select>
													</div>
												</div>
												{{-- <div class="col-sm-6">
													<div class="form-group">
														<label for="selectStatus">Action Taken</label>
														<select class="custom-select" name="remarks"  required>
															<option value="">Select Status</option>
															@foreach($actions as $action)
																<option value="{{ $action->id }}">{{ $action->name }}</option>
															@endforeach
															</select>
														<small id="rofficeHelp" class="form-text text-muted">Please select action status.</small>
													</div>
												</div> --}}
												{{-- Attachments --}}

												<div class="col-sm-6">
													<div class="form-group">
														<label for="inputAttachments">Attachments</label><br>
														{{-- <input type="text" class="form-control" id="inputAttachments" name="attachments" aria-describedby="doeHelp" placeholder="Attachments" required> --}}
														<select class="js-example-basic-multiple" name="attachments[]" multiple="multiple" style="width: 100%">
															@foreach ($attachmentLists as $data)
																<option value="{{ $data->id }}">{{ $data->name }}</option>
															@endforeach
														</select>
														<input type="text" name="attachment_ref_id" hidden>
														<small id="docHelp" class="form-text text-muted">Please Select Attachments.</small>
													</div>
												</div>
												<hr>
												<div class="col-sm-12" align="center">
													<br>
													<h5>Document Update</h5><br><hr>	
												</div>
												<div class="col-sm-6">
													<textarea id="simpleMde" name="report" style="display: none;"></textarea>
											   </div>
											   <div class="col-md-6">
												<div class="table-responsive">
													<table id="words-data-table" class="table table-bordered table-condensed" width="100%">
														<thead>
															<tr>
																<th>Actions</th>
															</tr>
														</thead>
														<tbody>
															@foreach($actions as $action)
																<tr>
																	<td>{{ $action->name }}</td>
																</tr>
															@endforeach
														</tbody>
														<tfoot>
															<tr>
																<th>Actions</th>
															</tr>
														</tfoot>
													</table>
												</div>
											</div>
											</div>										
										</div>
										{{-- <div align="center">
											<button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#info-modal"> Click Me Important! </button>
											<hr>
										</div> --}}
										<div align="center" style="margin-top: 2em;">	
											{{-- <button disabled class="btn btn-outline-primary" type=button id="btnverzenden2" style="display: none"><span class="glyphicon glyphicon-refresh"></span>Submitting</button>    --}}
											<button class="btn btn-outline-primary" type=submit name=verzenden id="btnverzenden">Submit</button>
											<a href="/endorsement" class="btn btn-outline-primary">Back</a>
										</div>	
									</div>
								</div>
								{{-- <div class="modal fade" tabindex="-1" role="dialog" id="info-modal" style="display: none;" aria-hidden="true">
									<div class="modal-dialog" role="document">
									  <div class="modal-content">
										<div class="modal-header">
											<strong>Important Reminder</strong>
										  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										  </button>
										</div>
										<div class="modal-body">
										  <div class="d-flex flex-column justify-content-center align-items-center">
											<i class="mdi mdi-account-multiple mdi-4x text-primary"></i>
											<h5 class="text-black font-weight-medium mb-4">Document Update Reminder</h5>
											<p>Please be reminded that all endorsed documents must contain an<strong> update</strong> from the endorsing office. To create an update, please go to <strong>Home > Track Documents > Find Records > Document Update > Create Update</strong></p>
										  </div>
										</div>
										<div class="modal-footer d-flex justify-content-center">
										  <button type="button" class="btn btn-sm btm-outline-primary" data-dismiss="modal">Got it!</button>
										</div>
									  </div>
									</div>
								</div> --}}
							</div>
					@endswitch
				</div>
			</div>	       	   
		</form>
	</div>
@endsection
@section('script')
	{{-- <script>
		$(function(){
			$("#btnverzenden").click(function () {
				$("#btnverzenden").hide(); 
				$("#btnverzenden2").show(); 
			});
		});
	</script> --}}
	<script>
		function disableFunction() {
			$('#btnverzenden').prop('disabled', true);
		}
	</script>
	<script>
		$('div.alert').not('.alert-important').delay(3000).fadeOut(350);
	</script>

	<script>
		$(document).ready(function() {
			$('.js-example-basic-multiple').select2();
		});
	</script>

	<script>
		$(function() {
			$('#words-data-table').DataTable();
		});
	</script>

	<script>
		$(document).ready(function(){
		    $('#process_selector').on('change', function() {
		    	if ( this.value != '35')
			    {
			        $("#Canvasser").hide();
						
			    }
		      	//If red is selected, show red, hide yellow and blue.
		      	if ( this.value == '35')
		      	{
		        	$("#Canvasser").show();
		      	}
		      
		    });
		});
	</script>
@endsection
