@extends('layouts.dashboard.app')
@section('content')
<div style="margin-right:20px;margin-left:20px;font-size:25px">
    <section class="content-header">
        <h1>
            @lang('site.Login')
        </h1>

        <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i>@lang('site.Login')</li>
        </ol>
    </section>
</div>
<!-- --------------------------------------------------- -->
<section class="content">
    <div class="box box-primary">
        <div class="box-body">
            <form style="font-size:25px;" enctype="multipart/form-data" method="post"
                action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    

                    <label for="email">@lang('site.Email')</label>
                    <input type="email" class="form-control" name="email">
                    @if ($errors->has('email')) <p style="color:red;">{{ $errors->first('email') }}</p> @endif

                    <label for="password">@lang('site.Password')</label>
                    <input type="password" class="form-control" name="password">
                    @if ($errors->has('password')) <p style="color:red;">{{ $errors->first('password') }}</p> @endif

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                @lang('site.RememberMe')
                            </label>
                    </div>
                </div>
                <div class="row" >
                    <button  type="submit" class="col-6 btn btn-primary">@lang('site.Login')</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
