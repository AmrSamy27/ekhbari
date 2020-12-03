@extends('layouts.dashboard.app')
@section('content')

<!-- ------------------------------- -->
<div style="margin-right:20px;margin-left:20px;font-size:25px">
    <section class="content-header">
        <h1>
            @lang('site.Edit') @lang('site.User')
        </h1>

        <ol class="breadcrumb">
            <li><a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
            @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('super_admin'))
            <li><a href="{{route('dashboard.users.index','all')}}">@lang('site.Users')</a></li>
            @else
            <li>
                <a href="{{route('dashboard.users.index','writers')}}">@lang('site.Users')</a>
            </li>
            @endif
            <li class="active">@lang('site.Edit')</li>
        </ol>
    </section>
</div>
<!-- --------------------------------------------------- -->
<section class="content">
    <div class="box box-primary">
        <div class="box-body">
            @if($user != null)
            <form style="font-size:25px;" enctype="multipart/form-data" method="post"
                action="{{route('dashboard.users.update')}}">
                @csrf
                <div class="form-group">
                    <label for="first_name">@lang('site.FirstName')</label>
                    <input type="text" class="form-control" name="first_name" value="{{$user->first_name}}">
                    @if ($errors->has('first_name')) <p style="color:red;">{{ $errors->first('first_name') }}</p> @endif
                    <label for="last_name">@lang('site.LastName')</label>
                    <input type="text" class="form-control" name="last_name" value="{{$user->last_name}}">
                    @if ($errors->has('last_name')) <p style="color:red;">{{ $errors->first('last_name') }}</p> @endif

                        <input type="hidden" name="id" value="{{$user->id}}">

                    <label for="email">@lang('site.Email')</label>
                    <input type="email" class="form-control" name="email" value="{{$user->email}}">
                    @if ($errors->has('email')) <p style="color:red;">{{ $errors->first('email') }}</p> @endif


                    <label for="image">@lang('site.UserImage')</label>
                    <input type="file" name="image" class="form-control" value="{{$user->profile_photo_path}}">
                    @if ($errors->has('image')) <p style="color:red;">{{ $errors->first('image') }}</p> @endif

                    <label for="role">@lang('site.TheRole')</label>
                    <select class="form-control" name="role">
                    @if(!$roles->isEmpty())
                        <option value="NULL" selected>لا يوجد</option>

                        @foreach($roles as $role)
                            @if(!auth()->user()->hasPermission('users-create'))
                                @if($role->name == 'writer')
                                    @if($role->name == $user->roles[0]->name)
                                    <option value="{{$role->name}}" selected>{{Lang::get('site.' . $role->display_name)}}</option>
                                    @else
                                    <option value="{{$role->name}}" >{{Lang::get('site.' . $role->display_name)}}</option>
                                    @endif
                                @endif
                            @else
                                @if($role->name == 'admin')
                                  @if(auth()->user()->hasRole('super_admin'))
                                    @if($role->name == $user->roles[0]->name)
                                    <option value="{{$role->name}}" selected>{{Lang::get('site.' . $role->display_name)}}</option>
                                    @else
                                    <option value="{{$role->name}}" >{{Lang::get('site.' . $role->display_name)}}</option>  
                                    @endif
                                  @endif
                                 @else
                                 <option value="{{$role->name}}">@lang('site.' . $role->display_name)</option>
                                @endif    
                            @endif
                        @endforeach
                        
                    @endif
                    </select>
                    @if ($errors->has('role')) <p style="color:red;">{{ $errors->first('role') }}</p> @endif

                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            @endif
        </div>
    </div>
</section>

<!-- ------------------------------------------------------ -->


@endsection
