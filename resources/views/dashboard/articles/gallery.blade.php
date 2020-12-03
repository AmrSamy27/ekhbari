@extends('layouts.dashboard.app')
@section('content')
<!-- style -->
    <style>
        img{
            background-color: gray;
            height: 250px;
            width: 100%;
            border: 1px solid grey;
            margin-top: 20px;
            box-shadow: 0 8px 6px -6px black;
        }
    </style>
<!-- end style -->
<div class="container">
    <div class="row">
        @if(!$images->isEmpty())
        @foreach($images as $image)
        <a href="{{route('articles.show',$image->article_id)}}">
       <div class="col-md-5">
           <img src="{{asset('storage/images') . '/' .  $image->img}}" alt="">
       </div></a>
        @endforeach
        @endif
    </div>
</div>
<!-- scripts  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/lazyload/2.0.3/lazyload-min.js" integrity="sha512-AsI20ZcrzATYNk6jHw9XywNXt2fqEX03x4hArLWhRuHTYdXFpPUhEuRgt32Akfbj5O4FR5xUxoH9gFWujpzo0w==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lazyload/2.0.3/lazyload.js" integrity="sha512-SEgqRMLBZ/VpPAwRyBHfbrfeSFJ0JfDlN8T958reo95++JEfZrI4dv8aBIBTS7js2LNgwV8IHLJhrBaxr7d6cw==" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        $('img').lazyload();
    });
</script>
<!-- end scripts -->
@endsection
