@extends('layouts.admin')
@section('content')

<h1 class="py-3">Edit the project</h1>


@include('partials.validation_errors')

<form action="{{route('admin.projects.update', $project)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" name="title" id="title" aria-describedby="titleHelper" placeholder="JAVASCRIPT Project" value="{{ old('title', $project->title) }}">
        <small id="titleHelper" class="form-text text-muted">Type the project title max 50 characters - must be unique</small>
    </div>

    <div class="mb-3">
        <label for="type_id " class="form-label">Type</label>
        <select class="form-select @error('type_id') is-invalid @enderror" name="type_id" id="type_id">
            <option value="">Select the project type</option>
            @foreach ($types as $type)
            <option value="{{$type->id}}" {{ $project->type?->id == $type->id || $type->id == old('type_id') ? 'selected' : '' }}> {{ $type->name }} </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <p>Select the technologies used:</p>
        @foreach ($technologies as $technology)
        <div class="form-check @error('technologies') is-invalid @enderror">
            <label class="form-check-label">
                @if($errors->any())
                {{-- se ci sono degli errori di validazione
                signifca che bisogna recuperare i technology selezionati
                tramite la funzione old(),
                la quale restituisce un array plain contenente solo gli id --}}

                <input name="technologies[]" type="checkbox" value="{{ $technology->id }}" class="form-check-input" {{ in_array($technology->id, old('technologies', [])) ? 'checked' : '' }}>

                @else
                {{-- se non sono presenti errori di validazione
				significa che la pagina è appena stata aperta per la prima volta,
				perciò bisogna recuperare i technology dalla relazione con il post,
				che è una collection di oggetti di tipo technology	--}}

                <input name="technologies[]" type="checkbox" value="{{ $technology->id }}" class="form-check-input" {{ $project->technologies->contains($technology) ? 'checked' : '' }}>
                @endif


                {{ $technology->name }}
            </label>

        </div>
        @endforeach
        @error('technologies')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>


    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image" aria-describedby="imageHelper" placeholder="Learn php">
        <small id="imageHelper" class="form-text text-muted">Insert the image file, max 150 characters - must be unique</small>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <input type="text" class="form-control" name="description" id="description" value="{{ old('description', $project->description) }}" aria-describedby="descriptionHelper" placeholder="Learn php">
        <small id="descriptionHelper" class="form-text text-muted">Type the project description max 150 characters - must be unique</small>
    </div>

    <div class="mb-3">
        <label for="duration" class="form-label">Expected Weeks Duration</label>
        <input type="text" class="form-control" name="duration" id="duration" value="{{ old('duration', $project->duration) }}" aria-describedby="durationHelper" placeholder="Learn php">
        <small id="durationHelper" class="form-text text-muted">Type the project duration</small>
    </div>

    <div class="mb-3">
        <label for="duration" class="form-label">Project Status</label>
        <select class="form-select" name="status" value="{{ old('status', $project->status) }}" aria-label="Default select example">
            <option>Open this select menu</option>
            <option value="Done">Done</option>
            <option value="In Progress">In Progress</option>
            <option value="Abandoned">Abandoned</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="duration" class="form-label">Start Date</label>
        <input type="date" name="start_date" class="form-control" name="start_date" value="{{ old('start_date', $project->start_date) }}" id="duration" aria-describedby="durationHelper" placeholder="Learn php">
        <small id="durationHelper" class="form-text text-muted">Select the project start</small>
    </div>

    <div class="mb-3">
        <label for="duration" class="form-label">End Date</label>
        <input type="date" name="end_date" class="form-control" name="end_date" id="end_date" aria-describedby="durationHelper" placeholder="Learn php">
        <small id="durationHelper" class="form-text text-muted">Select the project end</small>
    </div>

    <div class="mb-3">
        <label for="repositoryUrl" class="form-label">Url of the Repository</label>
        <input type="text" class="form-control" name="repositoryUrl" id="repositoryUrl" value="{{ old('repositoryUrl', $project->repositoryUrl) }}" aria-describedby="repositoryUrlHelper" placeholder="Learn php">
        <small id="repositoryUrlHelper" class="form-text text-muted">Type the project repository Url max 150 characters - must be unique</small>
    </div>

    <button type="submit" class="btn btn-dark mb-4">Edit Project</button>

</form>


@endsection