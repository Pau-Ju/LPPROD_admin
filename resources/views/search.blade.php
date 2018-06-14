{!! Form::open(['method'=>'GET','url'=>'search','class'=>'navbar navbar-form','role'=>'search'])  !!}
<div class="input-group">
    <input type="text" class="form-control" placeholder="Recherche" name="s">
    <div class="input-group-btn">
        <button class="btn btn-default" type="submit">
            <i class="fa fa-search" style="color:cornflowerblue;"></i>
        </button>
    </div>
</div>
{!! Form::close() !!}

