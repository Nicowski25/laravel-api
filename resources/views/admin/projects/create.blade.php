@extends('layouts.admin')

@section('content')

<h1 class="py-3">Create a new project</h1>


@include('partials.validation_errors')

<form action="{{route('admin.projects.store')}}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" aria-describedby="titleHelper" placeholder="JAVASCRIPT Project">
        <small id="titleHelper" class="form-text text-muted">Type the project title max 50 characters - must be unique</small>
    </div>

    <div class="mb-3">
        <label for="type_id " class="form-label">Type</label>
        <select class="form-select @error('type_id') is-invalid @enderror" name="type_id " id="type_id ">
            <option value="">Select one</option>
            @foreach ($types as $type)
                <option value="{{$type->id}}" {{ $type->id == old('type_id', '') ? 'selected' : '' }}> {{ $type->name }} </option>
            @endforeach
        </select>
    </div>

    <div class="form-group mb-3">
        <p>Select the technologies used</p>
        @foreach ($technologies as $technology)
        <div class="form-check @error('technologies') is-invalid @enderror">

            <label class="form-check-label mb-3">
                <input name="technologies[]" type="checkbox" value="{{ $technology->id }}" class="form-check-input" {{ in_array($technology->id, old('technologies', [])) ? 'checked' : '' }}>
                {{ $technology->name }}
            </label>
        </div>
        @endforeach

        @error('technologies')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" id="description" aria-describedby="descriptionHelper" placeholder="Learn php">
        <small id="descriptionHelper" class="form-text text-muted">Type the project description max 150 characters - must be unique</small>
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image" aria-describedby="imageHelper" placeholder="Learn php">
        <small id="imageHelper" class="form-text text-muted">Insert the image file, max 150 characters - must be unique</small>
    </div>

    <div class="mb-3">
        <label for="duration" class="form-label">Expected weeks duration</label>
        <input type="text" class="form-control @error('duration') is-invalid @enderror" name="duration" id="duration" aria-describedby="durationHelper" placeholder="5 weeks">
        <small id="durationHelper" class="form-text text-muted">Type the project duration</small>
    </div>

    <div class="mb-3">
        <select class="form-select" name="status" aria-label="Default select example">
            <option selected>Project Status</option>
            <option value="1">Done</option>
            <option value="2">In Progress</option>
            <option value="3">Abandoned</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="duration" class="form-label">Start Date</label>
        <input type="date" name="start_date" class="form-control @error('duration') is-invalid @enderror" name="duration" id="duration" aria-describedby="durationHelper" placeholder="Learn php">
        <small id="durationHelper" class="form-text text-muted">Select the project start</small>
    </div>

    <div class="mb-3">
        <label for="duration" class="form-label">End Date</label>
        <input type="date" name="end_date" class="form-control @error('duration') is-invalid @enderror" name="duration" id="duration" aria-describedby="durationHelper" placeholder="Learn php">
        <small id="durationHelper" class="form-text text-muted">Select the project end</small>
    </div>

    <div class="mb-3">
        <label for="repositoryUrl" class="form-label">Repository Url</label>
        <input type="text" class="form-control @error('repositoryUrl') is-invalid @enderror" name="repositoryUrl" id="repositoryUrl" aria-describedby="repositoryUrlHelper" placeholder="Learn php">
        <small id="repositoryUrlHelper" class="form-text text-muted">Type the project repository Url, max 150 characters - must be unique</small>
    </div>

    <button type="submit" class="btn btn-dark my-3">Insert New Project</button>

</form>


@endsection