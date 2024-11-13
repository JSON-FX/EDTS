@extends('layouts.app')
@section('content')
    <div class="container">
        @include('flash::message')
        <div class="col-md-12">
            
            <form action="/create/document/store/{{ $events->id }}" method="POST" enctype="multipart/form-data" onSubmit='disableFunction()'>
                @csrf
               <div class="row">
                    <div class="col-md-6">
                        <div class="grid">
                            <div class="grid-header">
                                Date
                            </div>
                            <div class="grid-body">
                                {{--Date of Entry--}}
                                <div class="form-group">
                                    <label for="inputDOE">Date of Entry</label>
                                    <input type="date" class="form-control" id="inputDOE" name="date_of_entry" aria-describedby="doeHelp" placeholder="Date of Entry" required>
                                    <small id="docHelp" class="form-text text-muted">Please enter the date of entry.</small>
                                </div>
                            </div>
                        </div>	
                        <div class="grid">
                            <p class="grid-header">Document Update</p>
                            <div class="grid-body">
                              <div class="item-wrapper">
                                <textarea id="simpleMde" name="report" style="display: none;"></textarea>
                                <div class="col-md-12" align="center">
                                    <p><small><i>Double check before clicking submit</i></small></p><br>
                                    {{-- <button disabled class="btn btn-outline-primary" type=button id="btnverzenden2" style="display: none"><span class="glyphicon glyphicon-refresh"></span>Submitting</button>    --}}
                                    <button class="btn btn-outline-primary" type=submit name=verzenden id="btnverzenden">Submit</button>
                                    <a href="/home" class="btn btn-outline-primary">Home</a>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="grid">
                            <div class="grid-header">Word Reference</div>
                            <div class="grid-body">
                                <div class="item-wrapper">
                                    <div class="table-responsive">
                                        <table id="transactions-data-table" class="table table-bordered table-condensed" width="100%">
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
                    </div>
               </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        // $(function(){
        //     $("#btnverzenden").click(function () {
        //         $("#btnverzenden").hide(); 
        //         $("#btnverzenden2").show(); 
        //     });
        // });        
        function disableFunction() {
			$('#btnverzenden').prop('disabled', true);
		}
    </script>

    <script>
        $(function() {
			$('#transactions-data-table').DataTable();
        });
    </script>
@endsection