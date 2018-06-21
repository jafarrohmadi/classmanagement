<div class="row">
  <div class="col-xs-12 col-md-12">
      <div class="form-group{{ $errors->has('name') ? ' has-error' : ''}}">
          {!! Form::label('name', 'Name') !!}
          {!! Form::text('name', null, ['class' => 'form-control input-sm', 'placeholder' => 'Enter Name']) !!}
          {!! $errors->first('name', '<p class="invalid-block">:message</p>') !!}
      </div>
      <div class="form-group{{ $errors->has('teacher') ? ' has-error' : ''}}">
          {!! Form::label('teacher_id', 'Teacher') !!}
          <select class="form-control input-sm searchteacher" id="teacher_id" name="teacher_id">
            @if(isset($class->teacher_id))
              <option selected="selected" value="{{$class->teacher_id}}">{{ $class->teacher->teacher_nip.' - '.$class->teacher->name }}</option>
            @endif
          </select>
          {!! $errors->first('teacher_id', '<p class="invalid-block">:message</p>') !!}
      </div>
      <div class="form-group{{ $errors->has('room') ? ' has-error' : ''}}">
          {!! Form::label('room', 'Room') !!}
          {!! Form::text('room', null, ['class' => 'form-control input-sm', 'placeholder' => 'Enter Room']) !!}
          {!! $errors->first('room', '<p class="invalid-block">:message</p>') !!}
      </div>
      <div class="form-group{{ $errors->has('date') ? ' has-error' : ''}}">
          {!! Form::label('date', 'Date Class') !!}
          {!! Form::text('date', isset($class->date) ? date('m/d/Y', strtotime($class->date)) : null, ['class' => 'form-control input-sm', 'placeholder' => 'Enter Date Class','id' => 'datemin']) !!}
          {!! $errors->first('date', '<p class="invalid-block">:message</p>') !!}
      </div>
      <div class="row">
          <div class="col-md-6">
              <div class="form-group {{ $errors->has('from_hour') ? 'has-error' : ''}}">
                  {!! Form::label('from_hour', 'From hour', ['class' => 'required']) !!}
                  {{ Form::select('from_hour',  config('const.time'), null, ['class' => 'form-control input-sm']) }}
                  {!! $errors->first('from_hour', '<p class="invalid-block">:message</p>') !!}
              </div>
          </div>
          <div class="col-md-6">
              <div class="form-group {{ $errors->has('to_hour') ? 'has-error' : ''}}">
                  {!! Form::label('to_hour', 'To hour', ['class' => 'required']) !!}
                  {{ Form::select('to_hour',  config('const.time'), null, ['class' => 'form-control input-sm']) }}
                  {!! $errors->first('to_hour', '<p class="invalid-block">:message</p>') !!}
              </div>
          </div>
      </div>
      <div class="form-group{{ $errors->has('students') ? ' has-error' : ''}}">
          {!! Form::label('students', 'Students') !!}
          <select class="form-control input-sm searchstudents" multiple="multiple" id="students" name="students[]">
              @if(isset($class->students))
                  @foreach($class->students as $students)
                      <option selected="selected" value="{{$students->id}}">{{ $students->student_nis.' - '.$students->name }}</option>
                  @endforeach
              @endif
          </select>
          {!! $errors->first('students', '<p class="invalid-block">:message</p>') !!}
      </div>
  </div>
</div>


<div class="row xs-pt-15">
    <div class="col-xs-6">
        <p class="text-right">
            {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-space btn-primary']) !!}
            {!! Form::reset('Reset', ['class' => 'btn btn-space btn-default']) !!}
        </p>
    </div>
</div>

@push('scripts')
<script type="text/javascript">
$('.searchteacher').select2({
    placeholder: 'Search Teacher...',
    minimumInputLength : 1,
    ajax: {
      url: '{{ url('user/searchteacher') }}',
      dataType: 'json',
      delay: 250,
      processResults: function (data) {
        return {
          results:  $.map(data, function (item) {
            return {
              text: item.teacher_nip+' - '+item.name,
              id: item.id
            }
          })
        };
      },
      cache: true
    }
  });

$('.searchstudents').select2({
    placeholder: 'Search Students...',
    minimumInputLength : 1,
    tags: true,
    ajax: {
      url: '{{ url('user/searchstudent') }}',
      dataType: 'json',
      delay: 250,
      processResults: function (data) {
        return {
          results:  $.map(data, function (item) {
            return {
              text: item.student_nis+' - '+item.name,
              id: item.id
            }
          })
        };
      },
      cache: true
    }
  });

</script>
@endpush