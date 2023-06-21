@extends('layouts.admin')

@section('content')

@if(session("message"))
<div class="alert alert-success my-3" role="alert">
    <strong>{{ session("message") }}</strong>
</div>
@endif

<a class="btn btn-primary my-3" href="{{ route('admin.technologies.create') }}" role="button">New Technology</a>

<div class="table-responsive rounded overflow-hidden mb-3">
  <table class="table table-primary table-striped align-middle text-center mb-0">
    <thead>
      <tr class="align-middle">
        <th scope="col">Name</th>
        <th scope="col">Projects</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($technologies as $technology)
      <tr>
        <td scope="row">{{ $technology->name }}</td>
        <th scope="row">{{count($technology->projects)}}</th>
        <td scope="row">
          <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalId-{{ $technology->id }}">
            <i class="fa-trash fa"></i>
          </button>
        </td>
        <div class="modal fade text-black" id="modalId-{{ $technology->id }}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId-{{ $technology->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalTitle-{{ $technology->id }}">
                    Delete
                    {{ $technology->name }}
                  </h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Remove {{ $technology->name }}?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Close</button>
                  <form action="{{ route('admin.technologies.destroy',$technology) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger rounded-pill">Confirm</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
      </tr>
      @include("partials.validation_errors")
      @empty
      <tr>
        <td class="text_custom_green" scope="row">No technologies found</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection