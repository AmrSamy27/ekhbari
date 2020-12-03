@extends('layouts.dashboard.app')
@section('content')


<div style="margin-right:20px;margin-left:20px;font-size:25px">
    <section class="content-header">
        <h1>
            @lang('site.AssignEditor')
        </h1>

        <ol class="breadcrumb">
            <li><a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
            <li><a href="{{route('articles.index')}}">@lang('site.Articles')</a></li>
            <li class="active">@lang('site.AssignEditor')</li>
        </ol>
    </section>

</div>

<section class="content">
    <div class="box box-primary">

        <div class="box-body">
            <form style="font-size:15px;" enctype="multipart/form-data" method="post"
                action="{{route('dashboard.articles.assignedEditor')}}">
                @csrf
                <div class="form-group">
                   <input type="hidden" name="article_id" value="{{$article_id}}">
                    <!-- -------------------------------------------------------------------- -->
                    <label for="editor">@lang('site.Editors')</label>
                    <select class="form-control" name="id">
                        @if($editors != null)
                          @foreach($editors as $editor)
                          <option value="{{$editor->id}}">{{ $editor->email}}</option>                          
                          @endforeach
                        @else
                        <option value="null">@lang('site.DoesntExist')</option>                          
                        @endif
                    </select>
                    @if ($errors->has('department')) <p style="color:red;">{{ $errors->first('department') }}</p> @endif
                    <a class="btn btn-primary" href="{{route('dashboard.users.create')}}">@lang('site.AddEditor')</a>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</section>


@endsection
