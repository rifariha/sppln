<!-- Category Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('category_name', 'Nama Kategori:') !!}
    {!! Form::text('category_name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('articleCategories.index') }}" class="btn btn-default">Cancel</a>
</div>
