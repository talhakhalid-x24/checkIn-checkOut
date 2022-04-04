@extends('../layouts/master_web')

@section('section')

<div class="col-sm-12 mt-4">
    <h3 class="text-secondary">Employees \ Detail \ Leave</h3>
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
        <th scope="col">Allowed Leaves</th>
        <th scope="col">Not Allowed Leaves</th>
        <th scope="col">Total Leaves</th>
        <th scope="col">Remaining Leaves</th>
        <th scope="col">Valid For Year</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($leave as $key => $value)
            <tr>
                <td>{{ $value->id }}</td>
                <td>{{ $value->emp->name }}</td>
                <td>{{ $value->allow }}</td>
                <td>{{ $value->not_allow }}</td>
                <td>{{ $value->total_leaves }}</td>
                <td>{{ ($value->total_leaves - $value->allow) -$value->not_allow }}</td>
                <td>{{ date('d M Y', strtotime($value->valid_for_year)) }}</td>
                <td>
                    <a href="{{ url('/allow/'.$value->emp->id) }}" style="font-size:12px;" class="text-light p-0 btn btn-success">Allow</a>
                    <a href="{{ url('/not-allow/'.$value->emp->id) }}" style="font-size:12px;" class="text-light p-0 btn btn-danger">Not Allow</a>
                </td>

            </tr>
        @endforeach
    </tbody>
</table>

</div>
@endsection
