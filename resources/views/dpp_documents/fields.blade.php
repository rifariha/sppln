<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- File Field -->
<div class="form-group col-sm-6">
    {!! Form::label('file', 'File:') !!}
    {!! Form::text('file', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Inputted By Field -->
<div class="form-group col-sm-6">
    {!! Form::label('inputted_by', 'Inputted By:') !!}
    {!! Form::text('inputted_by', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Category Field -->
<div class="form-group col-sm-6">
    {!! Form::label('category', 'Category:') !!}
    {!! Form::text('category', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('dppDocuments.index') }}" class="btn btn-default">Cancel</a>
</div>
