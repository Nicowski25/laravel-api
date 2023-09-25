@extends('layouts.admin')

@section('content')

<div class="container my-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div>
                <h1 >{{ $project->title }}</h1>
            </div>

            <!-- BUTTONS -->
            <div>
                <a class="text-decoration-none btn btn-warning text-dark my-2" href="{{ route('admin.projects.edit', $project->slug) }}">
                    <i class="fa-regular fa-pen-to-square fa-fw"></i>
                </a>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalId-{{ $project->id }}">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                </button>

                <!-- DELETE modal -->
                <div class="modal fade text-black" id="modalId-{{ $project->id }}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId-{{ $project->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalTitle-{{ $project->id }}">
                                    Delete
                                    {{ $project->title }}
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Remove {{ $project->title }}?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Close</button>
                                <form action="{{ route('admin.projects.destroy', $project->slug) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger rounded-pill">Confirm</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /delete modal -->
            </div>
            <!-- /end BUTTONS -->
        </div>
        <!-- /end header -->

        <!-- card main -->
        <div class="d-flex">
            <div>
                <img class="" height="200px" src="{{ url('storage/' . $project->image) }}">
            </div>
            <div class="card-body">
                <div class="d-flex my-2">
                    <strong class="me-2 mb-0">Project type: </strong>
                    <span class="badge bg-primary">{{ $project->type?->name }}</span>
                </div>
                <p><strong>Description: </strong> {{$project->description }}</p>
                <p><strong>Duration: </strong>{{$project->duration }}</p>
                <p><strong>Status: </strong> {{$project->status }}</p>
                <p><strong>Start Date: </strong> {{$project->start_date }}</p>
                <p><strong>End Date: </strong> {{$project->end_date }}</p>
                <p><strong>Repository Url: </strong> {{$project->repositoryUrl }}</p>
                @if(count($project->technologies) > 0)
                <p><strong>Technologies used: </strong>
                <ul>
                    @foreach($project->technologies as $technology)
                    <li>{{$technology->name}}</li>
                    @endforeach
                </ul>
                </p>
                @endif
            </div>
        </div>
    </div>

</div>

@endsection