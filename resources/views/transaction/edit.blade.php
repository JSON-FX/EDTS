@extends('layouts.app')
@section('content')
	<div class="container">
		@include('flash::message')
		<form action="/update/transaction/{{ $transactions->id }}" method ="POST" onSubmit='disableFunction()'>
			@csrf
			<div class="col-md-12">
				<div class="row">
					@switch($transactions->process_types->name)
						@case($transactions->process_types->name = "Purchase Request")
							<div class="col-md-12">
								<div class="grid">
									<div class="grid-header">
										Information
									</div>
									<div class="grid-body">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="labelDateOfEntry"><strong>Date of Entry</strong></label>
													<p><small>{{ $transactions->date_of_entry }}</small></p>
												</div>
		
												<div class="form-group">
													<label for="labelReferenceNo"><strong>Reference No.</strong></label>
													<p><small>{{ $transactions->reference_id }}</small></p>
												</div>
		
												<div class="form-group">
													<label for="labelOffices"><strong>Office</strong></label>
													<p><small>{{ $transactions->offices->name }}</small></p>
												</div>
		
												<div class="form-group">
													<label for="labelApprovedBudgetForTheContract"><strong>Approved Budget for the Contract <i>(ABC)</i></strong></label>
													<div class="col-md-5">
														<input type="text" class="form-control" id="inputType5" value="{{ number_format($transactions->amount, 2, '.', ',') }}" disabled="">
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="labelDescription"><strong>Description</strong></label>
													<p><small>{{ $transactions->description }}</small></p>
												</div>
		
												<div class="form-group">
													<label for="labelParticulars"><strong>Particulars</strong></label>
													<p><small>{{ $transactions->pr_descriptions->name }}</small></p>
												</div>
		
												<div class="form-group">
											<label for="labelDocumentHolder"><strong>Current Document Holder</strong></label>
											@switch($transactions->statuses->name)
												@case($transactions->statuses->name = "None")
													<p><small>{{ $transactions->users->name }}</small></p>
													<p><small>{{ $transactions->users->offices->name }}</small></p>
													<p><strong style="color:red">Document has not been endorsed yet.</strong></p>
													@break
												@case($transactions->statuses->name = "Complete")
													<p><small>{{ $transactions->users->name }}</small></p>
													<p><small>{{ $transactions->users->offices->name }}</small></p>
													<p><strong style="color:green">Document has been completely processed</strong></p>							
													@break
												@case($transactions->statuses->name = "In Progress")
													<p><small>{{ $transactions->users->name }}</small></p>
													<p><small>{{ $transactions->users->offices->name }}</small></p>
													@break
												@case($transactions->statuses->name = "Cancelled")
													<p><small>{{ $office_holder->offices->name }} -  Document has been cancelled.</small></p>
													@break
												@default
											@endswitch
										</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="grid">
									<div class="grid-header">
										Purchase Request
									</div>
									<div class="grid-body">
										{{-- Purchase Request --}}
										<div class="selectTypePR" id="PR">
											{{--Office--}}
											<div class="form-group">
												<label for="selectOffice">Office Concern</label>
												<select class="custom-select" name="offices_id"  required>
												<option value="{{ $transactions->offices_id }}">{{ $transactions->offices->name }} - Current</option>		
												@foreach ($offices as $office)					
													<option value="{{$office->id}}"> {{ $office->name}}
													</option>
												@endforeach
												</select>
												<small id="officeHelp" class="form-text text-muted">Please select Office Concern.</small>
											</div>

											{{--Purchase Request Number--}}
											<div class="form-group">
												<label for="inputEstamount">Reference No.</label>
												<input type="text" class="form-control" id="inputPrnumber" name="pr_number" value="{{ $transactions->reference_id }}" aria-describedby="prnumberHelp" required>
												<small id="prnumberHelp" class="form-text text-muted">Please enter Reference No.</small>
											</div>	
								
											{{--Purchase Request Description--}}
											<div class="form-group">
												<label for="selectProcesstype">Particulars</label>
												<select class="custom-select" name="pr_descriptions_id" required>
												<option value="{{ $transactions->pr_descriptions_id }}">{{ $transactions->pr_descriptions->name }} - Current</option>		
												@foreach ($prdescriptions as $prdescription)	
													<option value="{{$prdescription->id}}"> {{ $prdescription->name}}
													</option>
												@endforeach
												</select>
												<small id="processtypeHelp" class="form-text text-muted">Select Particulars.</small>
											</div>

											{{--Purpose--}}
											<div class="form-group">
												<label for="inputPurpose">Purpose</label>
												<input type="text" class="form-control" id="inputPurpose" name="description" value="{{ $transactions->description }}" aria-describedby="purposeHelp">
												<small id="purposeHelp" class="form-text text-muted">Purchase Request Purpose</small>
											</div>	
	
	
											{{--Purchase Request  Estimated Amount--}}
											<div class="form-group">
												<label for="inputEstamount">Approved Budget for the Contract</label>
												<input type="text" class="form-control" id="PRInputEstamount" name="est_amount" value="{{ $transactions->amount }}" aria-describedby="estamountHelp" required>
												<small id="estamountHelp" class="form-text text-muted">Please enter the amount.</small>
											</div>
											<div class="form-group" align="center">
												<br>
												<p><small>Double Check before clicking submit.</small></p>
												{{-- <button disabled class="btn btn-outline-primary" type=button id="btnverzenden2" style="display: none"><span class="glyphicon glyphicon-refresh"></span>Submitting</button>    --}}
												<button class="btn btn-outline-primary" type=submit name=verzenden id="btnverzenden">Submit</button>
											</div>
										</div>
										{{-- End --}}
									</div>
								</div>
							</div>
							@break
						
							<div class="col-md-12">
								<div class="grid">
									<div class="grid-header">
										Information
									</div>
									<div class="grid-body">
										<table class="table table table-responsive-sm">
											<thead>
												<th>Reference No.</th>
												<th>Date of Entry</th>
												<th>Office</th>
											</thead>
											<tbody>
												<tr>
													<td><i>{{ $transactions->bar_code }}</i></td>
													<td><i>{{ $transactions->date_of_entry }}</i></td>
													<td><i>{{ $transactions->offices->name }}</i></td>
												</tr>
											</tbody>
										</table>
										<div class="col-md-7">
											<table class="table table table-responsive-sm">
												<thead>
													<th>Client</th>
													<th>Amount</th>
													<th>Status</th>
												</thead>
												<tbody>
													<tr>
														<td><i>{{ $transactions->client }}<i></td>
														<td><i>{{ number_format($transactions->amount, 2, '.', ',') }}</i></td>
														<td><i>
															@switch($transactions->statuses->name)
																@case($transactions->statuses->name = "Pending")
																	<span class="badge badge-pill badge-warning">{{ $transactions->statuses->name }}</span>
																	@break
																@case($transactions->statuses->name = "Complete")
																	<span class="badge badge-pill badge-success">{{ $transactions->statuses->name }}</span>								@break
																@case($transactions->statuses->name = "On Process")
																	<span class="badge badge-pill badge-warning">{{ $transactions->statuses->name }}</span>
																	@break
																@case($transactions->statuses->name = "On Hold")
																	<span class="badge badge-pill badge-danger">{{ $transactions->statuses->name }}</span>
																	@break
																@default
															@endswitch
														<i></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="grid">
									<div class="grid-header">
										Monetization of Leave Credits
									</div>
									<div class="grid-body">

										{{-- Monetization of Leave Credits --}}
											<div class="selectTypeMLC" id="MLC">
												{{--Office--}}
												<div class="form-group">
													<label for="selectOffice">Office</label>
													<select class="custom-select" name="offices_id"  required>
													<option value="{{ $transactions->offices_id }}">{{ $transactions->offices->name }} - Current</option>		
													@foreach ($offices as $office)					
														<option value="{{$office->id}}"> {{ $office->name}}
														</option>
													@endforeach
													</select>
													<small id="officeHelp" class="form-text text-muted">Please select office.</small>
												</div>
												{{-- Beneficiary --}}
												<div class="form-group">
													<label for="supplier">Client</label>												
													<input id="MLCsupplier" type="text" name="supplier" value="{{ $transactions->client }}" class="form-control">
													<small id="rofficeHelp" class="form-text text-muted">Please input client information.</small>
												</div>

												{{--Purchase Request  Estimated Amount--}}
												<div class="form-group">
													<label for="inputEstamount">Amount</label>
													<input type="text" class="form-control" id="MLCnputEstamount" name="est_amount" value="{{ $transactions->amount }}" aria-describedby="estamountHelp" required>
													<small id="estamountHelp" class="form-text text-muted">Please enter the total amount.</small>
												</div>
											</div>
										{{-- End --}}
										
										<div class="form-group" align="center">
											<br>
											<p><small>Double Check before clicking submit.</small></p>
											{{-- <button disabled class="btn btn-outline-primary" type=button id="btnverzenden2" style="display: none"><span class="glyphicon glyphicon-refresh"></span>Submitting</button>    --}}
											<button class="btn btn-outline-primary" type=submit name=verzenden id="btnverzenden">Submit</button>
										</div>
									</div>
								</div>
							</div>
							@break
						{{-- @case($transactions->process_types->name = "Payroll-Overtime")
							<div class="col-md-12">
								<div class="grid">
									<div class="grid-header">
										Information
									</div>
									<div class="grid-body">
										<table class="table table table-responsive-sm">
											<thead>
												<th>Office</th>
												<th>Reference No.</th>
												<th>Date of Entry</th>
												<th>Client</th>
											</thead>
											<tbody>
												<tr>
													<td><i>{{ $transactions->offices->name }}</i></td>
													<td><i>{{ $transactions->bar_code }}</i></td>
													<td><i>{{ $transactions->date_of_entry }}</i></td>
													<td><i>{{ $transactions->client }}<i></td>
												</tr>
											</tbody>
										</table>
										<br><br>
										<div class="col-md-4">
											<table class="table table table-responsive-sm">
												<thead>
													<th>Amount</th>
													<th>Status</th>
												</thead>
												<tbody>
													<tr>
														<td><i>{{ number_format($transactions->amount, 2, '.', ',') }}</i></td>
														<td><i>
															@switch($transactions->statuses->name)
																@case($transactions->statuses->name = "Pending")
																	<span class="badge badge-pill badge-warning">{{ $transactions->statuses->name }}</span>
																	@break
																@case($transactions->statuses->name = "Complete")
																	<span class="badge badge-pill badge-success">{{ $transactions->statuses->name }}</span>								@break
																@case($transactions->statuses->name = "On Process")
																	<span class="badge badge-pill badge-warning">{{ $transactions->statuses->name }}</span>
																	@break
																@case($transactions->statuses->name = "On Hold")
																	<span class="badge badge-pill badge-danger">{{ $transactions->statuses->name }}</span>
																	@break
																@default
															@endswitch
														<i></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="grid">
									<div class="grid-header">
										Payroll Overtime
									</div>
									<div class="grid-body">

										
										<div class="selectTypePO" id="PO">
											
											<div class="form-group">
												<label for="selectOffice">Office</label>
												<select class="custom-select" name="offices_id"  required>
												<option value="{{ $transactions->offices_id }}">{{ $transactions->offices->name }} - Current</option>		
												@foreach ($offices as $office)					
													<option value="{{$office->id}}"> {{ $office->name}}
													</option>
												@endforeach
												</select>
												<small id="officeHelp" class="form-text text-muted">Please select office.</small>
											</div>

										
											<div class="form-group">
												<label for="selectOffice">Payroll Beneficiary</label>
												<select class="custom-select" name="supplier" required>
												<option value="{{ $transactions->client }}">{{ $transactions->client }} - Current</option>	
												<option value="Regular">Regular</option>	
												<option value="Casual">Casual</option>
												<option value="Job Order">Job Order</option>
												</select>
												<small id="officeHelp" class="form-text text-muted">Please select beneficiary.</small>
											</div>

											
											<div class="form-group">
												<label for="inputEstamount">Amount</label>
												<input type="text" class="form-control" id="POinputEstamount" name="est_amount" value="{{ $transactions->amount }}" aria-describedby="estamountHelp" required>
												<small id="estamountHelp" class="form-text text-muted">Please enter the total amount.</small>
											</div>
										</div>
									
										
										<div class="form-group" align="center">
											<br>
											<p><small>Double Check before clicking submit.</small></p>
											<button class="btn btn-md btn-outline-primary">Submit</button>
										</div>
									</div>
								</div>
							</div>
							@break
						@case($transactions->process_types->name = "Payroll-Salary") --}}
							<div class="col-md-12">
								<div class="grid">
									<div class="grid-header">
										Information
									</div>
									<div class="grid-body">
										<table class="table table table-responsive-sm">
											<thead>
												<th>Office</th>
												<th>Reference No.</th>
												<th>Date of Entry</th>
												<th>Client</th>
											</thead>
											<tbody>
												<tr>
													<td><i>{{ $transactions->offices->name }}</i></td>
													<td><i>{{ $transactions->bar_code }}</i></td>
													<td><i>{{ $transactions->date_of_entry }}</i></td>
													<td><i>{{ $transactions->client }}<i></td>
												</tr>
											</tbody>
										</table>
										<br><br>
										<div class="col-md-4">
											<table class="table table table-responsive-sm">
												<thead>
													<th>Amount</th>
													<th>Status</th>
												</thead>
												<tbody>
													<tr>
														<td><i>{{ number_format($transactions->amount, 2, '.', ',') }}</i></td>
														<td><i>
															@switch($transactions->statuses->name)
																@case($transactions->statuses->name = "Pending")
																	<span class="badge badge-pill badge-warning">{{ $transactions->statuses->name }}</span>
																	@break
																@case($transactions->statuses->name = "Complete")
																	<span class="badge badge-pill badge-success">{{ $transactions->statuses->name }}</span>								@break
																@case($transactions->statuses->name = "On Process")
																	<span class="badge badge-pill badge-warning">{{ $transactions->statuses->name }}</span>
																	@break
																@case($transactions->statuses->name = "On Hold")
																	<span class="badge badge-pill badge-danger">{{ $transactions->statuses->name }}</span>
																	@break
																@default
															@endswitch
														<i></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
								<div class="col-md-6">
									<div class="grid">
										<div class="grid-header">
											Payroll Salary
										</div>
										<div class="grid-body">
										
											<div class="selectTypePO" id="PS">
												
												<div class="form-group">
													<label for="selectOffice">Office</label>
													<select class="custom-select" name="offices_id"  required>
													<option value="{{ $transactions->offices_id }}">{{ $transactions->offices->name }} - Current</option>		
													@foreach ($offices as $office)					
														<option value="{{$office->id}}"> {{ $office->name}}
														</option>
													@endforeach
													</select>
													<small id="officeHelp" class="form-text text-muted">Please select office.</small>
												</div>

											
												<div class="form-group">
													<label for="selectOffice">Payroll Beneficiary</label>
													<select class="custom-select" name="supplier" required>
													<option value="{{ $transactions->client }}">{{ $transactions->client }} - Current</option>	
													<option value="Regular">Regular</option>	
													<option value="Casual">Casual</option>
													<option value="Job Order">Job Order</option>
													</select>
													<small id="officeHelp" class="form-text text-muted">Please select beneficiary.</small>
												</div>

												
												<div class="form-group">
													<label for="inputEstamount">Amount</label>
													<input type="text" class="form-control" id="POinputEstamount" name="est_amount" value="{{ $transactions->amount }}" aria-describedby="estamountHelp" required>
													<small id="estamountHelp" class="form-text text-muted">Please enter the total amount.</small>
												</div>
											</div>
										
											<div class="form-group" align="center">
												<br>
												<p><small>Double Check before clicking submit.</small></p>
												{{-- <button disabled class="btn btn-outline-primary" type=button id="btnverzenden2" style="display: none"><span class="glyphicon glyphicon-refresh"></span>Submitting</button>    --}}
												<button class="btn btn-outline-primary" type=submit name=verzenden id="btnverzenden">Submit</button>
											</div>
										</div>
									</div>
								</div>
								@break
						@case($transactions->process_types->name = "Voucher")
							<div class="col-md-12">
								<div class="grid">
									<div class="grid-header">Details</div>
									<div class="grid-body">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="labelDateOfEntry"><strong>Date of Entry</strong></label>
													<p><small>{{ $transactions->date_of_entry }}</small></p>
												</div>
		
												<div class="form-group">
													<label for="labelReferenceNo"><strong>Reference No.</strong></label>
													<p><small>{{ $transactions->reference_id }}</small></p>
												</div>
		
												<div class="form-group">
													<label for="labelSubReferenceNo"><strong>Sub Reference No.</strong></label>
													<p><small>{{ $transactions->sub_reference_id }}</small></p>
												</div>
		
												<div class="form-group">
													<label for="labelPRDescription"><strong>Particulars</strong></label>
													<p><small>{{ $transactions->pr_descriptions->name }}</small></p>
												</div>
		
												<div class="form-group">
													<label for="labelOffice"><strong>Office</strong></label>
													<p><small>{{ $transactions->offices->name }}</small></p>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="labelDescription"><strong>Description</strong></label>
													<p><small>{{ $transactions->description }}</small></p>
												</div>
		
												<div class="form-group">
													<label for="labelSupplier"><strong>Payee</strong></label>
													<p><small>{{ $transactions->client }}</small></p>
												</div>
		
												<div class="form-group">
													<label for="labelContract Price"><strong>Contract Price</strong></label>
													<div class="col-md-5">
														<input type="text" class="form-control" id="inputType5" value="{{ number_format($transactions->amount, 2, '.', ',') }}" disabled="">
													</div>
												</div>
		
												<div class="form-group">
											<label for="labelDocumentHolder"><strong>Current Document Holder</strong></label>
											@switch($transactions->statuses->name)
												@case($transactions->statuses->name = "None")
													<p><small>{{ $transactions->users->name }}</small></p>
													<p><small>{{ $transactions->users->offices->name }}</small></p>
													<p><strong style="color:red">Document has not been endorsed yet.</strong></p>
													@break
												@case($transactions->statuses->name = "Complete")
													<p><small>{{ $transactions->users->name }}</small></p>
													<p><small>{{ $transactions->users->offices->name }}</small></p>
													<p><strong style="color:green">Document has been completely processed</strong></p>							
													@break
												@case($transactions->statuses->name = "In Progress")
													<p><small>{{ $transactions->users->name }}</small></p>
													<p><small>{{ $transactions->users->offices->name }}</small></p>
													@break
												@case($transactions->statuses->name = "Cancelled")
													<p><small>{{ $office_holder->offices->name }} -  Document has been cancelled.</small></p>
													@break
												@default
											@endswitch
										</div>
											</div>
										</div>
									</div>
								</div>
								
							</div>
							<div class="col-md-6">
								<div class="grid">
									<div class="grid-header">Voucher Details</div>
									<div class="grid-body">
									
										<div class="form-group">
											<label for="inputReferenceIdVoucher">Voucher Reference No.</label>
											<input type="text" class="form-control" id="inputReferenceIdVoucher" name="reference_id" value="{{ $transactions->reference_id }}" aria-describedby="prnumberHelp" required>
											<small id="voucherHelp" class="form-text text-muted">Please enter Reference number.</small>
										</div>
										
										
										<div class="form-group">
											<label for="inputReferenceIdMain">Document Reference No.</label>
											<input type="text" class="form-control" id="inputReferenceIdMain" name="sub_reference_id" value="{{ $transactions->sub_reference_id }}" aria-describedby="prnumberHelp">
											<small id="referenceIdMainHelp" class="form-text text-muted">Please enter main Reference number.</small>
										</div>
	
										
										<div class="form-group">
											<label for="selectOffice">Office Concern</label>
											<select class="custom-select" name="offices_id"  required>
												<option value="{{ $transactions->offices_id }}">{{ $transactions->offices->name }} - Current</option>
											@foreach ($offices as $office)					
												<option value="{{$office->id}}"> {{ $office->name }}
												</option>
											@endforeach
											</select>
											<small id="officeHelp" class="form-text text-muted">Please select Office Concern.</small>
										</div>
	
										
										<div class="form-group">
											<label for="selectProcesstype">Particulars</label>
											<select class="custom-select" name="pr_descriptions_id" required>
												<option value="{{ $transactions->pr_descriptions_id }}">{{ $transactions->pr_descriptions->name }} - Current</option>
											@foreach ($prdescriptions as $prdescription)	
												<option value="{{$prdescription->id}}"> {{ $prdescription->name}}
												</option>
											@endforeach
											</select>
											<small id="processtypeHelp" class="form-text text-muted">Select Particulars.</small>
										</div>

										<div class="form-group">
											<label for="inputPurpose">Purpose</label>
											<input type="text" class="form-control" id="inputPurpose" name="description" value="{{ $transactions->description }}" aria-describedby="purposeHelp">
											<small id="purposeHelp" class="form-text text-muted">Purchase Request Purpose</small>
										</div>	
	
										
										<div class="form-group">
											<label for="supplier">Payee</label>												
											<input id="VCRsupplier" type="text" name="supplier" value="{{ $transactions->client }}" class="form-control">
											<small id="rofficeHelp" class="form-text text-muted">Please input Payee name.</small>
										</div>
	
	
										
										<div class="form-group">
											<label for="inputEstamount">Amount</label>
											<input type="text" class="form-control" id="PSinputEstamount" name="est_amount" value="{{ $transactions->amount }}" aria-describedby="estamountHelp" required>
											<small id="estamountHelp" class="form-text text-muted">Please enter the total amount.</small>
										</div>
	
										<div class="form-group" align="center">
											<br>
											<p><small>Double Check before clicking submit.</small></p>
											{{-- <button disabled class="btn btn-outline-primary" type=button id="btnverzenden2" style="display: none"><span class="glyphicon glyphicon-refresh"></span>Submitting</button>    --}}
											<button class="btn btn-outline-primary" type=submit name=verzenden id="btnverzenden">Submit</button>
										</div>
									</div>
								</div>
							</div>
							@break
						@case($transactions->process_types->name = "Purchase Order")
							<div class="col-md-12">
								<div class="grid">
									<div class="grid-header">
										Details
									</div>
									<div class="grid-body">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="labelDateOfEntry"><strong>Date of Entry</strong></label>
													<p><small>{{ $transactions->date_of_entry }}</small></p>
												</div>
		
												<div class="form-group">
													<label for="labelReferenceNo"><strong>Reference No.</strong></label>
													<p><small>{{ $transactions->reference_id }}</small></p>
												</div>
		
												<div class="form-group">
													<label for="labelSubReferenceNo"><strong>Sub Reference No.</strong></label>
													<p><small>{{ $transactions->sub_reference_id }}</small></p>
												</div>
		
												<div class="form-group">
													<label for="labelPRDescription"><strong>Particulars</strong></label>
													<p><small>{{ $transactions->pr_descriptions->name }}</small></p>
												</div>
		
												<div class="form-group">
													<label for="labelOffice"><strong>Office</strong></label>
													<p><small>{{ $transactions->offices->name }}</small></p>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="labelDescription"><strong>Description</strong></label>
													<p><small>{{ $transactions->description }}</small></p>
												</div>
		
												<div class="form-group">
													<label for="labelSupplier"><strong>Supplier</strong></label>
													<p><small>{{ $transactions->client }}</small></p>
												</div>
		
												<div class="form-group">
													<label for="labelSupplierAddress"><strong>Address</strong></label>
													<p><small>{{ $transactions->address }}</small></p>
												</div>
		
												<div class="form-group">
													<label for="labelContract Price"><strong>Contract Price</strong></label>
													<div class="col-md-5">
														<input type="text" class="form-control" id="inputType5" value="{{ number_format($transactions->amount, 2, '.', ',') }}" disabled="">
													</div>
												</div>
		
												<div class="form-group">
											<label for="labelDocumentHolder"><strong>Current Document Holder</strong></label>
											@switch($transactions->statuses->name)
												@case($transactions->statuses->name = "None")
													<p><small>{{ $transactions->users->name }}</small></p>
													<p><small>{{ $transactions->users->offices->name }}</small></p>
													<p><strong style="color:red">Document has not been endorsed yet.</strong></p>
													@break
												@case($transactions->statuses->name = "Complete")
													<p><small>{{ $transactions->users->name }}</small></p>
													<p><small>{{ $transactions->users->offices->name }}</small></p>
													<p><strong style="color:green">Document has been completely processed</strong></p>							
													@break
												@case($transactions->statuses->name = "In Progress")
													<p><small>{{ $transactions->users->name }}</small></p>
													<p><small>{{ $transactions->users->offices->name }}</small></p>
													@break
												@case($transactions->statuses->name = "Cancelled")
													<p><small>{{ $office_holder->offices->name }} -  Document has been cancelled.</small></p>
													@break
												@default
											@endswitch
										</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="grid">
									<div class="grid-header">Purchase Order Details</div>
									<div class="grid-body">
										{{-- Purchase Order Reference ID --}}
										<div class="form-group">
											<label for="inputReferenceIdVoucher">Purchase Order Reference No.</label>
											<input type="text" class="form-control" id="inputReferenceIdVoucher" name="reference_id" value="{{ $transactions->reference_id }}" aria-describedby="prnumberHelp" required>
											<small id="voucherHelp" class="form-text text-muted">Please enter Reference number.</small>
										</div>
										
										{{-- Reference ID --}}
										<div class="form-group">
											<label for="inputReferenceIdMain">Document Reference No.</label>
											<input type="text" class="form-control" id="inputReferenceIdMain" name="sub_reference_id" value="{{ $transactions->sub_reference_id }}" aria-describedby="prnumberHelp">
											<small id="referenceIdMainHelp" class="form-text text-muted">Please enter main Reference number.</small>
										</div>

										{{--Office--}}
										<div class="form-group">
											<label for="selectOffice">Office</label>
											<select class="custom-select" name="offices_id"  required>
											<option value="{{ $transactions->offices_id }}">{{ $transactions->offices->name }} - Current</option>		
											@foreach ($offices as $office)					
												<option value="{{$office->id}}"> {{ $office->name}}
												</option>
											@endforeach
											</select>
											<small id="officeHelp" class="form-text text-muted">Please select office.</small>
										</div>

										{{--Purchase Request Description--}}
										<div class="form-group">
											<label for="selectProcesstype">Particulars</label>
											<select class="custom-select" name="pr_descriptions_id" required>
												<option value="{{ $transactions->pr_descriptions_id }}">{{ $transactions->pr_descriptions->name }} - Current</option>
											@foreach ($prdescriptions as $prdescription)	
												<option value="{{$prdescription->id}}"> {{ $prdescription->name}}
												</option>
											@endforeach
											</select>
											<small id="processtypeHelp" class="form-text text-muted">Select Particulars.</small>
										</div>

										{{--Purpose--}}
										<div class="form-group">
											<label for="inputPurpose">Purpose</label>
											<input type="text" class="form-control" id="inputPurpose" name="description" value="{{ $transactions->description }}" aria-describedby="purposeHelp">
											<small id="purposeHelp" class="form-text text-muted">Purchase Request Purpose</small>
										</div>	

										{{-- Contract Price --}}
										<div class="form-group">
											<label for="amount">Contract Price</label>												
											<input id="amount" type="text" name="est_amount" value="{{ $transactions->amount }}" class="form-control">
											<small id="rofficeHelp" class="form-text text-muted">Please input contract Price.</small>
										</div>

										{{-- Supplier --}}
										<div class="form-group">
											<label for="supplier">Supplier</label>												
											<input id="GSOsupplier" type="text" name="supplier" value="{{ $transactions->client }}" class="form-control">
											<small id="rofficeHelp" class="form-text text-muted">Please input supplier name.</small>
										</div>

										{{-- Address --}}
										<div class="form-group">
											<label for="supplier_address">Supplier Address</label>												
											<input id="supplier_address" type="text" name="address" value="{{ $transactions->address }}" class="form-control">
											<small id="rofficeHelp" class="form-text text-muted">Please input supplier address.</small>
										</div>

										<div class="form-group" align="center">
											<br>
											<p><small>Double Check before clicking submit.</small></p>
											{{-- <button disabled class="btn btn-outline-primary" type=button id="btnverzenden2" style="display: none"><span class="glyphicon glyphicon-refresh"></span>Submitting</button>    --}}
											<button class="btn btn-outline-primary" type=submit name=verzenden id="btnverzenden">Submit</button>
										</div>
									</div>
								</div>
							</div>
							@break
						@default
							<p>No Process</p>
					@endswitch
				</div>
			</div>	       	   
		</form>
	</div>
@endsection
@section('script')
	<script>
		function disableFunction() {
			$('#btnverzenden').prop('disabled', true);
		}
	</script>
	<script>
		$('div.alert').not('.alert-important').delay(3000).fadeOut(350);
	</script>
@endsection
