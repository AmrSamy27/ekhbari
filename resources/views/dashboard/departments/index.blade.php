@extends('layouts.dashboard.app')
@section('content')

<div style="margin-right:20px;margin-left:20px;font-size:25px">
    <section class="content-header">
        <h1>
            @lang('site.Departments')
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
            <li class="active">@lang('site.Departments')</li>
        </ol>
    </section>

</div>

<!-- ------------------------------------------------- -->
<section class="content">
    <div class="box box-primary">
    <div class="box-header with-border">
        <h3>@lang('site.Departments')</h3>
       @auth
          <div class="row">
            <div class="col-md-4">
              @if(auth()->user()->hasPermission('departments-create'))
              <a  class="btn btn-primary" href="{{route('dashboard.departments.create')}}"><i class="fa fa-plus"></i>@lang('site.Create')</a>
              @endif
            </div>
          </div>
        @endauth
      </div>
        <div class="box-body">
        <div class="card card-primary">
              
              <div class="card-body">
                <div class="row">
                @if(!$departments->isEmpty())
                  @foreach($departments as $department)
                  <div class="col-md-4" style="text-align: center;">
                  
                    <a href="{{route('articles.department',$department->id)}}" >
                      <img src="{{asset($department->img)}}" width="100%" height="200px" class="img-fluid mb-2" alt="white sample"/>
                    
                    <h3 style="margin-right: 10px;">{{$department->name}}</h3>
                  </a>
                @auth
                  @if($department->name != 'الاخبار')
                  @if(auth()->user()->hasPermission('departments-update') || auth()->user()->hasPermission('departments-delete'))
                      @foreach($department->users as $user)
                      @if(auth()->user()->id == $user->id || auth()->user()->hasRole('admin') || auth()->user()->hasRole('super_admin'))
                          <a class="btn btn-primary" href="{{route('dashboard.department.edit',$department->id)}}" style="float:right;">
                            edit
                          </a>
                          <form action="{{route('dashboard.department.destroy',$department->id)}}" method="post">
                              @csrf
                              @method('DELETE')  
                              <button class="btn btn-primary" type="submit" style="float:left;">
                                delete    
                              </button>
                          </form>
                  
                      @endif
                      @endforeach
                    @endif
                  @endif
                  @endauth
                  </div>
                  @endforeach
                  @else
                  <div class="col-12 " style="text-align: center;">
                    <h3 >@lang('site.DoesntExist')</h3></a>
                  </div>
                  @endif
                </div>
              </div>
            </div>
        </div>
    </div>
</section>
<!-- ------------------------------------------------- -->

<!-- ------------------------------------------ -->
@endsection
