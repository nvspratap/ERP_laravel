@extends('merch.index')
@section('content')
<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-usd home-icon"></i>
					<a href="#">Style Costing</a>
				</li>
				<li class="active">Style Costing List</li>
			</ul><!-- /.breadcrumb -->
		</div>

		<div class="page-content">
            <!-- Display Erro/Success Message -->
            @include('inc/message')

            <div class="row">
                <div class="col-xs-12 table-responsive">
                    <table id="dataTables" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Production Type</th>
                                <th>Style No</th>
                                <th>Buyer</th>
                                <th>Product Name</th>
                                <th>SMV/pc</th>
                                <th>Season</th>
								<th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>SL</th>
                                <th>Production Type</th>
                                <th>Style No</th>
                                <th>Buyer</th>
                                <th>Product Name</th>
                                <th>SMV/pc</th>
                                <th>Season</th>
								<th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div><!-- /.col -->
            </div><!-- /.row -->
		</div><!-- /.page-content -->
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="action_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h2 class="modal-title text-center" id="myModalLabel">Style Costing</h2>
            </div>
            <div class="modal-body">
                <div class="delete_msg">
                    <h4 class="text-center">{{ Session::get('lavelhierarchy') }}</h4>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-md-offset-3 col-md-9"> 
                    <button class="btn btn-info" type="button" id="modal_data" data-dismiss="modal">
                        <i class="ace-icon fa fa-check bigger-110" ></i> Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal End -->
<script type="text/javascript">
$(document).ready(function(){
    // if lavel hierachy data not exit
    @if(Session::has('lavelhierarchy'))
        $('#action_modal').modal('show');
    @endif
    
    var searchable = [2,4,5];
    var selectable = [1,3,6];

    var dropdownList = {
        '1' :['Development', 'Bulk'],
        '3' :[@foreach($buyerList as $e) <?php echo "\"$e\"," ?> @endforeach],
        '6' :[@foreach($seasonList as $e) <?php echo "\"$e\"," ?> @endforeach]
    };

    $('#dataTables').DataTable({
        order: [], //reset auto order
        processing: true,
        responsive: false,
        serverSide: true,
        pagingType: "full_numbers",
        dom: "<'row'<'col-sm-2'l><'col-sm-4'i><'col-sm-3 text-center'B><'col-sm-3'f>>tp",
        ajax: {
            url: '{!! url("merch/style_costing_data") !!}',
            type: "POST",
            headers: {
                  'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'stl_type',  name: 'stl_type'},
            {data: 'stl_no', name: 'stl_no'},
            {data: 'b_name', name: 'b_name'},
            {data: 'stl_product_name',  name: 'stl_product_name'},
            {data: 'stl_smv', name: 'stl_smv'},
            {data: 'se_name', name: 'se_name'},
						{data: 'stl_status', name: 'stl_status'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        buttons: [
            {
                extend: 'copy',
                className: 'btn-sm btn-info',
                exportOptions: {
                    columns: ':visible'
                },
                header: false,
                footer: true
            },
            {
                extend: 'csv',
                className: 'btn-sm btn-success',
                exportOptions: {
                    columns: ':visible'
                },
                header: false,
                footer: true
            },
            {
                extend: 'excel',
                className: 'btn-sm btn-warning',
                exportOptions: {
                    columns: ':visible'
                },
                header: false,
                footer: true
            },
            {
                extend: 'pdf',
                className: 'btn-sm btn-primary',
                exportOptions: {
                    columns: ':visible'
                },
                header: false,
                footer: true
            },
            {
                extend: 'print',
                autoPrint: true,
                className: 'btn-sm btn-default',
                exportOptions: {
                    columns: ':visible'
                },
                header: false,
                footer: true
            }
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

                $.each(dropdownList[i], function(j, v) {
                    select.append('<option value="'+v+'">'+v+'</option>')
                });
            });
        }
    });
});
</script>
@endsection
