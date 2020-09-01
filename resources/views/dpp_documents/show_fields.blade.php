<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $dppDocument->name }}</p>
</div>

<!-- File Field -->
<div class="form-group">
    {!! Form::label('file', 'File:') !!}
    <p>{{ $dppDocument->file }}</p>
</div>

<!-- Inputted By Field -->
<div class="form-group">
    {!! Form::label('inputted_by', 'Inputted By:') !!}
    <p>{{ $dppDocument->inputted_by }}</p>
</div>

<!-- Category Field -->
<div class="form-group">
    {!! Form::label('category', 'Category:') !!}
    <p>{{ $dppDocument->category }}</p>
</div>

