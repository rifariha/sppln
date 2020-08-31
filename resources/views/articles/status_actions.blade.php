{!! Form::open(['route' => ['articles.publish', $id], 'method' => 'post']) !!}
<div class='btn-group'>
    {!! Form::button($query, [
        'type' => 'submit',
        'class' => 'btn btn-primary btn-sm',
        'onclick' => "return confirm('Anda yakin mengubah status artikel ini?')"
    ]) !!}
</div>
{!! Form::close() !!}
