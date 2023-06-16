@extends('layouts.admin')

@section('content')

<div class="container my-4">
    <div class="card">
        <div class="card-header">
            <h2>{{ $project->title }}</h2>
            <div>
                <span class="badge bg-primary">{{ $project->type?->name }}</span>
            </div>
        </div>
        <div class="d-flex">
            <div>
                <img class="" height="400px" src="{{ $project->image }}" alt="">
            </div>
            <div class="card-body">
                <p><strong>Description:</strong> {{$project->description }}</p>
                <p><strong>Duration:</strong>{{$project->duration }}</p>
                <p><strong>Status:</strong> {{$project->status }}</p>
                <p><strong>Start Date:</strong> {{$project->start_date }}</p>
                <p><strong>End Date:</strong> {{$project->end_date }}</p>
                <p><strong>Repository Url:</strong> {{$project->repositoryUrl }}</p>
            </div>
        </div>
    </div>

</div>

@endsection