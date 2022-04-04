@extends('../layouts/master_web')

@section('section')

<div class="col-sm-12 mt-4">
    <h3 class="text-secondary">Employee \ Detail</h3>
</div>
<div class="col-sm-12 text-center m-auto">

<table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Total Time</th>
        <th scope="col">OverTime</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($emp as $key => $value)
            <tr>
                <td class="ids">{{ $key + 1 }}</td>
                <td>{{ $value->emp->name }}</td>
                <td>{{ ($value->total_hrs < 10 && $value->total_hrs > 0) ? '0'.$value->total_hrs : $value->total_hrs }}:{{ ($value->total_mints < 10 && $value->total_mints > 0) ? '0'.$value->total_mints : $value->total_mints }}</td>
                <td>{{ date('H:i', strtotime($value->over_time)) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

</div>
@endsection
