<!-- Category Name Field -->
<div class="form-group">
    {!! Form::label('category_name', 'Category Name:') !!}
    <p>{{ $articleCategory->category_name }}</p>
</div>

<!-- Slug Field -->
<div class="form-group">
    {!! Form::label('slug', 'Slug:') !!}
    <p>{{ $articleCategory->slug }}</p>
</div>

