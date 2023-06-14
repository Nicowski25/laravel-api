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
        <th scope="col">Name</th>
        <th scope="col">Slug</th>
      </tr>
    </thead>
    <tbody>
      @forelse($types as $type)
      <tr>
        <td scope="row">{{ $type->id }}</td>
        <td scope="row">{{ $type->title }}</td>
        <td scope="row">{{ $type->slug }}</td>
        <td scope="row">
          <a class="text-decoration-none btn btn-success text-dark" href="{{ route('admin.types.show', $type->slug) }}">
            <i class="fa-regular fa-eye fa-fw"></i>
          </a>
          <a class="text-decoration-none btn btn-warning text-dark my-2" href="{{ route('admin.types.edit', $type->slug) }}">
            <i class="fa-regular fa-pen-to-square fa-fw"></i>
          </a>
          <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalId-{{ $type->id }}">
            <i class="fa fa-trash" aria-hidden="true"></i>
          </button>

          <div class="modal fade text-black" id="modalId-{{ $type->id }}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId-{{ $type->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalTitle-{{ $type->id }}">
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