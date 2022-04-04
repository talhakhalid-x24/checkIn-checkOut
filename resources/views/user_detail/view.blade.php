@extends('../layouts/master_web')

@section('section')

<div class="col-sm-8 mt-4">
    <h3 class="text-secondary">Employees</h3>
</div>
<div class="col-sm-4 mt-4 text-end">
    <a href="{{ url('/add') }}" class="btn btn-primary">Add Employee</a>
    <a href="{{ url('/leave') }}" class="btn btn-warning text-light">Leave Detail</a>
</div>
<div class="col-sm-12 text-center m-auto">
    @if(Session::has('msg'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ Session::get('msg') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
<table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Department</th>
        <th scope="col">Shift Time</th>
        <th scope="col">Hrs</th>
        <th scope="col">Mins</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($user as $key => $value)
            <tr>
                <td class="ids">{{ $value->id }}</td>
                <td>{{ $value->name }}</td>
                <td>{{ $value->department }}</td>
                <td>{{ date('h:i A', strtotime($value->shift_time_start)) }}  -  {{ date('h:i A', strtotime($value->shift_time_end)) }}</td>
                <td class="hrs">00</td>
                <td class="mins">00</td>
                <td>
                    <button type="button" style="font-size:12px;" class="text-light p-0 btn btn-success checkIn">Check In</button>
                    <button type="button" disabled style="font-size:12px;" class="text-light p-0 btn btn-danger checkOut">Check Out</button>
                    <a href="{{ url('/show/'.$value->id) }}" style="font-size:12px;" class="text-light p-0 btn btn-secondary">Detail</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

</div>
@endsection
