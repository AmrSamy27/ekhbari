@extends('layouts.dashboard.app')
@section('content')


<div style="margin-right:20px;margin-left:20px;font-size:25px">
<section class="content-header">
        <h1>
        @lang('site.Create') @lang('site.Article')
        </h1>

        <ol class="breadcrumb">
            <li ><a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
            <li ><a href="{{route('articles.index')}}">@lang('site.Articles')</a></li>
            <li class="active">@lang('site.Create')</li>
        </ol>
    </section>

</div>

    <section class="content">
    <div class="box box-primary">
    <!-- <div class="box-header">
        <h2 class="box-title" ></h2>
    </div> -->
    <div class="box-body">
    <form style="font-size:15px;" enctype="multipart/form-data" method="post"
        action="{{route('dashboard.articles.store')}}">
        @csrf
        <div class="form-group">
            <label for="title">@lang('site.ArticleTitle')</label>
            <input type="text" class="form-control" name="title">
            @if ($errors->has('title')) <p style="color:red;">{{ $errors->first('title') }}</p> @endif

            <label for="description">@lang('site.Description')</label>
            <textarea type="text" class="form-control" name="description" cols="3"></textarea>
            @if ($errors->has('description')) <p style="color:red;">{{ $errors->first('description') }}</p> @endif

            <label for="images">@lang('site.ArticleImages')</label>
            <input type="file" name="images[]" class="form-control" multiple>
            @if ($errors->has('images')) <p style="color:red;">{{ $errors->first('images') }}</p> @endif

            <label for="department">@lang('site.Department')</label>
            <select class="form-control" name="department">
                @if(!$departments->isEmpty())
                  @foreach($departments as $department)
                    @if(Lang::has(('site.' . $department->name),'ar'))
                      <option value="{{$department->id}}">{{Lang::get('site.' . $department->name)}}</option>
                    @else
                      <option value="{{$department->id}}">{{ $department->name}}</option>
                    @endif
                  @endforeach
                @else
                @endif
            </select>
            @if ($errors->has('department')) <p style="color:red;">{{ $errors->first('department') }}</p> @endif
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
</div>
    </section>

<!-- --------------------------------- -->


@endsection
