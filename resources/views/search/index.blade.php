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
		<div class="col-lg-12">
			<div class="row">
                <div class="col-md-12">
                    <div class="grid">
                       <div class="grid-header bg-primary">
                            <p class="card-title text-white ml-n1">Filter Records</p>
                        </div>
                        <div class="grid-body">
                            <div class="item-wrapper">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <select class="form-control" name="filter_office" id="filter_office" required>
                                            <option>Office</option>
                                            @foreach ($offices as $office)
                                                <option value="{{$office->id}}"> {{ $office->name}}
                                                </option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <select class="form-control" name="filter_process_type" id="filter_process_type" required>
                                            <option>Classification</option>
                                                {{-- @foreach ($process_types as $process_type) --}}
                                                    {{-- <option value="{{$process_type->id}}"> {{ $process_type->name}} </option> --}}
                                                    <option value="1">Purchase Request</option>
                                                    <option value="2">Purchase Order</option>
                                                    <option value="3">Voucher</option>
                                                {{-- @endforeach --}}
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <select class="form-control" name="filter_status" id="filter_status" required>
                                            <option>Status</option>
                                                @foreach ($statuses as $status)
                                                    <option value="{{$status->id}}"> {{ $status->name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <i title="Filter"><button type="button" name="filter" id="filter" class="btn btn-primary"><span class="mdi mdi-filter mdi-1x"></span></button></i> <i title="Remove Filter"><button type="button" name="reset" id="reset" class="btn btn-primary"><span class="mdi mdi-filter-remove mdi-1x"></span></button></i>
                                        </div>
                                    </div>
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
                    <p class="card-title text-white ml-n1">Registered Documents</p>
                </div>
                <div class="grid-body">
                    <div class="item-wrapper">
                        <div class="table-responsive">
                            <table id="transactions-data-table" class="table table-bordered table-condensed" width="100%">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Ref. #</th>
                                        <th>Sub Ref. #</th>
                                        <th>Type</th>
                                        <th>E.U/SPLR/Payee</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Date</th>
                                        <th>Ref. #</th>
                                        <th>Sub Ref. #</th>
                                        <th>Type</th>
                                        <th>E.U/SPLR/Payee</th>
                                        <th>Description</th>
                                        <th>Status</th>
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
	</div>
@endsection
@section('script')
	<script>
		$('div.alert').not('.alert-important').delay(3000).fadeOut(350);
	</script>

	{{-- <script>
		$(function() {
			$('#transactions-data-table').DataTable();
			$('div.dataTables_filter input').focus()
		});
	</script> --}}
	<script>
		$(function() {
		    $('#transactions-data-table').DataTable({
		        processing: true,
		        serverSide: true,
				deferRender: true,
		        ajax: '/home',
		        columns: [
					{ data: 'date_of_entry', name: 'date_of_entry'},
					{ data: 'reference_id', name: 'reference_id'},
					{ data: 'sub_reference_id', name: 'sub_reference_id'},
					{ data: 'process_types.name', name: 'process_types.name'},
                    { data: 'client', name: 'client' },
					{ data: 'description', name: 'description'},
                    { data: 'status', name: 'status' },
		            { data: 'action', name: 'action'},
		        ],
				columnDefs: [
                {
                    render: function (data, type, full, meta) {
                        return "<div class='text-wrap width-201'>" + data + "</div>";
                    },
                    targets: 4,
                },
				{
					render: function (data, type, full, meta) {
                        return "<div class='text-wrap width-201'>" + data + "</div>";
                    },
                    targets: 5,
				}
             ]
		    });
			// $('div.dataTables_filter input').focus()
		});
    </script>

    {{-- filter --}}
    <script>
        $(document).ready(function(){
            fill_datatable();
            function fill_datatable(filter_office ='', filter_classification = '', filter_status = '')
            {
                var dataTable = $('#transactions-data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    retrieve: true,
                    ajax:{
                        url: "/customsearch",
                        data:{filter_office:filter_office, filter_classification:filter_classification, filter_status:filter_status}
                    },
                    columns: [
                        { data: 'date_of_entry', name: 'date_of_entry'},
                        { data: 'reference_id', name: 'reference_id'},
                        { data: 'sub_reference_id', name: 'sub_reference_id'},
                        { data: 'process_types.name', name: 'process_types.name'},
                        { data: 'client', name: 'client' },
                        { data: 'description', name: 'description'},
                        { data: 'status', name: 'status' },
                        { data: 'action', name: 'action'},
                ],
                columnDefs: [
                {
                    render: function (data, type, full, meta) {
                        return "<div class='text-wrap width-201'>" + data + "</div>";
                    },
                    targets: 4,
                },
                {
                    render: function (data, type, full, meta) {
                        return "<div class='text-wrap width-201'>" + data + "</div>";
                    },
                    targets: 5,
                }
                ],
                order: [[ 0, "asc" ]]
                });
            }
            $('#filter').click(function(){

                var filter_office = $('#filter_office').val();
                console.log(filter_office);
                var filter_classification = $('#filter_process_type').val();
                console.log(filter_classification);
                var filter_status = $('#filter_status').val();
                console.log(filter_status);
                if(filter_office !='' && filter_classification !='' && filter_status !='')
                {
                    $('#transactions-data-table').DataTable().destroy();
                    fill_datatable(filter_office, filter_classification, filter_status);
                }
                else
                {
                    alert('Select filter option');
                }
            });
            $('#reset').click(function(){
                $('filter_office').val('');
                $('filter_process_type').val('');
                $('filter_status').val('');
                $('#transactions-data-table').DataTable().destroy();
                fill_datatable();
            });
        });
    </script>
@endsection
