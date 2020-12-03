                @foreach($comments as $comment)
                    @if($comment->parent_id == null)
                    <div class="direct-chat-msg right" style="width:85%; margin-top:30px;">
                        <div class="direct-chat-infos clearfix" x>
                            <span class="direct-chat-name float-right">{{$comment->user->first_name}}</span>
                            <span class="direct-chat-timestamp " style="float:left !important;">{{$comment->created_at}}</span>
                        </div>
                        <!-- /.direct-chat-infos -->
                        <img class="direct-chat-img" src="{{asset($comment->user->profile_photo_path)}}" alt="message user image">
                        <!-- /.direct-chat-img -->
                        <div class="direct-chat-text">
                            {{$comment->body}}
                        </div>
                        
                        <!-- /.direct-chat-text -->
                    </div>
                        @if(count($comment->replies) > 0)
                            @foreach($comment->replies as $chiled_comment)
                        <div class="direct-chat-msg right" style="width:85%;  margin-right:70px;">
                        <div class="direct-chat-infos clearfix" x>
                            <span class="direct-chat-name float-right">{{$chiled_comment->user->first_name}}</span>
                            <span class="direct-chat-timestamp " style="float:left !important;">{{$chiled_comment->created_at}}</span>
                        </div>
                        <!-- /.direct-chat-infos -->
                        <img class="direct-chat-img" src="{{asset($comment->user->profile_photo_path)}}" alt="message user image">
                        <!-- /.direct-chat-img -->
                        <div class="direct-chat-text">
                            {{$chiled_comment->body}}
                        </div>
                        <!-- /.direct-chat-text -->
                    </div>
                            @endforeach

                        @endif
                        <form method="post" action="{{route('dashboard.article.comment.replays',$comment->id)}}">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="body" class="form-control" />
                                <input type="hidden" name="article_id" value="{{ $article_id }}" />
                                <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-sm btn-outline-danger py-0" style="font-size: 0.8em;" value="Reply" />
                            </div>
                        </form> 
                    @endif
                    
                @endforeach
                {{$comments->links()}}