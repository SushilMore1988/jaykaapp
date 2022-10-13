@extends('layouts.app')
@section('css')
{{-- select2 css --}}
<link rel="stylesheet" href="{{ asset('datta-able/plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('dist/css/item.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('dist/css/dropdown.min.css') }}">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
@endsection
@section('content')
  <!-- Main content -->
<div class="col-sm-12" id="add-item-container">
  <div class="card user-list">
    <div class="card-header">
      <h5><a href="{{ url('work-type') }}">{{ __('workType') }}</a> >> {{ __('New WorkType') }}</h5>
      <div class="card-header-right">

      </div>
    </div>
    <div class="card-block">
      <div class="form-tabs">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active text-uppercase" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="true">{{ __('Work Type Information') }}</a>
          </li>

        </ul>
      </div>
      <form class="form-horizontal" action="{{ url('store/work-type') }}" method="post" enctype="multipart/form-data">
        <input type="hidden" value="{{ csrf_token() }}" name="_token" id="token">
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group row ">

                  <label class="col-sm-2 control-label require">{{ __('WorkType Name') }}</label>
                  <div class="col-sm-8 pl-sm-3-custom">
                    <input type="text" class="form-control" placeholder="{{ __('WorkTypeName')  }}" name="name" id="item_name" value="{{ old('Name') }}">
                    <span id="checkMsg" class="text-danger"></span>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 control-label">{{  __('Category')  }}</label>
                  <div class="col-sm-8 pl-sm-3-custom">
                    <select class="form-control validation_select select2" name="category">
                      <option value="Material">Material</option>
                      <option value="Machinary">Machinary</option>
                      <option value="Labour">Labour</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 control-label">{{  __('Parent Work Type')  }}</label>
                  <div class="col-sm-8 pl-sm-3-custom">
                    <select class="form-control validation_select select2" name="parent_id">
                        <option value="">Select Parent Work Type</option>
                      @foreach($workTypes as $workType)

                      <option value="{{ $workType->id }}">{{ $workType->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
            </div>
        </div>
          <div class="col-sm-8 pl-sm-3-custom px-0 mobile-margin">
            <button class="btn btn-primary custom-btn-small custom-variant-title-validation" type="submit" id="btnSubmit">{{  __('Submit')  }}</button>
            <a href="{{ url('work-type') }}" class="btn btn-danger custom-btn-small">{{ __('Cancel') }}</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function(){
        (function($){
	$('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
	  if (!$(this).next().hasClass('show')) {
		$(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
	  }
	  var $subMenu = $(this).next(".dropdown-menu");
	  $subMenu.toggleClass('show');

	  $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
		$('.dropdown-submenu .show').removeClass("show");
	  });

	  return false;
	});
})(jQuery)
    });
</script>
<script src="{{ asset('datta-able/plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{ asset('dist/js/jquery.validate.min.js')}}"></script>
{!! translateValidationMessages() !!}
<script src="{{ asset('dist/js/custom/item.min.js') }}"></script>
@endsection
