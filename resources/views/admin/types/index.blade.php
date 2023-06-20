@extends('layouts.admin')

@section('content')


@if(session("message"))
<div class="alert alert-success my-3" role="alert">
  <strong>{{ session("message") }}</strong>
</div>
@endif

<a class="btn btn-primary my-3" href="{{ route('admin.types.create') }}" role="button">New Type</a>

<div class="table-responsive rounded overflow-hidden">
  <table class="table table-primary table-striped align-middle text-center mb-0">
    <thead>
      <tr class="align-middle">
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($types as $type)
      <tr>
        <td scope="row">{{ $type->id }}</td>
        <td scope="row">{{ $type->name }}</td>
        <td scope="row">

          <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalId-{{ $type->id }}">
            <i class="fa fa-trash" aria-hidden="true"></i>
          </button>

          <div class="modal fade text-black" id="modalId-{{ $type->id }}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId-{{ $type->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalTitle-{{ $type->id }}">
                    Delete
                    {{ $type->name }}
                  </h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Remove {{ $type->title }}?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Close</button>
                  <form action="{{ route('admin.types.destroy',$type) }}" method="post">
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
        <td scope="row">No types found</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection