<div class="card pub_image">
                
                <div class="card-header">
                    @if($image->user->image)
                    <div class="container-avatar">
                        <img src="{{ route('user.image', ['filename'=>$image->user->image]) }}" class="avatar-user">     
                    </div>
                    @endif

                    <div class="data-user">
                        <a href="{{ route('user.profile',['id'=>$image->user->id]) }}">
                            {{ $image->user->name.' '.$image->user->lastname }}
                            <span>{{ '|@'.$image->user->nickname }}</span>
                        </a>

                    </div>
                </div>

                <div class="card-body">
                  <div class="image-container">
                    <a href="{{ route('image.detail', ['id'=>$image->id]) }}">
                         <img src="{{ route('home.image', ['filename'=>$image->image_path]) }}" class="img-fluid"> 
                    </a>
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
                            <img src="{{ asset('img/heart-red.jpg') }}" data-id="{{$image->id}}" class="btn-dislike">
                        @else
                            <img src="{{ asset('img/heart-black.jpg') }}" data-id="{{$image->id}}" class="btn-like">
                        @endif
                            <a href="{{ route('image.detail', ['id'=>$image->id]) }}" class="btn btn-warning btn-sm btn-comment">
                                Comentar ({{count($image->comments)}})
                            </a>
                    </div>
                        <hr>
                    <div class="description">
                        {{$image->description}}
                    </div>  
                    <span> {{\FormatTime::LongTimeFilter($image->created_at) }}</span>
                </div>

                
               
            </div>