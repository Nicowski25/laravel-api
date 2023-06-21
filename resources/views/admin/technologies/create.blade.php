@extends('layouts.admin')

@section("content")
<div class="container">

    <form class="m-3" action="{{route('admin.technologies.store')}}" method="post">
        @csrf
        <div class="mb-3 row">
            <label for="name" class="col-3 col-form-label">Name:</label>
            <div class="col-6">
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" required placeholder="Name of the new technology.">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Insert New Type</button>
</div>
</form>
</div>
@endsection