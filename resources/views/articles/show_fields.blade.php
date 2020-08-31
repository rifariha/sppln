<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    <p>{{ $article->title }}</p>
</div>

<!-- Contains Field -->
<div class="form-group">
    {!! Form::label('contains', 'Contains:') !!}
    <p>{{ $article->contains }}</p>
</div>

<!-- Image Field -->
<div class="form-group">
    {!! Form::label('image', 'Image:') !!}
    <p>{{ $article->image }}</p>
</div>

<!-- Photo Field -->
<div class="form-group">
    {!! Form::label('photo', 'Photo:') !!}
    <p>{{ $article->photo }}</p>
</div>

<!-- Article Category Id Field -->
<div class="form-group">
    {!! Form::label('article_category_id', 'Article Category Id:') !!}
    <p>{{ $article->article_category_id }}</p>
</div>

<!-- Created By Field -->
<div class="form-group">
    {!! Form::label('created_by', 'Created By:') !!}
    <p>{{ $article->created_by }}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $article->status }}</p>
</div>

