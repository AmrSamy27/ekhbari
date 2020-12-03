@extends('layouts.dashboard.app')
@section('content')

<div style="margin-right:20px;margin-left:20px;font-size:25px">
    <section class="content-header">
        <h1>
            @if($dashboard == true)
            @lang('site.YourArticles')
            @else
            @lang('site.Articles')
            @endif
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('dashboard.index')}}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
            @if($dashboard == true)
            <li class="active">@lang('site.YourArticles')</li>
            @else
            <li class="active">@lang('site.Articles')</li>
            @endif
        </ol>
    </section>

</div>

<!-- ------------------------------------------------- -->
<section class="content">
    <div class="box box-primary">
    <div class="box-header with-border">
        <h3>@lang('site.Articles')</h3>
        <form action="">
          <div class="row">
           
            @auth
                <div class="col-md-4">
                @if(auth()->user()->hasPermission('articles-create'))
                  <a  class="btn btn-primary" href="{{route('dashboard.articles.create')}}"><i class="fa fa-plus"></i>@lang('site.Create')</a>
                @endif
                </div>
            @endauth
          </div>
                  </form>
      </div>
        <div class="box-body">
            <div class="card">
                <div class="card-body">
                    <table  class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">@lang('site.ArticleTitle')</th>
                                <th scope="col">@lang('site.ArticlePublisher')</th>
                                <th scope="col">@lang('site.Department')</th>

                            </tr>
                        </thead>
                        <tbody>
                            @if($articles != null)
                                <tr>{{ $articles->links() }}</tr>

                                @foreach($articles as $index => $article)
                                <tr>
                                    <th scope="row">{{$index+1}}</th>
                                    <td>{{$article->title}}</td>
                                    @if($article->articleEditor != null)
                                    <td>{{$article->articleEditor->email}}</td>
                                    @else
                                    <td>{{$article->articleWriter->email}}</td>
                                    @endif
                                    @if(Lang::has('site.' . $article->department->name))
                                    <td>{{Lang::get('site.' . $article->department->name)}}</td>
                                    @else
                                    <td>{{$article->department->name}}</td>
                                    @endif
                                    <td><a href="{{route('articles.show',$article->id)}}" style="font-size:15px;"class="btn btn-dark">@lang('site.Show')</a></td>
                                    @auth
                                      @if(auth()->user()->hasPermission('articles-update') || auth()->user()->hasPermission('articles-delete'))
                                        @if(auth()->user()->id == $article->editor_id || auth()->user()->hasRole('admin') || auth()->user()->hasRole('super_admin'))
                                        <td>
                                        <form action="{{route('dashboard.articles.destroy',$article->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button style="font-size:15px;" type="submit" class="btn btn-dark">@lang('site.Delete')</button>
                                        </td>
                                        @endif
                                        @if(auth()->user()->id == $article->editor_id || auth()->user()->id == $article->writer_id || auth()->user()->hasRole('admin') || auth()->user()->hasRole('super_admin'))
                                        <td>
                                            <a style="font-size:15px;" href="{{route('dashboard.articles.edit',$article->id)}}" class="btn btn-dark">@lang('site.Edit')</a>                                
                                        </td>
                                        @endif
                                        @if($article->editor_id == null && (auth()->user()->hasRole('admin') || auth()->user()->hasRole('super_admin')))
                                        <td>
                                            <a href="{{route('dashboard.article.assignEditor',$article->id)}}">@lang('site.AssignEditor')</a>
                                        </td>
                                        @endif
                                        @endif
                                    @endauth
                                    </tr>
                                @endforeach
                            @else
                            <tr><th></th><td></td><td>@lang('site.DoesntExist')</td></tr>
                            @endif
                        </tbody>

                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</section>
<!-- ------------------------------------------------- -->


@endsection
