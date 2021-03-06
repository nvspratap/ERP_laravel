@extends('commercial.index')
@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#"> Commercial </a>
                </li> 
                <li>
                    <a href="#"> Setup </a>
                </li>
                <li class="active"> Insurance Edit</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content"> 
            <div class="page-header">
                <h1>Setup <small><i class="ace-icon fa fa-angle-double-right"></i> Insurance Edit</small></h1>
            </div>
            <div class="col-sm-6 ">
                 {{ Form::open(["url"=>"commercial/setup/insurance_update", "class"=>"form-horizontal"]) }}

                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right align-left" for="company_name" >Company Name<span style="color: red">&#42;</span> </label>
                          <div class="col-sm-9">
                            <input type="text" name="company_name" id="company_name" value="{{$insurance->company_name}}" class="col-xs-12" data-validation="required length custom" data-validation-length="1-45"  data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$"/>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right align-left" for="code" >Code<span style="color: red">&#42;</span> </label>
                          <div class="col-sm-9">
                            <input type="text" name="code" id="code" value="{{$insurance->code}}" class="col-xs-12" data-validation="required length custom" data-validation-length="1-45" data-validation-regexp="^([,-./;:_()%$&a-z A-Z0-9]+)$" />
                          </div>
                        </div>  
 
                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9"> 
                                <button class="btn btn-info" type="submit">
                                  <input type="hidden" name="insurance_id" value="{{$insurance->id}}">
                                    <i class="ace-icon fa fa-check bigger-110"></i> Update
                                </button>

                                &nbsp; &nbsp; &nbsp;
                                <button class="btn" type="reset">
                                    <i class="ace-icon fa fa-undo bigger-110"></i> Reset
                                </button>
                            </div>
                        </div>
                       
                    </form> 
            </div>
        </div>

    </div>  {{-- main content inner end --}}
</div>   {{-- main content end --}}

@endsection