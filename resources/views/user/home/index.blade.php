@extends('layouts.app-user')
@section('content')
<!-- top tiles -->
<div class="row tile_count">
  <a class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12" href="{{ url('/user/class')}}">
    <div class="tile-stats">
      <div class="icon"><i class="fa fa-cog"></i></div>
      <div class="count green">{{ \App\Models\Classroom::count() }}</div>
      <h3>Total Class</h3>
    </div>
  </a>
  <a class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12" href="{{ url('/user/teacher')}}">
    <div class="tile-stats">
      <div class="icon"><i class="fa fa-user"></i></div>
      <div class="count green">{{ \App\Models\Teacher::count() }}</div>
      <h3>Total Teacher</h3>
    </div>
  </a>
  <a class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12" href="{{ url('/user/students')}}">
    <div class="tile-stats">
      <div class="icon"><i class="fa fa-users"></i></div>
      <div class="count green">{{ \App\Models\Students::count() }}</div>
      <h3>Total Students</h3>
    </div>
  </a>
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="panel panel-default filter">
      <div class="panel-heading panel-heading-divider">Add User and Teacher to class</div>
      <div class="panel-body">
          <form id="search-form" role="form" name='myform'>
              <div class="form-group">
                  <label for="name">Class</label>
                  <select class="form-control input-xs col-lg-12 col-md-12 col-sm-12 col-xs-12 searchclass" id="searchclass" name="class">      
                  </select>
              </div>
               
              <div class="row xs-pt-15">
                  <div class="col-xs-12">
                      <p class="text-center lg-mb-0">
                          <button class="btn btn-space btn-default" type="reset"><i class="fa fa-close"></i> Clear</button>
                          <button class="btn btn-space btn-primary" type="submit"  onclick='submitResponse();return false;' ><i class="fa fa-refresh"></i> Submit</button>
                      </p>
                  </div>
              </div>
          </form>
      </div>
    </div>  
  </div>
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    {!! Form::open(['url' => '/user/generate-pdf', 'method' =>'get']) !!}
      {!! Form::submit('Download a PDF file lists of all Classrooms', ['class' => 'btn btn-info btn-block']) !!}
    {!! Form::close() !!}
  </div>
</div>

<!-- /top tiles -->
@push('scripts')
<script type="text/javascript">
$('.searchclass').select2({
    placeholder: 'Search Class...',
    minimumInputLength : 1,
    ajax: {
      url: '{{ url('user/searchclass') }}',
      dataType: 'json',
      delay: 250,
      processResults: function (data) {
        return {
          results:  $.map(data, function (item) {
            var date = new Date(item.date).toLocaleDateString("en-US");
            return {
              text: item.name+' - '+item.nameteacher+'('+item.from_hour+' - '+ item.to_hour+') - '+ date  ,
              id: item.id
            }
          })
        };
      },
      cache: true
    }
  });

function submitResponse() {
   var select = $("#searchclass").val();
   if( select == null){
    swal("Stop!", "You Must Choose a Class Before Continuing", "error");
   }else{
     window.location.href = "user/class/"+select+"/edit";
   }
}
</script>
@endpush

@endsection