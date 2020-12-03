@extends('layouts.dashboard.app')
@section('content')


<div style="margin-right:20px;margin-left:20px;font-size:25px">
    <section class="content-header">
        <h1>
            @lang('site.Edit') @lang('site.TheArticle')
        </h1>

        <ol class="breadcrumb">
            <li><a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
            <li><a href="{{route('articles.index')}}">@lang('site.Articles')</a></li>
            <li class="active">@lang('site.Edit')</li>
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
                action="{{route('dashboard.articles.update')}}">
                @csrf
                @method("PATCH")
                <div class="form-group">
                    <label for="title">@lang('site.ArticleTitle')</label>
                    <input type="text" class="form-control" name="title" value="{{$article->title}}">
                    @if ($errors->has('title')) <p style="color:red;">{{ $errors->first('title') }}</p> @endif

                    <label for="description">@lang('site.Description')</label>
                    <textarea type="text" class="form-control" name="description"
                        cols="3">{{$article->description}}</textarea>
                    @if ($errors->has('description')) <p style="color:red;">{{ $errors->first('description') }}</p>
                    @endif

                    <div class="input-group">
                        <label class="custom-file-label" for="images">@lang('site.AddImages')</label>
                        <br>
                        <div class="custom-file" style="display: inline-block;">
                            <input type="file" class="custom-file-input" name="images[]" multiple>
                        </div>
                    </div>
                    @if ($errors->has('images')) <p style="color:red;">{{ $errors->first('images') }}</p> @endif

                    <br>
                    <input type="hidden" name="id" value="{{$article->id}}">
                    <div class="input-group-append" style="display: inline-block;">
                        <label class="custom-file-label" for="images">@lang('site.EditImages')</label>
                        <br>
                        <button class="btn btn-primary" type="button" data-toggle="modal"
                            data-target="#fullHeightModalRight">EditImages</button>
                    </div>
                    <br>
                    <!-- ------------------------------------------------------------------------------------ -->
                    <!-- Button trigger modal -->

                    <br>
                    <!-- Full Height Modal Right -->
                    <div class="modal fade right" id="fullHeightModalRight" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel" aria-hidden="true">

                        <!-- Add class .modal-full-height and then add class .modal-right (or other classes from list above) to set a position to the modal -->
                        <div class="modal-dialog modal-full-height modal-right" role="document">


                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title w-100" id="myModalLabel">Modal title</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @foreach($article->images as $image)
                                    <div class="col-md-2">
                                        <div style=" display: inline-block;position: relative;">
                                            <img width="80px" height="80px" style="margin-top:10px;"
                                                src="{{asset('storage/images') . '/' .  $image->img}}" alt="">
                                            <input type="hidden" id="url{{$image->id}}"
                                                value="{{route('dashboard.article.image.delete',$image->id)}}">
                                            <button type="button" onclick="remove({{$image->id}},this);"
                                                style="position: absolute;top: 0;right: 0;" class="btn btn-tool"
                                                data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                                <i class="fa fa-remove"></i></button>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="modal-footer justify-content-center">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- -------------------------------------------------------------------- -->
                    <label for="department">@lang('site.Department')</label>
                    <select class="form-control" name="department">
                        @if(!$departments->isEmpty())
                          @foreach($departments as $department)
                            @if($article->department->id == $department->id)
                              @if(Lang::has(('site.' . $department->name),'ar'))
                              <option value="{{$department->id}}" selected>{{Lang::get('site.' . $department->name)}}</option>
                              @else
                              <option value="{{$department->id}}" selected>{{ $department->name}}</option>
                              @endif
                            @else
                              @if(Lang::has(('site.' . $department->name),'ar'))
                              <option value="{{$department->id}}">{{Lang::get('site.' . $department->name)}}</option>
                              @else
                              <option value="{{$department->id}}">{{ $department->name}}</option>
                              @endif
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

<!-- -----------------Script---------------- -->
<script>
    function remove(id, element) {
        url = document.getElementById("url" + id).value;
        $.ajax({
            url: url,
            type: 'DELETE',
            data: {
                "_token": "{{ csrf_token() }}"
            },
            success: function (result) {
                if (result.isDeleted) {
                    element.parentElement.parentElement.remove();
                }
            }
        });
    }

</script>
<!-- --------------End Script------------------- -->
@endsection
