@extends('layouts.app-user')
@section('content')
<div class="panel panel-default filter">
    <div class="panel-heading panel-heading-divider">Filter<span class="pull-right"><a href="{{ url('/user/students/create') }}" class="btn btn-primary" style="display: unset;"><i class="fa fa-plus"></i> Create</a></span></div>
    <div class="panel-body">
        <form method="POST" id="search-form" class="form-vertical" role="form">
        {{ csrf_field() }}
            <div class="form-group">
                <label for="student_nis">Student Nis</label>
                <input type="text" class="form-control input-xs" name="student_nis" id="student_nis" placeholder="search student nis">
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control input-xs" name="name" id="name" placeholder="search name">
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
                    <th>Students Nis</th>
                    <th>Name</th>                            
                    <th>Gender</th>
                    <th>Phone</th>
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
            url: '{!! route("user.students.data") !!}',
            data: function (d) {
                d.student_nis = $('input[name=student_nis]').val();
                d.name = $('input[name=name]').val();
            }
        },
        columns: [
            {data: 'student_nis', name: 'student_nis', orderable: false, searchable: false},
            {data: 'name', name: 'name'},
            {data: 'gender', name: 'gender'},
            {data: 'phone', name: 'phone'},
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
