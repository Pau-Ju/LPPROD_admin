<div class="container">
<div class="row form-group">
    <div class="col-xs-4 col-sm-4 col-md-4">
        {{ Form::label('name', "Titre :", ['class' => 'control-label']) }}
            {!! Form::text('name', null, array('placeholder' => 'Titre','class' => 'form-control')) !!}

    </div>

    <div class="col-xs-4 col-sm-4 col-md-4">
            {{ Form::label('author', "Auteur :", ['class' => 'control-label']) }}
            {!! Form::text('author', null, array('placeholder' => 'Auteur','class' => 'form-control')) !!}
    </div>

    <div class="col-xs-4 col-sm-4 col-md-4 ">
        {{ Form::label('release_date', "Date de sortie :", ['class' => 'control-label']) }}
        {{Form::number('release_date')}}
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        {{ Form::label('synopsis', "Synopsis : ", ['class' => 'control-label']) }}
        {!! Form::textarea('synopsis', null, array('placeholder' => 'Synopsis','class' => 'form-control','style'=>'height:150px')) !!}
    </div>
</div>


<div class="row form-group">
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            {{ Form::label('subtitles', "Sous-titres : ", ['class' => 'control-label']) }}
            {!! Form::file('subtitles', null, array('class' => 'form-control','style'=>'height:150px')) !!}
        </div>
    </div>

    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            {{ Form::label('image', "Affiche : ", ['class' => 'control-label']) }}
            {!! Form::file('image', null, array('class' => 'form-control','style'=>'height:150px')) !!}
        </div>
    </div>
</div>


    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </div>

</div>
</div>