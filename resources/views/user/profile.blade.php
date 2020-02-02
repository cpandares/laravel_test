@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

<div class="card">
        <div class="data-user">
            <h2>Mis datos</h2>

            @if($user->image)
            <div class="jumbotron>">
                <div class="container-avatar">
                    <img src="{{ route('user.image', ['filename'=>$user->image]) }}" class="img-fluid">     
                </div>

                <div class="info-profile">
                   
                   <span class="name">{{ $user->name.' '.$user->lastname }}</span>
                   <span class="nikc-profile">{{ '|@'.$user->nickname }}</span>
                   <span class="date-profile">Se Unió: {{\FormatTime::LongTimeFilter($user->created_at) }}</span>
              
           </div>
                
            </div>
            @endif
            <div class="clearfix"></div>
         
        </div>
</div>

       <hr>
        @foreach($user->images as $image)
             @include('includes.image',['image'=>$image])
        @endforeach 

        </div>

       
    </div>
</div>
@endsection
