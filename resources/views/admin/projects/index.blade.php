@extends('layouts.admin')

@section('content')
<a class="btn btn-primary my-3" href="{{ route('admin.projects.create') }}" role="button">New Project</a>

@if(session("message"))
<div class="alert alert-success" role="alert">
  <strong>{{ session("message") }}</strong>
</div>
@endif

<div class="table-responsive rounded overflow-hidden mb-3">
  <table class="table table-primary table-striped align-middle text-center mb-0">
    <thead>
      <tr class="align-middle">
        <th scope="col">ID</th>
        <th scope="col">Title</th>
        <th scope="col">Type</th>
        <th scope="col">Description</th>
        <th scope="col">Week Duration</th>
        <th scope="col">Status</th>
        <th scope="col">Starting Date</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($projects as $project)
      <tr>
        <td scope="row">{{ $project->id }}</td>
        <td scope="row">{{ $project->title }}</td>
        <td scope="row">{{ $project->type?->name }}</td>
        <td scope="row">{{ $project->description }}</td>
        <td scope="row">{{ $project->duration }}</td>
        <td scope="row">{{ $project->status }}</td>
        <td scope="row">{{ $project->start_date }}</td>
        <td scope="row">
          <a class="text-decoration-none btn btn-success text-dark" href="{{ route('admin.projects.show', $project->slug) }}">
            <i class="fa-regular fa-eye fa-fw"></i>
          </a>
          <a class="text-decoration-none btn btn-warning text-dark my-2" href="{{ route('admin.projects.edit', $project->slug) }}">
            <i class="fa-regular fa-pen-to-square fa-fw"></i>
          </a>
          <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalId-{{ $project->id }}">
            <i class="fa fa-trash" aria-hidden="true"></i>
          </button>

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
          
        </td>
      </tr>
      @empty
      <tr>
        <td scope="row">No projects found</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection