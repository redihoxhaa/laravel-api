@extends('layouts.admin')

@section('title')
    Edit {{ $project->title }} - Portoflio
@endsection

@section('content')
    <div class="project-update container">
        <div class="row justify-content-center">

            {{-- Link per tonare a tutti i progetti --}}
            <a href="{{ route('admin.projects.index') }}"
                class="btn custom-btn orange text-uppercase mb-5 mt-5 fw-bold mx-auto d-block">Take a look at
                all the
                projects</a>

            <div class="col-12 card-custom p-5">

                <h2 class="text-center py-5">Update {{ $project->title }}</h2>



                {{-- Form di upload nuovo progetto --}}
                <form class="d-flex flex-column align-items-center gap-3 w-100"
                    action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">

                    {{-- Token autenticazione  --}}
                    @csrf

                    {{-- Metodo di edit --}}
                    @method('PUT')

                    {{-- Input titolo --}}
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text text-capitalize">title</span>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                            value="{{ old('title', $project->title) }}" required>
                        @error('title')
                            <div class="alert alert-danger m-0">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Input thumb --}}
                    <div class="input-group flex-nowrap">
                        <div class="input-group">
                            <input class="form-control" type="file" id="thumb" name="thumb">
                        </div>
                        @error('thumb')
                            <div class="alert alert-danger m-0">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Input descrizione --}}
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text text-capitalize">description</span>
                        <textarea type="text" class="form-control @error('description') is-invalid @enderror" name="description">{{ old('description', $project->description) }}</textarea>
                        @error('description')
                            <div class="alert alert-danger m-0">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Input data di inizio progetto --}}
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text text-capitalize">start date</span>
                        <input type="date" class="form-control @error('start_date') is-invalid @enderror" id="start_date"
                            name="start_date" value="{{ old('start_date', $project->start_date) }}">
                        @error('start_date')
                            <div class="alert alert-danger m-0">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Input data di fine progetto --}}
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text text-capitalize">end date</span>
                        <input type="date" class="form-control @error('end_date') is-invalid @enderror" id="end_date"
                            name="end_date" value="{{ old('end_date', $project->end_date) }}">
                        @error('end_date')
                            <div class="alert alert-danger m-0">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Input categoria --}}
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text text-capitalize">type</span>
                        <select class="form-select" aria-label="Default select example" name="type_id">
                            <option selected>Choose type...</option>
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}" @if (old('type_id', $project->type_id) == $type->id) selected @endif>
                                    {{ $type->title }}</option>
                            @endforeach


                        </select>
                        @error('type_id')
                            <div class="alert alert-danger m-0">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Input linguaggio --}}
                    <div class="input-group flex-nowrap">
                        @foreach ($technologies as $technology)
                            <div class="form-check form-check-inline">

                                @if ($errors->any())
                                    <input class="form-check-input" type="checkbox" value="{{ $technology->id }}"
                                        name="technologies[]" id="technology-{{ $technology->id }}"
                                        {{ in_array($technology->id, old('technologies', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label"
                                        for="technology-{{ $technology->id }}">{{ $technology->title }}
                                    </label>
                                @else
                                    <input class="form-check-input" type="checkbox" value="{{ $technology->id }}"
                                        name="technologies[]" id="technology-{{ $technology->id }}"
                                        {{ $project->technologies->contains($technology->id) ? 'checked' : '' }}>
                                    <label class="form-check-label"
                                        for="technology-{{ $technology->id }}">{{ $technology->title }}
                                    </label>
                                @endif

                            </div>
                        @endforeach
                        @error('technologies')
                            <div class="alert alert-danger m-0">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Input categoria --}}
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text text-capitalize">status</span>
                        <select class="form-select" aria-label="Default select example" name="status_id">
                            <option selected>Choose status...</option>
                            @foreach ($statuses as $status)
                                <option value="{{ $status->id }}" @if (old('status_id', $project->status_id) == $status->id) selected @endif>
                                    {{ $status->title }}</option>
                            @endforeach


                        </select>
                        @error('status_id')
                            <div class="alert alert-danger m-0">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Bottone submit --}}
                    <button type="submit"
                        class="btn custom-btn white text-uppercase mb-4 mt-5 fw-bold mx-auto d-block">Update
                        project</button>
                </form>
            </div>
        </div>
    </div>
@endsection
