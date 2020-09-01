<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', 'Nama Dokumen:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- File Field -->
<div class="form-group col-sm-6">
    {!! Form::label('file', 'Dokumen:') !!}
    {!! Form::file('file', null, ['class' => 'form-control']) !!}
</div>

<!-- Category Field -->
<div class="form-group col-sm-6">
    {!! Form::label('category', 'Kategori dokumen:') !!}
    {!! Form::select('category', ['pln' => 'DPP SP PLN', 'uiksbu' => 'DPP SP UIKSBU'], 'pln', ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('dppDocuments.index') }}" class="btn btn-default">Cancel</a>
</div>
