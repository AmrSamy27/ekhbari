@extends('layouts.dashboard.app')
@section('content')
<style>
    img {
        background-color: gray;
        height: 250px;
        width: 300px;
        border: 1px solid grey;
        margin-top: 20px;
        box-shadow: 0 8px 6px -6px black;
    }

    .container {
        clear: both;
        font-size: 20px;
    }

</style>
<div style="border-bottom: 3px solid;margin-right:20px;margin-left:20px;border-color:#3C8DBC;font-size:25px">
    @lang('site.Articles')

</div>

<!-- -------------------------------------------------------------- -->

<div class="container">

    <!-- Default box -->
    <div class="card card-solid">
        <div class="card-body">
            <div class="row">
                @if($article !== null)
                <div class="col-12 ">

                    <h3 class="d-inline-block d-sm-none " style="float:left; margin-left:150px;"> @lang('site.name')
                        @lang('site.TheWriter'):{{$article->articleWriter->first_name}} {{$article->articleWriter->last_name}}</h3>
                    <h3 class="my-3 " style="display:inline-block;">@lang('site.ArticleTitle'): {{$article->title}}</h3>


                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <a href="{{route('article.gallery',$article->id)}}">
                        <img src="{{asset('storage/images/' . $article->images[0]->img)}}" class="product-image"
                            alt="Product Image">
                    </a>
                </div>

                <div class="col-md-6" style="float:left; text-align:right;width: 70%;margin-top: 120px;">
                    <p>@lang('site.Description') : {{$article->description}}</p>
                </div>
                <hr>
            </div>

            @endif

        </div>
        <!-- /.card-body -->

        <!-- DIRECT CHAT -->
        <div class="card direct-chat direct-chat-primary">
            <div class="card-header">
                <h3 class="card-title">Comments</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <!-- Conversations are loaded here -->
                <div class="direct-chat-messages">
                    <!-- Message. Default to the left -->
                    @if($articleComments != null)
                    @include('dashboard.articles.partials.comments', ['comments' => $articleComments, 'article_id' => $article->id])
                    @else
                    <div class="direct-chat-msg right" style="width:85%;">
                        
                        <!-- /.direct-chat-infos -->
                        <!-- /.direct-chat-img -->
                        <div class="direct-chat-text">
                            @lang('site.DoesntExist')
                        </div>
                        <!-- /.direct-chat-text -->
                    </div>
                    @endif
                    <!-- /.direct-chat-msg -->
                </div>
                <!--/.direct-chat-messages-->

                <!-- /.direct-chat-pane -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <form action="{{route('dashboard.article.comment',$article->id)}}" method="post">
                @csrf    
                <div class="input-group">
                        <input type="text" name="body" placeholder="Type Comment ..." class="form-control">
                        <span class="input-group-append">
                            <button  type="submit" class="btn btn-primary">Comment</button>
                        </span>
                    </div>
                </form>
            </div>
            <!-- /.card-footer-->
        </div>
        <!--/.direct-chat -->
    </div>
    <!-- /.card -->
</div>

<!-- ------------------------------------ -->




@endsection
