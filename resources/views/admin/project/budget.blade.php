@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('datta-able/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{ asset('dist/css/customer-panel.min.css')}}">
@endsection

@section('content')
<div class="col-sm-12">
  <div class="card mb-2">
    <div class="card-header">
      <h5>
        <div class="top-bar-title padding-bottom">{{ __('Project No') }}{{ '#' . $project->id }} : {{ $project->name }} &nbsp;<span class="color_84c529 f-16">{{ $project->status_name }}</span></div>
      </h5>
    </div>
    <div class="card-body p-0">
      @include('layouts.includes.project_navbar')
    </div>
    <div class="card-block m-t-10 bg_f4f7fa" id="project-overview-container">
      <div class="row">
        <div class="col-md-12">
          <div class="d-flex justify-content-between mb-3">
            <div class="">Budget : 100</div>
            <div class=""><button class="btn btn-primary custom-btn-small">New Work Type</button></div>
          </div>
          <div class="card mb-0">
            <div class="card-header">
              <h5 class="card-header-text">{{ __('Project Budget : List of Work Types') }}</h5>
              <span id="memberSetting" data-toggle="modal" data-target="#memberSettingModal" class="float-right cursor_pointer">
                <button class="btn btn-primary" id="btn-add-member"><i class="fas fa-plus f-14 mr-0"></i></button>
              </span>
            </div>
          </div>
          <div class="card-block task-comment p-15">
            <div class="row">
              @foreach($projectMembers as $data)
              <a href="{{ url('user/team-member-profile/'.$data->id) }}" class="mb-3">
                @if (!empty($data->imageIcon) && file_exists(public_path('uploads/user/' . $data->imageIcon)))
                <img alt=" "  src='{{url("uploads/user/".$data->imageIcon)}}' class="user-img img-radius" data-toggle="tooltip" data-placement="top" title="{{ $data->full_name }}">
                @else
                <img alt=" " src='{{url("dist/img/avatar.jpg")}}' class="user-img img-radius" data-toggle="tooltip" data-placement="top" title="{{ $data->full_name }}">
                @endif
              </a>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('js')
{{-- Select2 js --}}
<script src="{{ asset('dist/js/jquery.validate.min.js')}}"></script>
<script src="{{ asset('datta-able/plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{url('dist/js/progress-bar.min.js')}}"></script>
<script type="text/javascript">
  'use strict';
  var oldMembers = JSON.parse("{!! $oldMembers !!}");
  var from = "";
  var to = "";
  var projectId = "";
</script>
<script src="{{ asset('dist/js/custom/project.min.js') }}"></script>
@endsection
