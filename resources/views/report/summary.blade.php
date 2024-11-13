@extends('layouts.app')
@section('content')
    <div class="container">
        @include('flash::message')
        
        {{-- <div class="row">
            <div class="col-md-12">
                <div class="grid">
                    <div class="grid-header">Filter Records</div>
                    <div class="grid-body">
                        <div class="item-wrapper">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <select class="form-control" name="filter_office" id="filter_office" required>
                                        <option>Office</option>
                                        <option value="5">Bids and Award Committee</option>
                                        <option value="9">General Services Office</option>
                                        <option value="6">Procurement Request</option>
                                        <option value="19">Municipal Accounting Office</option>
                                        <option value="18">Municipal Budget Office</option>
                                        <option value="24">Municipal Mayor's Office</option>
                                        <option value="20">Municipal Treasurer Office</option>
                                        
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <select class="form-control" name="filter_process_type" id="filter_process_type" required>
                                        <option>Classification</option>
                                           
                                                <option value="1">Purchase Request</option>
                                                <option value="9">Purchase Order</option>
                                                <option value="8">Voucher</option>
                                           
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <select class="form-control" name="filter_status" id="filter_status" required>
                                        <option>Status</option>
                                        <option value="1">Complete</option>
                                        <option value="3">In Progress</option>
                                        <option value="4">Cancelled</option>
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
        </div> --}}
      
        <div class="col-md-12">
            <div class="row">
                <div class="grid">
                    <div class="grid-header">In Progress Details</div>
                    <div class="grid-body">
                        <div class="item-wrapper">
                            <div class="table-responsive">
                                <table id="summary-data-table" class="table table-bordered table-condensed" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Ref. #</th>
                                            <th>Sub Ref. #</th>
                                            <th>Classification</th>
                                            <th>Purpose</th>
                                            <th>Description</th>
                                            <th>Current Document Holder</th>
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
                                            <th>Classification</th>
                                            <th>Purpose</th>
                                            <th>Description</th>
                                            <th>Current Document Holder</th>
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
        <div class="col-md-12">
            <div class="row">
                <div class="grid">
                    <div class="grid-header">Document Update</div>
                    <div class="grid-body">
                        <div class="item-wrapper">
                            <div class="table-responsive">
                                <table id="holders-data-table" class="table table-bordered table-condensed" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Ref. #</th>
                                            <th>Sub Ref. #</th>
                                            <th>Classification</th>
                                            <th>Purpose</th>
                                            <th>Update</th>     
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($events as $data)
                                            <tr>
                                                <td>{{ Carbon\Carbon::parse($data->updated_at)->format('m-d-Y') }}</td>
                                                <td>{{ $data->events->transactions->reference_id }}</td>
                                                <td>{{ $data->events->transactions->sub_reference_id }}</td>
                                                <td>{{ $data->events->transactions->process_types->name }}</td>
                                                <td>{{ $data->events->transactions->description }}</td>
                                                <td>{{ $data->report }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Date</th>
                                            <th>Ref. #</th>
                                            <th>Sub Ref. #</th>
                                            <th>Classification</th>
                                            <th>Purpose</th>
                                            <th>Update</th>
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
        $(document).ready(function(){
            fill_datatable();
            function fill_datatable(filter_office ='', filter_classification = '', filter_status = '')
            {
                var dataTable = $('#summary-data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    retrieve: true,
                    deferRender: true,
                    ajax:{
                        url: "/summary/customsearch",
                        data:{filter_office:filter_office, filter_classification:filter_classification, filter_status:filter_status}
                    },
                    columns: [
                    { data: 'transactions.date_of_entry', name: 'transactions.date_of_entry'},
		        	{ data: 'transactions.reference_id', name: 'transactions.reference_id'},
					{ data: 'transactions.sub_reference_id', name: 'transactions.sub_reference_id'},
                    { data: 'classification', name: 'classification' },
					{ data: 'pr_descriptions', name: 'pr_descriptions' },
                    { data: 'transactions.description', name: 'transactions.description' },
		            { data: 'endorsing_offices.name', name: 'endorsing_offices.name'},
                    { data: 'action', name: 'action'}
		        ],
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
                    targets: 4
                },
				{
                    render: function (data, type, full, meta) {
                        return "<div class='text-wrap width-201'>" + data + "</div>";
                    },
                    targets: 5
                },
                {
                    render: function (data, type, full, meta) {
                        return "<div class='text-wrap width-201'>" + data + "</div>";
                    },
                    targets: 6
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

    {{-- <script>
        $(function() {
		    $('#summary-data-table').DataTable({
		        processing: true,
		        serverSide: true,
				deferRender: true,
                order: [[0, 'desc']],
		        ajax: '/summary/customsearch',
		        columns: [
                    { data: 'transactions.date_of_entry', name: 'transactions.date_of_entry'},
		        	{ data: 'transactions.reference_id', name: 'transactions.reference_id'},
					{ data: 'transactions.sub_reference_id', name: 'transactions.sub_reference_id'},
                    { data: 'classification', name: 'classification' },
					{ data: 'pr_descriptions', name: 'pr_descriptions' },
                    { data: 'transactions.description', name: 'transactions.description' },
		            { data: 'endorsing_offices.name', name: 'endorsing_offices.name'},
                    { data: 'action', name: 'action'}
		        ],
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
                    targets: 4
                },
				{
                    render: function (data, type, full, meta) {
                        return "<div class='text-wrap width-201'>" + data + "</div>";
                    },
                    targets: 5
                },
                {
                    render: function (data, type, full, meta) {
                        return "<div class='text-wrap width-201'>" + data + "</div>";
                    },
                    targets: 6
                }
            ]
		    });
			$('div.dataTables_filter input').focus()
		});
    </script> --}}

    <script>

        $(function() {
            $('#holders-data-table').DataTable({
                order: [[0, 'desc']],
                columnDefs: [
                // {
                // render: function (data, type, full, meta) {
                //         return "<div class='text-wrap width-201'>" + data + "</div>";
                //     },
                //     targets: 3,
                // },
                {
                    render: function (data, type, full, meta) {
                        return "<div class='text-wrap width-200'>" + data + "</div>";
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
        });
    </script>



@endsection