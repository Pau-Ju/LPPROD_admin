@extends('layouts.index')

@section('content')

    <div class="container">
        @if(isset($series)&& count($series))
            <h1> Séries les mieux notées <i class="fa fa-star-o"></i>:</h1>
            <div class="row">
                @foreach($series as $serie)
                    <div class="col-xs-3 mosaique">
                        <a href="{{ route('series.show',$serie->id_Serie) }}" class="thumbnail">
                            <img src="{!! $serie->image_link !!}" alt="{!! ucfirst(strtolower($serie->name)) !!}"
                                 class="img-responsive image"/>
                            <div class="overlay">
                                <div class="text">{!! ucfirst(strtolower($serie->name)) !!}</div>
                            </div>
                        </a>
                        <div class="moyenne">
                            @switch($serie->moyenne)
                                @case(0)
                                <img src="images\notation\0.png">
                                @break
                                @case(0.5)
                                <img src="images\notation\05.png">
                                @break
                                @case(1)
                                <img src="images\notation\1.png">
                                @break
                                @case(1.5)
                                <img src="images\notation\15.png">
                                @break
                                @case(2)
                                <img src="images\notation\2.png">
                                @break
                                @case(2.5)
                                <img src="images\notation\25.png">
                                @break
                                @case(3)
                                <img src="images\notation\3.png">
                                @break
                                @case(3.5)
                                <img src="images\notation\35.png">
                                @break
                                @case(4)
                                <img src="images\notation\4.png">
                                @break
                                @case(4.5)
                                <img src="images\notation\45.png">
                                @break
                                @case(5)
                                <img src="images\notation\5.png">
                                @break
                            @endswitch
                        </div>
                        <div class="action">
                            <a class="btn btn-primary" href="{{ route('series.edit',$serie->id_Serie) }}">Modifier</a>

                            {!! Form::open(['method' => 'DELETE','route' => ['series.destroy', $serie->id_Serie],'style'=>'display:inline']) !!}

                            {!! Form::submit('Supprimer', ['class' => 'btn btn-danger']) !!}

                            {!! Form::close() !!}
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $series->links()}}
        @endif

    </div>
@endsection

@section('script')
    @auth
        <script src="{{ asset('js/notation.js') }}"></script>
        <script src="{{ asset('js/favoris.js') }}"></script>
    @endauth
@endsection