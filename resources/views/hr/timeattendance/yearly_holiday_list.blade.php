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
                    <a href="#">Time & Attendance </a>
                </li> 
                <li>
                    <a href="#">Operation</a>
                </li> 
                <li class="active">Yearly Holiday List</li>
            </ul><!-- /.breadcrumb --> 
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Time & Attendance <small><i class="ace-icon fa fa-angle-double-right"></i> Operation <i class="ace-icon fa fa-angle-double-right"></i> Yearly Holiday List </small></h1>
            </div>

            <div class="row">
                  <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <div class="col-xs-12">
                        <div class="output"></div>
                    <!-- PAGE CONTENT BEGINS --> 
                        <table id="dataTables" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Sl. No</th>
                                    <th>Unit</th>
                                    <th>Date</th>
                                    <th>Comment</th>
                                    <th>Open Status</th>
                                    <!-- <th>Action</th> -->
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
    $('#dataTables').DataTable({ 
        order: [], //reset auto order
        processing: true,
        responsive: true,
        serverSide: true,
        pagingType: "full_numbers",
        dom: "<'row'<'col-sm-2'l><'col-sm-3'i><'col-sm-4 text-center'B><'col-sm-3'f>>tp", 
        ajax: {
            url: '{!! url("hr/timeattendance/operation/yearly_holidays/data") !!}',
            type: "POST",
            headers: {
                  'X-CSRF-TOKEN': '{{ csrf_token() }}'
            } 
        },
        columns: [  
            { data: 'serial_no', name: 'serial_no' }, 
            { data: 'hr_unit_short_name', name: 'hr_unit_short_name' }, 
            { data: 'hr_yhp_dates_of_holidays',  name: 'hr_yhp_dates_of_holidays' },
            { data: 'hr_yhp_comments', name: 'hr_yhp_comments' },  
            { data: 'open_status', name: 'open_status' },  
            // { data: 'action', name: 'action', orderable: false, searchable: false }
        ], 
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
        ] 
    }); 


    // holiday open status
    $("body").on("click", ".open_status", function(){ 
        $.ajax({
            url: "{{ url('hr/timeattendance/operation/yearly_holidays/open_status') }}",
            data: {
                id: $(this).data("id"),
                status: $(this).val()
            },
            success: function(data) {
                $(".output").html(data); 
            },
            error: function(xhr)
            {
                alert("Please wait...");
            }
        });
    });

});
</script>
@endsection