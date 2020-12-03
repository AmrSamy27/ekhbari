@extends('layouts.dashboard.app')
@section('content')


<div style="margin-right:20px;margin-left:20px;font-size:25px">
    <section class="content-header">
        <h1>
            @lang('site.Create') @lang('site.Department')
        </h1>

        <ol class="breadcrumb">
            <li><a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
            <li><a href="{{route('departments.index')}}">@lang('site.Departments')</a></li>
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
            @if(isset($department))
            <form style="font-size:15px;" enctype="multipart/form-data" method="post"
                action="{{route('dashboard.departments.update')}}">
                @csrf
                <div class="form-group">
                    <label for="name">@lang('site.name')</label>
                    <input type="text" class="form-control" name="name" value="{{$department->name}}">
                    @if ($errors->has('name')) <p style="color:red;">{{ $errors->first('name') }}</p> @endif
<input type="hidden" name="id" value="{{$department->id}}">
                    <label for="image">@lang('site.image')</label>
                    <input type="file" name="image" class="form-control" value="{{$department->img}}">
                    @if ($errors->has('image')) <p style="color:red;">{{ $errors->first('image') }}</p> @endif

                    <label for="parent_department">@lang('site.ParentDepartment')</label>
                    <select class="form-control" name="parent_department">
                    <option value="{{NULL}}" selected>@lang('site.DoesntHave')</option>
    
                    @if(!$departments->isEmpty())
                            @foreach($departments as $singleDepartment)
                                @if($department->id != $singleDepartment->id)
                                    @if($department->parent != null && $department->parent->id == $singleDepartment->id)
                                        <option value="{{$department->id}}" selected>
                                        @if(Lang::has('site.' . $singleDepartment->name))
                                            {{Lang::get('site.' . $singleDepartment->name)}}
                                        @else
                                            {{$singleDepartment->name}}
                                        @endif
                                        </option>
                                    @else
                                       <option value="{{$department->id}}">
                                        @if(Lang::has('site.' . $singleDepartment->name))
                                            {{Lang::get('site.' . $singleDepartment->name)}}
                                        @else
                                            {{$singleDepartment->name}}
                                        @endif
                                        </option>
                                    @endif


                                @endif
                            @endforeach
                        @else
                        @endif
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            @endif
        </div>
    </div>
</section>

<!-- --------------a------------------- -->


@endsection
