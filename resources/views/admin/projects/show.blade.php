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
        <div class="card-body">
            <p>Description: {{$project->description }}</p>
            <p>Duration: {{$project->duration }}</p>
            <p>Status: {{$project->status }}</p>
            <p>Start Date: {{$project->start_date }}</p>
            <p>End Date: {{$project->end_date }}</p>
        </div>
    </div>

</div>

@endsection