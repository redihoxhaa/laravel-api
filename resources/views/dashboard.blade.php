@extends('layouts.admin')

@section('content')
    <div class="dashboard container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-4">
                <h1 class="p-3 text-center">
                    Welcome to my portfolio, {{ Auth::user()->name }}!
                </h1>

                <a href="{{ route('admin.projects.index') }}" class="btn custom-btn orange mt-3">Take a look at my
                    projects</a>

            </div>
        </div>
    </div>
@endsection
