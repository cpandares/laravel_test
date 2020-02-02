@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <h1>Usuarios de Plataforma</h1>
       
            <form action="{{route('user.index')}}" method="get" id="buscador">
                <div class="row">
                    <div class="form-group col">
                        <input type="text" name="search" id="search" class="form-control" placeholder="Buscar usuarios">
                    </div>  
                    <div class="form-group col">
                        <input type="submit" value="Buscar" class="btn btn-info btn-sm">
                    </div>
                </div>    
            </form>
         
        @foreach($users as $user)

        <div class="card">
      
            <div class="data-user">
              

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
                <a href="{{ route('user.profile', ['id'=>$user->id]) }}" class="btn btn-success btn-sm">Ver Perfil</a>
                @endif
                <div class="clearfix"></div>
            
            </div>
        </div>

        @endforeach
        <!--PAGINACION-->
        {{ $users->links() }}
         <div class="clearfix"></div>
      
        </div>

       
    </div>
</div>
@endsection
