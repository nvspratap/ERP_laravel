@extends('merch.index')
@section('content')
<div class="main-content">
  @push('css')
    <style>
      fieldset.group  {
        margin: 0;
        padding: 0;
        margin-bottom: 1.25em;
        padding: .125em;
        border-bottom: 1px solid lightgray;
        border-right: 1px solid lightgray;
        border-top: 1px solid lightgray;
      }

      fieldset.group legend {
        margin: 0;
        padding: 0;
        font-weight: bold;
        margin-left: 20px;
        color: black;
        text-align: center;
        margin-bottom: 15px;
        padding-bottom: 8px;
      }


      ul.checkbox  {
        margin: 0;
        padding: 0;
        margin-left: 20px;
        list-style: none;
      }

      ul.checkbox li input {
        margin-right: .25em;
      }

      ul.checkbox li {
        border: 1px transparent solid;
      }

      ul.checkbox li:hover,
      ul.checkbox li.focus  {
        background-color: lightyellow;
        border: 1px gray solid;
      }
      .checkbox label, .radio label {
        padding-left: 0px;
        font-size: 10px;
    }
    </style>
  @endpush

    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                  <i class="ace-icon fa fa-home home-icon"></i>
                  <a href="#"> Merchandising </a>
                </li>
                <li>
                  <a href="#"> Setup </a>
                </li>
                <li class="active"> Buyer Information  </li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">
            <div class="page-header">
                <h1>Setup <small><i class="ace-icon fa fa-angle-double-right"></i> Buyer Information </small></h1>
            </div>

            <div class="row">
                <!-- Display Erro/Success Message -->
                @include('inc/message')
                <div class="col-sm-6 col-md-offset-2">
                    <!-- PAGE HEADER -->
                    <h5 class="page-header">Buyer Information</h5>
                    <!-- PAGE CONTENT BEGINS -->
                    <form class="form-horizontal" role="form" method="post" action="{{ url('merch/setup/buyer_info_store')  }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="march_buyer_name" > Buyer Name<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-8">
                                <input type="text" id="march_buyer_name" name="march_buyer_name" placeholder="Buyer name" class="form-control col-xs-12" data-validation="required length custom" data-validation-length="1-50" data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="march_buyer_short_name" > Buyer Short Name<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-8">
                                <input type="text" id="march_buyer_short_name" name="march_buyer_short_name" placeholder="Buyer short name" class="form-control col-xs-12" data-validation="required length custom" data-validation-length="1-50" data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$"/>
                            </div>
                        </div>

                        <div id="BrandName">
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="brand_name" > Brand Name <span style="color: red">&#42;</span></label>
                                <div class="col-sm-8">
                                    <input type="text" id="brand_name" name="brand_name[]" placeholder="Brand name" class="col-sm-8" data-validation="required length custom" data-validation-length="1-50" data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$"/>
                                    <div class="form-group col-sm-4">
                                        <button type="button" class="btn btn-sm btn-success AddBtnBrand" style="height: 30px; width: 30px;">+</button>
                                        <button type="button" class="btn btn-sm btn-danger RemoveBtnBrand" style="height: 30px; width: 30px;">-</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="action_type" > Country<span style="color: red">&#42;</span> </label>
                            <div class="col-sm-8">
                                {{ Form::select('country', $country, null, ['placeholder'=>'Select Country','class'=> 'form-control col-xs-12', 'data-validation' => 'required']) }}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right" for="march_buyer_address" >  Address <span style="color: red">&#42;</span></label>
                            <div class="col-sm-8">
                                <textarea name="march_buyer_address" class="form-control" id="march_buyer_address"  data-validation="required length" data-validation-length="0-128"></textarea>
                            </div>
                        </div>

                        <div id="contactPersonData">
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right" for="march_buyer_contact" > Contact Person <span style="color: red">&#42;</span>(<span style="font-size: 9px">Name, Cell No, Email</span>)</label>
                                <div class="col-sm-8">
                                    <textarea name="march_buyer_contact[]" class="col-sm-8"  data-validation="required length" data-validation-length="0-128"></textarea>
                                    <div class="form-group col-sm-4">
                                        <button type="button" class="btn btn-sm btn-success AddBtn" style="height: 30px; width: 30px;">+</button>
                                        <button type="button" class="btn btn-sm btn-danger RemoveBtn" style="height: 30px; width: 30px;">-</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12 ">
                                    <label class="col-sm-4 control-label no-padding-right" for="march_buyer_address" >Sample Type </label>
                                    <button type="button" class="btn btn-xs" data-toggle="modal" data-target="#sampleTypeModal" style="margin-left: 12px;"><i class="glyphicon glyphicon-plus"></i></button>
                                    <div class="col-xs-10" id="added_sample_type" style="padding-top: 10px; margin: 0px; padding-left: 292px; padding-right: 0px;">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 ">
                                    <label class="col-sm-4 control-label no-padding-right" for="march_buyer_address" >Product Size</label>

                                    <button type="button" class="btn btn-xs" data-toggle="modal" data-target="#addProductSizeModal" style="margin-left: 12px;"><i class="glyphicon glyphicon-plus"></i></button>
                                    <div class="col-xs-10" id="added_product_size" style="padding-top: 10px; margin: 0px; padding-left: 292px; padding-right: 0px;">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 ">
                                    <label class="col-sm-4 control-label no-padding-right" for="march_buyer_address" >Season </label>

                                    <button type="button" class="btn btn-xs" data-toggle="modal" data-target="#addSeasonModal" style="margin-left: 12px;"><i class="glyphicon glyphicon-plus"></i></button>
                                    <div class="col-xs-10" id="added_season" style="padding-top: 10px; margin: 0px; padding-left: 292px; padding-right: 0px;">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="clearfix form-actions">
                            <div class="col-md-offset-4 col-md-8">
                                <button class="btn btn-info" type="submit">
                                    <i class="ace-icon fa fa-check bigger-110"></i> Submit
                                </button>
                                &nbsp; &nbsp; &nbsp;
                                <button class="btn" type="reset">
                                    <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                                </button>
                            </div>
                        </div>

                        <!-- Add Sample Type  Modal-->
                        <div class="modal fade" id="sampleTypeModal" tabindex="-1" role="dialog" aria-labelledby="sizeLabel">
                            <div class="modal-dialog modal-xs" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title text-center">Add Sample Type</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div id="sampleTypeData">
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="march_color" >Sample Type <span style="color: red">&#42;</span> </label>
                                                        <div class="col-sm-6">
                                                            <input type="text" id="sample_name" name="sample_name[]" placeholder="Enter Text" class="col-xs-12" data-validation="required length custom" data-validation-length="1-50" data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$"/>
                                                        </div>
                                                        <button type="button" class="btn btn-sm btn-success AddBtn_bu" style="height: 30px; width: 30px;">+</button>
                                                        <button type="button" class="btn btn-sm btn-danger RemoveBtn_bu" style="height: 30px; width: 30px;">-</button>
                                                        <div id="msg" class="col-sm-9 pull-right" style="color: red">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix form-actions">
                                                    <div class="col-md-offset-3 col-md-9">
                                                        <button type="button" class="btn btn-info btn-sm"  id="sampleTypeModalDone" data-dismiss="modal"><i class="ace-icon fa fa-check bigger-110"></i> ADD
                                                        </button>
                                                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Add product size modal  -->
                        <div class="modal fade" id="addProductSizeModal" tabindex="-1" role="dialog" aria-labelledby="sizeLabel">
                            <div class="modal-dialog modal-xs" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title text-center">Add Product Size</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="product_type"  option:selected>Prtextlor: red">&#42;</span> </label>
                                                        <div class="col-sm-6">


                                                            {{ Form::select('product_type', $productType, null, ['placeholder'=>'Select Product Type','class'=> '', 'data-validation' => 'required','style'=>"width: 100%"]) }}


                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="gender" >Gender <span style="color: red">&#42;</span> </label>
                                                        <div class="col-sm-6">
                                                            <select name="gender" style="width: 100%" data-validation = 'required'>
                                                                  <option>Select</option>
                                                                  <option value="Men's">Men's</option>
                                                                  <option value="Ladies">Ladies</option>
                                                                  <option value="Boys/Girls">Boys/Girls</option>
                                                                  <option value="Girls">Girls</option>
                                                                  <option value="Women's">Women's</option>
                                                                  <option value="Men's & Ladies">Men's & Ladies</option>
                                                                  <option value="Baby Boys/Girls">Baby Boys/Girls</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                      <label class="col-sm-3 control-label no-padding-right" for="sg_name" >Size Group Name <span style="color: red">&#42;</span> </label>
                                                      <div class="col-sm-6">
                                                        <input type="text" id="sg_name" name="sg_name" placeholder="Enter Size Group Name" class="col-xs-12 form-control" data-validation="required length custom" data-validation-length="1-45" data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$"/>
                                                      </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label no-padding-right" for="sino" >Sizes<span style="color: red">&#42;</span></label>
                                                        <div class="col-sm-6">
                                                            <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#sizeModal">Select Size</button>
                                                            <div class="col-xs-12" id="show_selected_sizes" style="padding-top: 10px; margin: 0px; padding-left: 0px; padding-right: 0px;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix form-actions">
                                                        <div class="col-md-offset-3 col-md-9">
                                                            <button type="button" class="btn btn-info btn-sm" id="addProductSizeModalDone" data-dismiss="modal"><i class="ace-icon fa fa-check bigger-110"></i> ADD</button>
                                                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Select Size Items Modal -->
                        <div class="modal fade" id="sizeModal" tabindex="-1" role="dialog" aria-labelledby="sizeLabel">
                            <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title">Size Group</h4>
                                <div class="col-xs-10" id="show_selected_sizes2" style="padding-top: 10px; margin: 0px; padding-left: 0px; padding-right: 0px;">
                                </div>
                              </div>
                              <div class="modal-body" style="padding:0 15px">
                                @foreach($sizeModalData AS $modalData)
                                {!! $modalData !!}
                                @endforeach
                              </div>
                              <div class="modal-footer" style="background-color: #fff;">
                                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
                                <button type="button" id="sizeModalDone" class="btn btn-primary btn-sm">Done</button>
                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- Add Season Modal-->
                        <div class="modal fade" id="addSeasonModal" tabindex="-1" role="dialog" aria-labelledby="sizeLabel">
                            <div class="modal-dialog modal-xs" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title text-center">Add Season</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="se_name" > Season Name<span style="color: red">&#42;</span> </label>
                                                    <div class="col-sm-6">
                                                        <input type="text" name="se_name" id="se_name" placeholder="Season Name"  class="col-xs-12 form-control" data-validation="required length custom" data-validation-length="1-128" data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$" autocomplete="off"/>
                                                        <div id="suggesstion-box"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="se_mm_start" > Start Month-Year<span style="color: red">&#42;</span> </label>
                                                    <div class="col-sm-6">
                                                        <input type="text" name="se_mm_start" id="se_mm_start" placeholder="Month-y" class="form-control monthYearpicker" data-validation="required"/>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="se_mm_end" > End Month-Year<span style="color: red">&#42;</span> </label>
                                                    <div class="col-sm-6">
                                                        <input type="text" name="se_mm_end" id="se_mm_end" placeholder="Month-y" class="form-control monthYearpicker" data-validation="required"/>
                                                    </div>
                                                </div>
                                                <div class="clearfix form-actions">
                                                    <div class="col-md-offset-3 col-md-9">
                                                        <button type="button" class="btn btn-info btn-sm"  id="addSeasonModalDone"><i class="ace-icon fa fa-check bigger-110"></i>ADD</button>
                                                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div><!-- /.col -->

                <div class="col-sm-10 col-sm-offset-1">
                    <h5 class="page-header">Buyer Info List</h5>
                    <table id="dataTables" class="table table-striped responsive table-bordered">
                        <thead>
                            <tr>
                                <th>Buyer Name</th>
                                <th>Short Name</th>
                                <th>Address</th>
                                <th>Contact Persons</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($buyers as $buyer)
                                <tr>
                                    <!-- <td style="display:none;">{{ $buyer->b_id }}</td> -->
                                    <td>{{ $buyer->b_name }}</td>
                                    <td>{{ $buyer->b_shortname }}</td>
                                    <td>{{ $buyer->b_address }} <br> {{ $buyer->b_country }}</td>
                                    <td>{!! $buyer->buyer_contacts !!}</td>
                                    <td>
                                      <div class="btn-group">
                                        <a type="button" href="{{ url('merch/setup/buyer_info_edit/'.$buyer->b_id) }}" class='btn btn-xs btn-primary' title="Update"><i class="ace-icon fa fa-pencil bigger-120"></i></a>
                                        <a type="button" href="{{ url('merch/setup/buyer_profile/'.$buyer->b_id) }}" class='btn btn-xs btn-primary' title="View"><i class="ace-icon fa fa-eye bigger-120"></i></a>
                                         <a href="{{ url('merch/setup/buyerdelete/'.$buyer->b_id) }}" type="button" class='btn btn-xs btn-danger' onclick="return confirm('Are you sure you want to delete this Buyer?');" title="Delete"><i class="ace-icon fa fa-trash bigger-120"></i></a>
                                      </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!--- /. Row ---->
        </div><!-- /.page-content -->
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        //Data TAble Buyer///
        $('#dataTables').DataTable( {
        // "aoColumns": [{"bVisible": false},{"iDataSort": 0},null]
        //"orderable": false
    });

        //Add More Buyer Contact Person
        var buyerContactPersonAddData = '<div class="form-group">\
                                <label class="col-sm-4 control-label no-padding-right" for="march_buyer_contact" ></label>\
                                <div class="col-sm-8">\
                                    <textarea name="march_buyer_contact[]" class="col-sm-8"  data-validation="required length" data-validation-length="0-128"></textarea>\
                                    <div class="form-group col-sm-4">\
                                        <button type="button" class="btn btn-sm btn-danger RemoveBtn" style="height: 30px; width: 30px;">-</button>\
                                    </div>\
                                </div>\
                            </div>';

        $('body').on('click', '.AddBtn', function(){
            $("#contactPersonData").append(buyerContactPersonAddData);
        });

        $('body').on('click', '.RemoveBtn', function(){
            $(this).parent().parent().parent().remove();
        });

        //Add More Contact Data 2
        var contractdata2 = $("#contactPersonData2").html();

        var modal = $("#addBrandModal");
        $('body').on('click', '.AddBtn2', function(){
            $("#contactPersonData2").append(contractdata2);
        });

        $('body').on('click', '.RemoveBtn2', function(){
        $(this).parent().parent().parent().remove();
        });

        //Add More Sample Type
        var sampleTypeData = '<div class="form-group">\
                    <label class="col-sm-3 control-label no-padding-right" for="march_color" ></label>\
                    <div class="col-sm-6">\
                        <input type="text" id="sample_name" name="sample_name[]" placeholder="Enter Text" class="col-xs-12" data-validation="required length custom" data-validation-length="1-50" data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$"/>\
                    </div>\
                    <button type="button" class="btn btn-sm btn-danger RemoveBtn_bu" style="height: 30px; width: 30px;">-</button>\
                    <div id="msg" class="col-sm-9 pull-right" style="color: red">\
                    </div>\
                </div>';

        $('body').on('click', '.AddBtn_bu', function(){
            $("#sampleTypeData").append(sampleTypeData);
        });

        $('body').on('click', '.RemoveBtn_bu', function(){
            $(this).parent().remove();
        });


        //Add more Brand Name
        var brandData = '<div class="form-group">\
                        <label class="col-sm-4 control-label no-padding-right" for="brand_name" ></label>\
                        <div class="col-sm-8">\
                            <input type="text" id="brand_name" name="brand_name[]" placeholder="Brand name" class="col-sm-9" data-validation="required length custom" data-validation-length="1-50" data-validation-regexp="^([,./;:-_()%$&a-z A-Z0-9]+)$"/>\
                            <div class="form-group col-xs-3 col-sm-3">\
                                <button type="button" class="btn btn-sm btn-danger RemoveBtnBrand" style="height: 30px; width: 30px;">-</button>\
                            </div>\
                        </div>\
                    </div>';
        $('body').on('click', '.AddBtnBrand', function(){
            $("#BrandName").append(brandData);
        });

        $('body').on('click', '.RemoveBtnBrand', function(){
            $(this).parent().parent().parent().remove();
        });


        //Select Product Sizes
        var modal = $("#sizeModal");
        $("body").on("click", "#sizeModalDone", function(e) {
            var data="";
            //-------- modal actions ------------------
            modal.find('.modal-body input[type=checkbox]').each(function(i,v) {
                if ($(this).prop("checked") == true)
                {
                    data+= '<button type="button" class="btn btn-sm" style="margin:2px; padding:2px;">'+$(this).next().text()+'</button>';
                    data+= '<input type="hidden" name="seleted_sizes[]" value="'+$(this).next().text()+'"></input>';
                }
            });
            modal.modal('hide');
            $("#show_selected_sizes").html(data);
        });


        // Sample Type 2 modal
        var modal2 = $("#sampleTypeModal");
        $("body").on("click", "#sampleTypeModalDone", function(e) {
            if(modal2.find('input[name="sample_name[]"]').val()){
                var data="";
                var tr_end = 0;
                //-------- modal actions ------------------
                data += '<table class="table" style="margin-top: 30px;">';
                data += '<thead>';
                data += '<tr>';
                data += '<td colspan="3" class="text-center">Sample Type</td>';
                data += '</tr>';
                data += '</thead>';
                data += '<tbody>';
                modal2.find('input[name="sample_name[]"]').each(function(i,v) {
                if ($(this).val()) {
                    data += '<tr>';
                    data += '<td style="border-bottom: 1px solid lightgray;" class="text-center"><strong>'+$(this).val()+'</strong></td>';
                    data+= '<input type="hidden" name="opr_id[]" value="'+$(this).val()+'"></input>';
                    data += '</tr>';
                }
                });
                data += '</tbody>';
                data += '</table>';
                $("#added_sample_type").html(data);
            }
            modal2.modal('hide');
        });


        //Product Size Modal
        var modal3 = $("#addProductSizeModal");
        $("body").on("click", "#addProductSizeModalDone", function(e) {
            if(modal3.find('input[name="sg_name"]').val() ){
                var data="";
                var tr_end = 0;
                //-------- modal actions ------------------
                data += '<table class="table table-bordered">';
                // gender
                data += '<tr>';
                data += '<td style="font-weight:bold">Gender</td>';
                data += '<td>'+modal3.find('select[name="gender"]').attr('selected', true).val()+'</td>';
                data += '</tr>';
                // group name
                data += '<tr>';
                data += '<td style="font-weight:bold">Group Name</td>';
                modal3.find('input[name="sg_name"]').each(function(i,v) {
                if ($(this).val() != null) {
                        data += '<td>'+$(this).val();
                        data += '<input type="hidden" name="opr_id[]" value="'+$(this).val()+'"></input>';
                        data += '</td>';
                    }
                });
                data += '</tr>';
                // product type
                data += '<tr>';
                data += '<td style="font-weight:bold">Product Type</td>';
                data += '<td>'+modal3.find('select[name="product_type"] option:selected').text()+'</td>';
                data += '</tr>';
                // size
                data += '<tr>';
                data += '<td style="font-weight:bold">Sizes</td>';
                data += '<td>';
                modal.find('.modal-body input[type=checkbox]').each(function(i,v) {
                    if ($(this).prop("checked") == true) {
                        if(i == 0) {
                            data += $(this).next().text()+', ';
                        } else {
                            data += $(this).next().text()+', ';
                        }
                    }
                });
                data += '</td>';
                data += '</tr>';

                data += '</table>';
                $("#added_product_size").html(data);
            }
        modal3.modal('hide');
        });

        //end of product size modal


        var modal4 = $("#addBrandModal");
        $("body").on("click", "#addBrandModalDone", function(e) {
            if(modal4.find('input[name="march_brand_name2"]').val() && $('#brand_country :selected').val()){
                var data="";
                var tr_end = 0;
                //-------- modal actions ------------------
                data += '<table class="table" style="margin-top: 30px;">';
                data += '<thead>';
                data += '<tr>';
                data += '<td colspan="3" class="text-center">Brand Name</td>';
                data += '<td colspan="3" class="text-center">Country</td>';
                data += '</tr>';
                data += '</thead>';
                data += '<tbody>';
                data += '<tr>';
                data += '<td style="border-bottom: 1px solid lightgray;" class="text-center" colspan="3"><strong>'+modal4.find('input[name="march_brand_name2"]').val()+'</strong></td>';
                data += '<td style="border-bottom: 1px solid lightgray;" class="text-center" colspan="3"><strong>'+$('#brand_country :selected').text()+'</strong></td>';
                data+= '<input type="hidden" name="opr_id[]" value="'+$(this).val()+'"></input>';
                data += '</tr>';
                data += '</tbody>';
                data += '</table>';
                $("#added_brand").html(data);
                $("#added_brand2").html(data);
            }
            modal4.modal('hide');
        });


        //Add Season Modal
        var modal5 = $("#addSeasonModal");
        $("body").on("click", "#addSeasonModalDone", function(e) {
            if(modal5.find('input[name="se_name"]').val() && modal5.find('input[name="se_mm_start"]').val() && modal5.find('input[name="se_mm_end"]').val()){

                var data="";
                var tr_end = 0;
                //-------- modal actions ------------------
                data += '<table class="table" style="margin-top: 30px;">';
                data += '<thead>';
                data += '<tr>';
                data += '<td colspan="3" class="text-center">Season Name</td>';
                data += '<td colspan="3" class="text-center">Start</td>';
                data += '<td colspan="3" class="text-center">End</td>';
                data += '</tr>';
                data += '</thead>';
                data += '<tbody>';
                data += '<tr>';
                data += '<td style="border-bottom: 1px solid lightgray;" class="text-center" colspan="3"><strong>'+modal5.find('input[name="se_name"]').val()+'</strong></td>';
                data += '<td style="border-bottom: 1px solid lightgray;" class="text-center" colspan="3"><strong>'+modal5.find('input[name="se_mm_start"]').val()+'</strong></td>';
                data += '<td style="border-bottom: 1px solid lightgray;" class="text-center" colspan="3"><strong>'+modal5.find('input[name="se_mm_end"]').val()+'</strong></td>';
                data+= '<input type="hidden" name="opr_id[]" value="'+$(this).val()+'"></input>';
                data += '</tr>';
                data += '</tbody>';
                data += '</table>';
                $("#added_season").html(data);
                }
            modal5.modal('hide');
        });
    });
</script>
@endsection
