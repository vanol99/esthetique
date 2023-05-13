@extends('back.base')

@section('content')
    <div class="content-page">
        <div class="content">
        @include("back._partials.errors-and-messages")
        <!-- Start Content-->
            <div class="container-fluid">
                <div class="row mt-3">

                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3>Clients</h3>
                            </div>
                            <div class="card-body">
                                <!-- Table -->
                                <div class="table-responsive datatable-custom">
                                    <table
                                        class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                                        <thead class="thead-light">
                                        <tr>
                                            <th>#N°</th>
                                            {{-- <th style="width: 15%">image</th>--}}
                                            <th style="width: 30%">name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Adresse</th>
                                        </tr>
                                        </thead>

                                        <tbody id="set-rows">
                                        @foreach($agents as $key=>$agent)
                                            <tr>
                                                <td>{{$agents->firstitem()+$key}}</td>
                                                {{--      <td>
                                                          <img class="rounded-circle" height="60px" width="60px" style="cursor: pointer"
                                                               onclick="location.href='{{route('estheticien.edit',[$agent['id']])}}'"

                                                               src="{{asset('storage/app/public/agent')}}/{{$agent['image']}}">
                                                      </td>--}}
                                                <td>
                                                    <a href="{{route('customer.edit',[$agent['id']])}}" class="d-block font-size-sm text-body">
                                                        {{$agent['name'].' '.$agent['lastname']}}
                                                    </a>
                                                </td>
                                                <td>
                                                    {{$agent['phone']}}
                                                </td>
                                                <td>
                                                    @if(isset($agent['email']))
                                                        <a href="mailto:{{ $agent['email'] }}" class="text-primary">{{ $agent['email'] }}</a>
                                                    @else
                                                        <span class="badge-pill badge-soft-dark text-muted">Email unavailable</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{$agent['adresse']}}
                                                </td>
                                                {{--    <td>
                                                        <label class="toggle-switch d-flex align-items-center mb-3" for="welcome_status_{{$agent['id']}}">
                                                            <input type="checkbox" name="welcome_status"
                                                                   class="toggle-switch-input"
                                                                   id="welcome_status_{{$agent['id']}}" {{$agent?($agent['is_active']==1?'checked':''):''}}
                                                                   onclick="location.href='{{route('admin.agent.status',[$agent['id']])}}'">

                                                            <span class="toggle-switch-label p-1">
                                                    <span class="toggle-switch-indicator"></span>
                                                </span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <a class="btn-sm btn-primary p-1 m-1"
                                                           href="{{route('admin.agent.view',[$agent['id']])}}">
                                                            <i class="fa fa-eye pl-1" aria-hidden="true"></i>
                                                        </a>
                                                        <a class="btn-sm btn-secondary p-1 pr-2 m-1"
                                                           href="{{route('admin.agent.edit',[$agent['id']])}}">
                                                            <i class="fa fa-pencil pl-1" aria-hidden="true"></i>
                                                        </a>
                                                    </td>--}}
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                </div>
                                <!-- End Table -->
                            </div>
                            <!-- Footer -->
                            <div class="card-footer">
                                <!-- Pagination -->
                                <div class="row justify-content-center justify-content-sm-between align-items-sm-center">
                                    <div class="col-sm-auto">
                                        <div class="d-flex justify-content-center justify-content-sm-end">
                                            <!-- Pagination -->
                                            {!! $agents->links() !!}
                                            <nav id="datatablePagination" aria-label="Activity pagination"></nav>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Pagination -->
                            </div>
                            <!-- End Footer -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


