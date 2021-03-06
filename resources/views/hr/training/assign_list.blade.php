@extends('hr.index')
@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Human Resource</a>
                </li>
                <li>
                    <a href="#">Training</a>
                </li>
                <li class="active">Assign List</li>
            </ul><!-- /.breadcrumb --> 
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Training<small><i class="ace-icon fa fa-angle-double-right"></i> Assign List </small></h1>
            </div>

            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS --> 
                        <table id="dataTables" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Sl. No</th>
                                    <th>Associate's ID</th>
                                    <th>Associate's Name</th>
                                    <th>Training Name</th>
                                    <th>Trainer Name</th>
                                    <th>Schedule Date</th>
                                    <th>Schedule Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>  
                        </table>
                        <!-- PAGE CONTENT ENDS -->
                    </div><!-- /.col -->

                    <!-- PAGE CONTENT ENDS -->
                </div>
                <!-- /.col -->
            </div>
        </div><!-- /.page-content -->
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){ 

    var searchable = [1,2,4,5,6];
    var selectable = [3];


    var dropdownList = {
        '3' :[@foreach($trainingNames as $e) <?php echo str_replace("'", "", "\"$e\",") ?> @endforeach]
    };

    $('#dataTables').DataTable({
        order: [], //reset auto order
        processing: true,
        responsive: false,
        serverSide: true,
        pagingType: "full_numbers",
        dom: "<'row'<'col-sm-2'l><'col-sm-3'i><'col-sm-4 text-center'B><'col-sm-3'f>>tp", 
        buttons: [  
            {
                extend: 'copy', 
                className: 'btn-sm btn-info',
                exportOptions: {
                    columns: ':visible'
                }
            }, 
            {
                extend: 'csv', 
                className: 'btn-sm btn-success',
                exportOptions: {
                    columns: ':visible'
                }
            }, 
            {
                extend: 'excel', 
                className: 'btn-sm btn-warning',
                exportOptions: {
                    columns: ':visible'
                }
            }, 
            {
                extend: 'pdf', 
                className: 'btn-sm btn-primary', 
                exportOptions: {
                    columns: ':visible'
                }
            }, 
            {
                extend: 'print', 
                className: 'btn-sm btn-default',
                exportOptions: {
                    columns: ':visible'
                } 
            } 
        ], 
        ajax: {
            url: '{!! url("hr/training/assign_data") !!}',
            type: "POST",
            headers: {
                  'X-CSRF-TOKEN': '{{ csrf_token() }}'
            } 
        },  
        columns: [ 
            { data: 'serial_no', name: 'serial_no'}, 
            { data: 'associate_id',  name: 'associate_id' }, 
            { data: 'associate_name',  name: 'associate_name' }, 
            { data: 'training_name',  name: 'training_name' }, 
            { data: 'tr_trainer_name', name: 'tr_trainer_name' }, 
            { data: 'schedule_date', name: 'schedule_date' }, 
            { data: 'schedule_time', name: 'schedule_time' }, 
            { data: 'action', name: 'action' }, 
        ], 
        initComplete: function () {   
            var api =  this.api();

            // Apply the search 
            api.columns(searchable).every(function () {
                var column = this; 
                var input = document.createElement("input"); 
                input.setAttribute('placeholder', $(column.header()).text());

                $(input).appendTo($(column.header()).empty())
                .on('keyup', function () {
                    column.search($(this).val(), false, false, true).draw();
                });

                $('input', this.column(column).header()).on('click', function(e) {
                    e.stopPropagation();
                });
            });
 
            // each column select list
            api.columns(selectable).every( function (i, x) {
                var column = this; 

                var select = $('<select><option value="">'+$(column.header()).text()+'</option></select>')
                    .appendTo($(column.header()).empty())
                    .on('change', function(e){
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
                        column.search(val ? val : '', true, false ).draw();
                        e.stopPropagation();
                    });

                // column.data().unique().sort().each( function ( d, j ) {
                // if(d) select.append('<option value="'+d+'">'+d+'</option>' )
                // });
                $.each(dropdownList[i], function(j, v) {
                    select.append('<option value="'+v+'">'+v+'</option>')
                }); 
            });
        } 
    }); 
});
</script>
@endsection 