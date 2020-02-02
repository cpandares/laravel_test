@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                @if(session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
            <div class="card">
                <div class="card-header">Editar</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('image.update') }}" enctype="multipart/form-data">
                        @csrf
                      
                              
                        <div class="form-group row">

                            <input type="hidden" name="image_id" value="{{ $image->id }}">         

                            <label for="image_path" class="col-md-4 col-form-label text-md-right">Imagen</label>
                            @if($image->user->image)
                                <div class="container-avatar">
                                    <img src="{{ route('user.image', ['filename'=>$image->user->image]) }}" class="avatar-user">     
                                </div>
                            @endif 
                            <div class="col-md-6">
                           
                                <input id="image_path" type="file" class="form-control @error('image_path') is-invalid @enderror" name="image_path" autocomplete="image_path" autofocus>
                               
                                
                                @error('image_path')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Descripción') }}</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" value="{{ $image->description }}" name="description" required autocomplete="description">

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Guardar Cambios
                                </button>
                            </div>
                        </div>
                    </form>
               
        </div>
    </div>
</div>





@endsection