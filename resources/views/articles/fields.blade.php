<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Judul:') !!}
    {!! Form::text('title', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Contains Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('contains', 'Isi:') !!}
    {!! Form::textarea('contains', null, ['class' => 'form-control']) !!}
</div>
<!-- Image Field -->
<div class="form-group col-sm-6">
    {!! Form::label('image', 'Gambar:') !!}
    {!! Form::file('image', null, ['class' => 'form-control']) !!}
    <i class="red"> Maksimal 10 Mb </i>
    @if(!empty($article->image))
    <br>
    <img src="{{ url('storage/'.$article->image) }}" width="50%">
    @endif
</div>
<!-- Article Category Id Field -->

<div class="form-group col-sm-6">
    {!! Form::label('article_category_id', 'Kategori:') !!}
    {!! Form::select('article_category_id', $category , null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('status', 0) !!}
        {!! Form::checkbox('status', '1', null) !!}
    </label>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('articles.index') }}" class="btn btn-default">Cancel</a>
</div>
