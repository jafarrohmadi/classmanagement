@extends('layouts.app-user')
@section('content') 

<div class="panel panel-default filter">
    <div class="panel-heading panel-heading-divider">Filter<span class="pull-right"><a href="{{ url('/user/class/create') }}" class="btn btn-primary" style="display: unset;"><i class="fa fa-plus"></i> Create</a></span></div>
    <div class="panel-body">
        <form method="POST" id="search-form" class="form-vertical" role="form">
        {{ csrf_field() }}
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control input-xs" name="name" id="name" placeholder="search name">
            </div>
             <div class="form-group">
                <label for="room"></label>
                <input type="text" class="form-control input-xs" name="room" id="room" placeholder="search room">
            </div>
            <div class="row xs-pt-15">
                <div class="col-xs-12">
                    <p class="text-center lg-mb-0">
                        <button class="btn btn-space btn-default" type="reset"><i class="fa fa-close"></i> Clear</button>
                        <button class="btn btn-space btn-primary" type="submit"><i class="fa fa-refresh"></i> Refresh</button>
                    </p>
                </div>
            </div>
        </form>
    </div>
</div>    
<!-- /panel -->
   
<div class="clear"></div>
<div class="panel panel-default panel-table">
    <div class="panel-body">
        {!! Form::open(['method' => 'POST', 'class' => 'form-inline', 'id'=>'bulk-form', 'role'=>'form']) !!}
        <table class="table table-striped table-hover table-fw-widget" id="dt-table">
            <thead>
                <tr>
                    <th>Name</th>                            
                    <th>Room</th>
                    <th>Teacher</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
        {!! Form::close() !!}
    </div>
</div>
<!-- /panel -->

@push('scripts')
<script type="text/javascript">
    var oTable = $('#dt-table').DataTable({
        "scrollX": true,
        dom: "<'row top10'<'col-xs-12'<'col-xs-6'l><'col-xs-6'p>>r>" +
                "<'row'<'col-xs-12't>>" +
                "<'row'<'col-xs-12'<'col-xs-6'i><'col-xs-6'p>>>",
        processing: true,
        serverSide: true,
        ajax: {
            url: '{!! route("user.class.data") !!}',
            data: function (d) {
                d.name = $('input[name=name]').val();
                d.room = $('input[name=room]').val();
            }
        },
        columns: [
            {data: 'name', name: 'name', orderable: false, searchable: false},
            {data: 'room', name: 'room'},
            {data: 'teacher_id', name: 'teacher_id'},
            {data: 'date', name: 'date'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    $('#search-form').on('submit', function (e) {
        oTable.draw();
        e.preventDefault();
    });
</script>
@endpush
@endsection
