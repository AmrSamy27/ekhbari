@extends('layouts.dashboard.app')
@section('content')
<section class="content-header">
        <h1>
            @lang('site.dashboard')
        </h1>

        <ol class="breadcrumb">
            <li class="active"><a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
        </ol>
    </section>

    <section class="content">
        @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('super_admin'))
<div class="box box-primary">
    <div class="box-header with-border">
        <h3>@lang('site.Logs')</h3>
      </div>
        <div class="box-body">
            <div class="card">
                <div class="card-body">
                    <table  class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">@lang('site.TheUser')</th>
                                <th scope="col">@lang('site.TheRole')</th>
                                <th scope="col">@lang('site.Operation')</th>
                                <th scope="col">@lang('site.Date')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($logs != null )
                                @foreach($logs as $index => $log)
                                    @if($log->user->roles[0]->name == 'super_admin')
                                        @if(auth()->user()->hasRole('super_admin'))
                                        <tr>
                                            <th scope="row">{{$index+1}}</th>
                                            <td>{{$log->user->email}}</td>
                                            <td>
                                                @foreach($log->user->roles as $role)
                                                    @if(Lang::has('site.' . $role->display_name))
                                                        @lang('site.' . $role->display_name)
                                                    @else
                                                        {{$role->name}}
                                                    @endif,
                                                @endforeach
                                            </td>
                                            <td>{{$log->description}}</td>
                                            <td>{{$log->created_at}}</td>
                                           
                                        </tr>
                                        @endif
                                   
                                    @else
                                    <tr>
                                        <th scope="row">{{$index+1}}</th>
                                        <td>{{$log->user->email}}</td>
                                        <td>
                                            @foreach($log->user->roles as $role)
                                                @if(Lang::has('site.' . $role->display_name))
                                                    @lang('site.' . $role->display_name)
                                                @else
                                                    {{$role->name}}
                                                @endif,
                                            @endforeach
                                        </td>
                                        <td>{{$log->description}}</td>
                                        <td>{{$log->created_at}}</td>

                                    </tr>
                                    @endif
                                @endforeach
                            <tr><td>{{$logs->links()}}</td></tr>
                            @endif

                        </tbody>

                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
    @else
    <h1>This is the Dashboard</h1>
    @endif
    </section>
@endsection
