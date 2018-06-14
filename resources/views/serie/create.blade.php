@extends('layouts.index')
@section('content')



            <div class="container">
                <div class="row ">
                    <div class="col-md-4">
                        <h2>Ajouter une série</h2>
                    </div>
                </div>
            </div>


    @if (count($errors) < 0)

        <div class="alert alert-danger">

            <strong>Whoops!</strong> Il y a quelques problèmes avec votre saisie.<br><br>

            <ul>

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    {!! Form::open(array('route' => 'series.store','method'=>'POST', 'files'=>'true')) !!}

    @include('serie.form')

    {!! Form::close() !!}


@endsection
