@extends('layouts.dashboard.app')
@section('content')

<!-- ------------------------------- -->
<div style="margin-right:20px;margin-left:20px;font-size:25px">
    <section class="content-header">
        <h1>
            @lang('site.Create') @lang('site.User')
        </h1>

        <ol class="breadcrumb">
            <li><a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
            <li><a href="{{route('dashboard.users.index','all')}}">@lang('site.Users')</a></li>
            <li class="active">@lang('site.Create')</li>
        </ol>
    </section>
</div>
<!-- --------------------------------------------------- -->
<section class="content">
    <div class="box box-primary">
        <div class="box-body">
            <form style="font-size:25px;" enctype="multipart/form-data" method="post"
                action="{{route('dashboard.users.store')}}">
                @csrf
                <div class="form-group">
                    <label for="first_name">@lang('site.FirstName')</label>
                    <input type="text" class="form-control" name="first_name">
                    @if ($errors->has('first_name')) <p style="color:red;">{{ $errors->first('first_name') }}</p> @endif
                    <label for="last_name">@lang('site.LastName')</label>
                    <input type="text" class="form-control" name="last_name">
                    @if ($errors->has('last_name')) <p style="color:red;">{{ $errors->first('last_name') }}</p> @endif

                    <label for="email">@lang('site.Email')</label>
                    <input type="email" class="form-control" name="email">
                    @if ($errors->has('email')) <p style="color:red;">{{ $errors->first('email') }}</p> @endif

                    <label for="password">@lang('site.Password')</label>
                    <input type="password" class="form-control" name="password">
                    @if ($errors->has('password')) <p style="color:red;">{{ $errors->first('password') }}</p> @endif

                    <label for="password_confirmation">@lang('site.ConfirmPassword')</label>
                    <input type="password" class="form-control" name="password_confirmation">
                    @if ($errors->has('password_confirmation')) <p style="color:red;">
                        {{ $errors->first('password_confirmation') }}</p> @endif

                    <label for="image">@lang('site.UserImage')</label>
                    <input type="file" name="image" class="form-control">
                    @if ($errors->has('image')) <p style="color:red;">{{ $errors->first('image') }}</p> @endif

                    <label for="role">@lang('site.TheRole')</label>
                    <select class="form-control" name="role">
                        @if(!$roles->isEmpty())
                            @foreach($roles as $role)
                                @if($role->name != 'super_admin')
                               
                                    @if(!auth()->user()->hasPermission('users-create'))
                                        @if($role->name == 'writer')
                                        <option value="{{$role->name}}">{{Lang::get('site.' . $role->display_name)}}</option>
                                        @endif
                                    @else
                                        @if($role->name == 'admin')
                                            @if(auth()->user()->hasRole('super_admin'))
                                                <option value="{{$role->name}}">{{Lang::get('site.' . $role->display_name)}}</option>
                                            @endif
                                        @else
                                            <option value="{{$role->name}}">{{Lang::get('site.' . $role->display_name)}}</option>
                                        @endif
                                    @endif
                                @endif    
                            @endforeach
                        @else
                        <option value="NULL">لا يوجد</option>
                        @endif
                    </select>
                    @if ($errors->has('role')) <p style="color:red;">{{ $errors->first('role') }}</p> @endif

                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</section>

<!-- ------------------------------------------------------ -->


@endsection
