@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
        @include('includes.message')

       

            <div class="card pub_image">
                
                <div class="card-header">
                    @if($image->user->image)
                    <div class="container-avatar">
                        <img src="{{ route('user.image', ['filename'=>$image->user->image]) }}" class="avatar-user">     
                    </div>
                    @endif

                    <div class="data-user">
                        <a href="#">
                            {{ $image->user->name.' | @'.$image->user->nickname }}
                        </a>

                    </div>
                </div>

                <div class="card-body">
                  <div class="image-container">
                    <img src="{{ route('home.image', ['filename'=>$image->image_path]) }}" class="img-fluid"> 
                   </div>  
                </div>

               

                <div class="card-footer">

               
                <div class="likes">
                        <span class="number-likes">
                            {{ count($image->likes) }} 
                        </span>
                         <?php $user_like = false;?>
                         @foreach($image->likes as $like)
                         
                            @if($like->user_id == Auth::user()->id)
                                <?php $user_like = true;?>
                            @endif

                         @endforeach

                         @if( $user_like )  
                        <img src="{{ asset('/img/heart-red.jpg') }}" data-id="{{$image->id}}" class="btn-dislike">
                        @else
                        <img src="{{ asset('/img/heart-black.jpg') }}" data-id="{{$image->id}}" class="btn-like">
                        @endif
                            <a href="#" class="btn btn-warning btn-sm btn-comment">
                                Comentar ({{count($image->comments)}})
                            </a>
                    </div>
                    <hr>
                  
                    <form method="POST" action="{{ route('content.store') }}" >
                        @csrf

                      
                        <input type="hidden" name="image_id" value="{{$image->id}}">
                                                 

                            <div class="col-md-6">
                           <p>
                           
                                <textarea name="content" class="form-control" require></textarea>
                            </p>

                                @error('content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                       
                    
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Comentar
                                </button>
                            </div>
                      
                    </form>

                    @if(Auth::user() && Auth::user()->id == $image->user->id)
                        <div class="action">
                            <a href="{{ route('image.delete', ['id'=>$image->id]) }}" class="btn btn-danger">Borrar</a>
                            <a href="{{ route('image.edit', ['id'=>$image_path->id]) }}" class="btn btn-info">Editar</a>
                        </div>
                    @endif
                    @foreach($image->comments as $comment)
                    <hr>
                        <div class="comment">
                          
                            <span class="data-user">{{ $comment->user->nickname }}</span>  
                            <span class="data-user date">{{'|'.\FormatTime::LongTimeFilter($comment->created_at) }}</span><br>
                            <p>{{$comment->content}}</p>

                            @if(\Auth::user() && $comment->user_id ==\Auth::user()->id || $comment->image->user_id ==\Auth::user()->id)
                             <a href="{{ route('comment.delete', ['id'=>$comment->id]) }}" class="btn btn-danger btn-sm">Borrar</a>
                            @endif 
                        </div>
                    @endforeach

                </div>
              
            </div>
      
        </div>

    </div>
</div>
@endsection
