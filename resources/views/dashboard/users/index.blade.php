@extends('layouts.dashboard.app')
@section('content')
<section class="content-header">
    <h1>
        @lang('site.Users')
        @if($role == "users")
        <small>@lang('site.TheUsers')</small>
        @elseif($role == "writers")
        <small>@lang('site.Writers')</small>
        @elseif($role == 'editors')
        <small>@lang('site.TheEditors')</small>
        @elseif($role == "all")
        <small>@lang('site.allUsers')</small>
        @else
        <small>@lang('site.Admins')</small>
        @endif
    </h1>
<h2>
</h2>
    <ol class="breadcrumb">
        <li class="active"><a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
        <li class="active">@lang('site.Users')</li>
    </ol>
</section>
<!-- ------------------------------------------ -->
<section class="content">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3>@lang('site.Users')</h3>
        <form action="">
          <div class="row">
            
            <div class="col-md-4">
              @if(auth()->user()->hasPermission('users-create') || auth()->user()->hasPermission('writers-create'))
              <a  class="btn btn-primary" href="{{route('dashboard.users.create')}}"><i class="fa fa-plus"></i>@lang('site.Create')</a>
              @endif
            </div>
          </div>
        </form>
      </div>
        <div class="box-body">
            <div class="card">
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">@lang('site.FirstName')</th>
                                <th scope="col">@lang('site.LastName')</th>
                                <th scope="col">@lang('site.Email')</th>
                                <th scope="col">@lang('site.TheRole')</th>
                                <th scope="col">@lang('site.Status')</th>

                                
                            </tr>
                        </thead>
                        <tbody>
                          @if($users != null)
                            @foreach($users as $index => $user) 
                              @if(auth()->user()->hasRole('admin') || (auth()->user()->hasRole('editor') && !$user->hasRole('user') && !$user->hasRole('admin') &&!$user->hasRole('super_admin')) || auth()->user()->hasRole('super_admin'))
                                @if(auth()->user()->hasRole('super_admin'))
                                    <tr>
                                        <th scope="row">{{$index+1}}</th>
                                        <td>{{$user->first_name}}</td>
                                        <td>{{$user->last_name}}</td>
                                        <td>{{$user->email}}</td>
                                      
                                        <td>@foreach($user->roles as $role) {{Lang::get('site.' . $role->display_name)}} @endforeach</td>
                                        @if($user->status == 1)
                                        <td><i class="fa fa-circle text-success"></i>@lang('site.Online')</td>
                                        @else
                                        <td><i class="fa fa-circle text-danger"></i>@lang('site.Offline')</td>
                                        @endif
                                        @if(!$user->hasRole('super_admin'))
                                        <td><a style="font-size:15px;" href="{{route('dashboard.users.edit',$user->id)}}" class="btn btn-info btn-sm">@lang('site.Edit')</a></td>
                                        <td>
                                          <form action="{{route('dashboard.users.destroy',$user->id)}}" method="post">
                                            @csrf
                                            {{method_field('delete')}}
                                            <button type="submit" class="btn btn-danger btn-sm" style="font-size:15px;" >@lang('site.Delete')</button>
                                          </form>
                                        </td>
                                        @endif
                                     </tr>
                                @else
                                  @if(auth()->user()->hasRole('admin'))
                                    @if(!$user->hasRole('super_admin') && !$user->hasRole('admin'))  
                                      <tr>
                                      <th scope="row">{{$index+1}}</th>
                                      <td>{{$user->first_name}}</td>
                                      <td>{{$user->last_name}}</td>
                                      <td>{{$user->email}}</td>
                                      <td>@foreach($user->roles as $role) {{Lang::get('site.' . $role->display_name)}} @endforeach</td>
                                      @if($user->status == 1)
                                      <td><i class="fa fa-circle text-success"></i>@lang('site.Online')</td>
                                      @else
                                      <td><i class="fa fa-circle text-danger"></i>@lang('site.Offline')</td>
                                      @endif
                                      <td><a style="font-size:15px;" href="{{route('dashboard.users.edit',$user->id)}}" class="btn btn-info btn-sm">@lang('site.Edit')</a></td>
                                      <td>
                                        <form action="{{route('dashboard.users.destroy',$user->id)}}" method="post">
                                          @csrf
                                          {{method_field('delete')}}
                                          <button type="submit" class="btn btn-danger btn-sm" style="font-size:15px;" >@lang('site.Delete')</button>
                                        </form>
                                      </td>
                                      </tr>
                                    @endif
                                  @else
                                   @if($user->hasRole('writer'))
                                   <tr>
                                      <th scope="row">{{$index+1}}</th>
                                      <td>{{$user->first_name}}</td>
                                      <td>{{$user->last_name}}</td>
                                      <td>{{$user->email}}</td>
                                      <td>@foreach($user->roles as $role) {{Lang::get('site.' . $role->display_name)}} @endforeach</td>
                                      @if($user->status == 1)
                                      <td><i class="fa fa-circle text-success"></i>@lang('site.Online')</td>
                                      @else
                                      <td><i class="fa fa-circle text-danger"></i>@lang('site.Offline')</td>
                                      @endif
                                      @if(auth()->user()->id == $user->created_by)
                                      <td><a style="font-size:15px;" href="{{route('dashboard.users.edit',$user->id)}}" class="btn btn-info btn-sm">@lang('site.Edit')</a></td>
                                      <td>
                                        <form action="{{route('dashboard.users.destroy',$user->id)}}" method="post">
                                          @csrf
                                          {{method_field('delete')}}
                                          <button type="submit" class="btn btn-danger btn-sm" style="font-size:15px;" >@lang('site.Delete')</button>
                                        </form>
                                      </td>
                                      @endif
                                    </tr>
                                   @endif
                                  @endif
                                @endif
                              @endif
                            @endforeach
                          @endif
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</section>
<!-- --------------------------------------- -->
@endsection
