<div class="form-group">
  {!! Form::label('users_id', 'Usuario:', array('class' => 'col-sm-2 control-label', 'for' => 'users_id')) !!}
  <div class = "col-sm-10">
    {!! Form::select('users_id', $users, !empty($apuesta) ? $apuesta->users_id : '', ['class' => 'form-control']) !!}
  </div>
</div>
<div class="form-group">
  {!! Form::label('total', 'Total:', array('class' => 'col-sm-2 control-label', 'for' => 'total')) !!}
  <div class = "col-sm-10">{!! Form::text('total') !!}</div>
</div>
<div class="form-group">
  {!! Form::label('redondeo', 'Redondeo:', array('class' => 'col-sm-2 control-label', 'for' => 'redondeo')) !!}
  <div class = "col-sm-10">{!! Form::text('redondeo') !!}</div>
</div>
<div class="form-group">
    <div class = "col-sm-10 col-sm-offset-2">
      {!! Form::submit($submit_text, ['class'=>'btn btn-primary']) !!}
    </div>
</div>
