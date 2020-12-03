@extends('layouts.dashboard.app')
@section('content')


<div style="margin-right:20px;margin-left:20px;font-size:25px">
    <section class="content-header">
        <h1>
            @lang('site.Create') @lang('site.Department')
        </h1>

        <ol class="breadcrumb">
            <li><a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
            <li><a href="{{route('dashboard.departments.index')}}">@lang('site.Departments')</a></li>
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
                action="{{route('dashboard.departments.store')}}">
                @csrf
                <div class="form-group">
                    <label for="name">@lang('site.name')</label>
                    <input type="text" class="form-control" name="name">
                    @if ($errors->has('name')) <p style="color:red;">{{ $errors->first('name') }}</p> @endif

                    <label for="image">@lang('site.image')</label>
                    <input type="file" name="image" class="form-control" >
                    @if ($errors->has('image')) <p style="color:red;">{{ $errors->first('image') }}</p> @endif

                    <label for="parent_department">@lang('site.ParentDepartment')</label>
                    <select class="form-control" name="parent_department">
                        @if(!$departments->isEmpty())
                        @foreach($departments as $department)
                        <option value="{{$department->id}}">@if(Lang::has('site.' . $department->name))
                                                                {{Lang::get('site.' . $department->name)}}
                                                            @else
                                                                {{$department->name}}
                                                            @endif
                        </option>
                        @endforeach
                        @else
                        @endif
                        <option value="{{NULL}}">@lang('site.DoesntHave')</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</section>

<!-- --------------a------------------- -->


@endsection
