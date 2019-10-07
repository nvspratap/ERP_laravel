@extends('commercial.index')
@section('content')
	<div class="main-content">
		@push('css')
			<style>
				.section-head-h4 {
				    background-color: #bce8f1;
				    color: #31708f;
				    padding: 10px;
				}
			</style>
		@endpush
	    <div class="main-content-inner">
	        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
	            <ul class="breadcrumb">
	                <li>
	                    <i class="ace-icon fa fa-home home-icon"></i>
	                    <a href="#"> Commercial </a>
	                </li>
	                <li>
	                    <a href="#"> Export </a>
	                </li>
	                <li class="active"> Cash Incentive </li>
	            </ul><!-- /.breadcrumb -->
	        </div>

	        <div class="page-content">
	            <div class="page-header">
	                <h1>Export <small><i class="ace-icon fa fa-angle-double-right"></i> Cash Incentive </small></h1>
	            </div>
	            <form class="form-horizontal" role="form" method="post" action="{{ url('commercial/export/cash_incentive_save') }}">
				{{ csrf_field() }}
		            <!-- 1st ROW -->
	                <div class="row">
	                	<div class="col-sm-12">
		                    <!-- Display Erro/Success Message -->
		                    @include('inc/message')
		                    <div id="selectOne"></div>
		                    <div class="panel panel-info">
				             	<div class="panel-heading page-headline-bar"><h5> Cash Incentive <a href="{{url('commercial/export/cash_incentivelist')}}" class="btn btn-info btn-sm pull-right">List of Cash Incentive</a></h5> </div>
				         	</div>
		                    <div class="col-sm-12">
		                    	<div class="col-sm-4">
		                			<label class="col-sm-4 control-label no-padding" for="cm_file_id" > File No<span style="color: red">&#42;</span> </label>
		                            <div class="col-sm-8">
		                                {{ Form::select("cm_file_id", $fileList, null, ['class'=>'col-xs-12 form-control', 'id'=>'cm_file_id', 'placeholder'=>'Select File No']) }}
		                            </div>
		                    	</div>
		                    	<div class="col-sm-3">
		                			<label class="col-sm-4 control-label no-padding" for="inv_no" > Invoice No</label>
		                            <div class="col-sm-8">
		                                {{ Form::select("inv_no", $invoiceList, null, ['class'=>'col-xs-12 form-control', 'id'=>'inv_no', 'placeholder'=>'Select Invoice No']) }}
		                            </div>
		                    	</div>
								<div class="col-sm-3">
		                			<div class="form-group">
		                                <label class="col-sm-4 control-label no-padding" for="inv_value" > Value</label>
		                                <div class="col-sm-8">
		                                    <input type="text" id="inv_value" name="inv_value" placeholder="" value="" class="col-xs-12 form-control"/>
		                                </div>
		                            </div>
		                    	</div>
		                    	<div class="col-sm-2">
		                    		<button class="btn btn-info btn-sm" type="button" id="valueSearch">
		                                <i class="ace-icon fa fa-search"></i> Search
		                            </button>
		                    	</div>
		                    </div>
		                </div>
	                </div>
	                <!-- select table -->
	                <!-- 2nd ROW -->
	                <br><br>
	                <div class="row">
	                    <div class="col-sm-12">
	                        <div id="ajaxCashIncentiveTable"></div>
	                    </div>
	                </div>
	                <!-- end select table -->
	                <br><br>
	                <!-- 3rd ROW -->
	                <div class="row" id="cashIncentiveForm" style="display: none;">
	                	<div class="col-sm-12">
	                		<h4 class="section-head-h4">Incentive Child</h4>
	                		<table class="table table-bordered" id="child_table">
							    <thead>
							    	<tr>
							    		<th>Incentive Ref</th>
							    		<th>File No</th>
							    		<th>Invoice No</th>
							    		<th>Buyer</th>
							    		<th>RIM Value</th>
							    		<th>Bank</th>
							    		<th>Country</th>
							    		<th>Action</th>
							    	</tr>
							    </thead>
							    <tbody>
						        	{{-- final row/total row --}}
						        	<tr id="tableLastRow">
						        		<td colspan="2">Incentive Count</td>
						        		<td>
						        			<input type="text" id="incentive_total" class="form-control" readonly="readonly"/>
						        		</td>
						        		<td>Total * Rim Value</td>
						        		<td>
						        			<input type="text" id="total_multi_rim" class="form-control" readonly="readonly"/>
						        		</td>
						        		<td>Incentive Value</td>
						        		{{-- rim * incentive percentage --}}
						        		<td>
						        			<input type="text" id="incentive_value" class="form-control" readonly="readonly"/>
						        		</td>
						        		<td></td>
						        	</tr>
							    </tbody>
							</table>
	                	</div>
	                	<div class="col-sm-12">
							<button class="btn btn-info btn-sm pull-right" type="submit"> Save</button>
	                	</div>
	                </div>
                </form>
	        </div><!-- /.page-content -->
	    </div>
	</div>

@push('js')
	<script type="text/javascript">
		function ajax_loader_fn(divId) {
			var loaderPath = "{{asset('assets/rubel/img/loader.gif')}}";
			$("#"+divId).html('<div class="loader-cycle text-center"><img src="'+loaderPath+'" /></div>');
			$('html, body').animate({
	            scrollTop: $("#"+divId).offset().top
	        }, 2000);
		}

		function returnMessage($msg) {
			$('#ajaxCashIncentiveTable').html('');
			$('#cashIncentiveForm').css({'display':'none'});
			var html = '<div class="alert alert-danger alert-dismissible" role="alert">';
			html += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
			html += '<span aria-hidden="true">&times;</span></button>'+$msg+'';
			html += '</div>';
			$('#selectOne').html(html);
		}
		// sidebar collapse
		//$('#sidebar').addClass('menu-min');
		$('#valueSearch').on('click', function() {
			var file_no 	= $('#cm_file_id').val();
			var inv_no 		= $('#inv_no').val();
			var inv_value 	= $('#inv_value').val();
			if(file_no != '' || inv_no != '' || inv_value != '') {
				if(file_no != '') {
					$('#selectOne').html('');
					$('#cashIncentiveForm').css({'display':'none'});
					// remove previous table row
					$('#child_table tr[id^="child_"]').remove();
					ajax_loader_fn('ajaxCashIncentiveTable');
					setTimeout(() => {
						$.ajax({
							url: '{{ url('commercial/export/ajax_cash_incentive_master_data') }}',
							type: 'POST',
							datatype: 'json',
							data: {'file_no': file_no, 'inv_no': inv_no, 'inv_value': inv_value},
							headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
							success: function (res) {
								// console.log(res);
								$('#ajaxCashIncentiveTable').html(res);
							}
						});
					}, 1000);
				} else {
					returnMessage('Please Select File');
				}
			} else {
				returnMessage('Please Select One');
			}
		});

		{{-- file_id onchange --}}
		$('#cm_file_id').on('change', function() {
			$.ajax({
				url: '{{ url('commercial/export/cash_incentive_fetchinvno') }}',
				type: 'POST',
				datatype: 'json',
				data: {'file_id': $(this).val()},
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				success: function (res) {
					$('#inv_no').html(res);
				}
			})
		});
	</script>
@endpush
@endsection
