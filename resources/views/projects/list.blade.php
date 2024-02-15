@extends('layouts.admin')

@section('title')
    Projects List - Portoflio
@endsection

@section('content')
    <div class="project-list container">
        <div class="row justify-content-center">
            <div class="col-12 mt-4">
                <div class="all-projects d-flex flex-column align-items-center">

                    {{-- Collegamento a tutti i fumetti --}}
                    <a href="{{ route('admin.projects.create') }}"
                        class="btn custom-btn orange text-uppercase mb-5 mt-4 fw-bold">Create a
                        new
                        project</a>

                    <ul class="row g-5">
                        @foreach ($projects as $project)
                            <li class="col-12 col-lg-6 col-xxl-4 d-flex">

                                <div class="card-custom">

                                    {{-- Status progetto --}}
                                    <p
                                        class="header language fw-bold @if ($project->status->title === 'Completed') text-success @elseif ($project->status->title === 'Ongoing') text-secondary @elseif ($project->status->title === 'Aborted') text-danger  @elseif ($project->status->title === 'Suspended') text-warning @endif w-25 text-lowercase ">
                                        {{ $project->status->title }}</p>
                                    <div class="main-content">
                                        {{-- Titolo progetto --}}
                                        <a href="{{ route('admin.projects.show', $project) }}" class="heading">
                                            <h3 class="title py-3">{{ $project->title }}</h3>
                                        </a>

                                        {{-- Data inizio progetto --}}
                                        <p class="start-date pt-1">Project started on
                                            {{ \Carbon\Carbon::parse($project->start_date)->format('M d Y') }}</p>

                                        {{-- Data fine progetto --}}
                                        @isset($project->end_date)
                                            <p class="end-date">and ended on
                                                {{ \Carbon\Carbon::parse($project->end_date)->format('M d Y') }}</p>
                                        @endisset

                                        {{-- Categoria progetto --}}
                                        <p
                                            class="category text-uppercase badge bg-light text-black w-auto mx-auto my-3 p-2">
                                            {{ $project->type->title }}
                                        </p>

                                        {{-- Linguaggi progetto --}}

                                        @if ($project->technologies)
                                            {{-- Tecnologie progetto --}}
                                            <div class="lang-container">
                                                @foreach ($project->technologies as $technology)
                                                    <div class="skill-box">
                                                        <span class="title">{{ $technology->title }} </span>
                                                        <div class="skill-bar">
                                                            <span class="skill-per html">
                                                            </span>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif

                                    </div>

                                    <div class="footer">

                                        {{-- Pulsanti --}}
                                        <div class="buttons row g-0">
                                            <a href="{{ route('admin.projects.edit', $project) }}" class="col-4"><button
                                                    class="ui-btn">
                                                    <div class="text-uppercase">Edit</div>
                                                </button>
                                            </a>

                                            <a href="{{ route('admin.projects.show', $project) }}" class="col-4"><button
                                                    class="ui-btn">
                                                    <div class="text-uppercase">Show</div>
                                                </button>
                                            </a>

                                            <button class="ui-btn col-4" data-bs-toggle="modal"
                                                data-bs-target="#my-dialog-{{ $project->id }}">
                                                <div class="text-uppercase">
                                                    Delete
                                                </div>
                                            </button>
                                        </div>


                                        {{-- Modale --}}
                                        <div class="modal" id="my-dialog-{{ $project->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content card-custom">

                                                    {{-- Messaggio di alert --}}
                                                    <div class="modal-header text-center">
                                                        <h3>Are you sure?</h3>
                                                    </div>

                                                    {{-- Informazione operazione --}}
                                                    <div class="modal-body text-center">
                                                        You are about to delete <br> {{ $project->title }}</span>
                                                    </div>

                                                    <div class="modal-footer">

                                                        {{-- Pulsante annulla --}}
                                                        <button
                                                            class="btn custom-btn white text-uppercase mb-4 mt-5 fw-bold"
                                                            data-bs-dismiss="modal">Dismiss
                                                        </button>

                                                        {{-- Pulsante elimina --}}
                                                        <form action="{{ route('admin.projects.destroy', $project) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input
                                                                class="btn custom-btn white text-uppercase mb-4 mt-5 fw-bold"
                                                                type="submit" value="DELETE">
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </li>
                        @endforeach
                    </ul>



                </div>
            </div>
        </div>
    </div>
@endsection
