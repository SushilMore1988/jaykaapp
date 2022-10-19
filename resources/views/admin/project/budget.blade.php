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
              <div class="">Budget : {{ round($project->cost) }}</div>
              <div class=""><a href="{{ url('create/work-type') }}"class="btn btn-primary custom-btn-small">New Work Type</a></div>
            </div>
            <div class="card mb-0">
              <div class="card-header">
                <h5 class="card-header-text">{{ __('Project Budget : List of Work Types') }}</h5>
                <span id="memberSetting" data-toggle="modal" data-target="#memberSettingModal" class="float-right cursor_pointer">
                  <a href="" class="btn btn-primary" id="btn-add-member" data-toggle="modal" data-target="#myModal"><i class="fas fa-plus f-14 mr-0 mt-2"></i></a>
                </span>
              </div>
            </div>
            <div class="card-block task-comment p-15">
              <div class="row">
                
                {{-- <a href="{{ url('user/team-member-profile/'.$data->id) }}" class="mb-3">
                  @if (!empty($data->imageIcon) && file_exists(public_path('uploads/user/' . $data->imageIcon)))
                  <img alt=" "  src='{{url("uploads/user/".$data->imageIcon)}}' class="user-img img-radius" data-toggle="tooltip" data-placement="top" title="{{ $data->full_name }}">
                  @else
                  <img alt=" " src='{{url("dist/img/avatar.jpg")}}' class="user-img img-radius" data-toggle="tooltip" data-placement="top" title="{{ $data->full_name }}">
                  @endif
                </a> --}}

                    {{-- table --}}
                      <div class="container mt-5">
                          <table class="table table-bordered yajra-datatable">
                              <thead>
                                  <tr>
                                      <th>Sr. No.</th>
                                      <th>Work Type</th>
                                      <th>Budget</th>
                                      <th>Remaining</th>
                                      <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                @foreach($budget as $data)
                                  <tr>
                                      <td>{{ $loop->index + 1 }}</td>
                                      <td>{{ $data->workType->name }}</td>
                                      <td>{{ $data->budget }}</td>
                                      <td>{{ $data->getRemainingBudget() }}</td>
                                      <td>edit/delete</td>
                                  </tr>
                                @endforeach
                              </tbody>
                          </table>
                      </div>
                  {{-- table --}}

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog">
          <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                  <p>Some text in the modal.</p>
                  <form action="{{ url('budget/store') }}"  method="post" class="needs-validation" novalidate>
                    @csrf
                    <input type="hidden" id="custId" name="project_id" value="{{ $project->id }}">
                    <div class="form-group">
                      <label for="WorkType">WorkType:</label>
                      <select class = "form-control" id = "WorkType" name="work_type">
                          @foreach($workTypes as $workType)
                          <option value="{{ $workType->id }}">{{ $workType->name }}</option>
                          @endforeach
                      </select>
                    </div>
                    <div class = "form-group">
                        <label for = "Budget">Budget</label>
                        <input type = "number" class = "form-control p-2" name="budget">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                  </form>
                </div>
              </div>
      </div>
  </div>
  <!-- Modal -->

@endsection

@section('js')
  {{-- Select2 js --}}
  <script src="{{ asset('dist/js/jquery.validate.min.js')}}"></script>
  <script src="{{ asset('datta-able/plugins/select2/js/select2.full.min.js')}}"></script>
  <script src="{{url('dist/js/progress-bar.min.js')}}"></script>
  {{-- <script type="text/javascript">
    'use strict';
    var oldMembers = JSON.parse("{!! $oldMembers !!}");
    var from = "";
    var to = "";
    var projectId = "";
  </script> --}}
  <script src="{{ asset('dist/js/custom/project.min.js') }}"></script>
@endsection
