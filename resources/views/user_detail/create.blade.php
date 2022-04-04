@extends('../layouts/master_web')

@section('section')

<div class="col-sm-12 mt-4">
    <h3 class="text-secondary">Employees / Add</h3>
</div>
<div class="col-sm-10 m-auto">
    <form action="{{ url('store') }}" method="POST">
        @csrf
        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
            @if($errors)
                <span class="text-danger">{{ $errors->first('name') }}</span>
            @endif
        </div>
        <div class="mb-3">
          <label for="department" class="form-label">Department</label>
          <input type="text" class="form-control" id="department" name="department" value="{{ old('department') }}">
          @if($errors)
              <span class="text-danger">{{ $errors->first('department') }}</span>
          @endif
        </div>
        <div class="mb-3">
          <label for="shift_time_start" class="form-label">Shift Time Start</label>
          <input type="time" class="form-control" id="shift_time_start" name="shift_time_start" value="{{ old('shift_time_start') }}">
          @if($errors)
              <span class="text-danger">{{ $errors->first('shift_time_start') }}</span>
          @endif
        </div>
        <div class="mb-3">
          <label for="shift_time_end" class="form-label">Shift Time End</label>
          <input type="time" class="form-control" id="shift_time_end" name="shift_time_end" value="{{ old('shift_time_end') }}">
          @if($errors)
              <span class="text-danger">{{ $errors->first('shift_time_end') }}</span>
          @endif
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
