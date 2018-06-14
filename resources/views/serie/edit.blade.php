@extends('layouts.index')

@section('content')

    <div class="container">
        <div class="row ">
            <div class="col-md-4">
                <h2>Modifier la série</h2>
            </div>
        </div>
    </div>


    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Il y a quelques problèmes avec votre saisie.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {!! Form::model($serie, ['method' => 'PATCH','route' => ['series.update', $serie->id_Serie]]) !!}
        @include('serie.form')
    {!! Form::close() !!}

@endsection