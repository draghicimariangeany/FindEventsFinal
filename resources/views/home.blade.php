@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card w-100">
                <div class="card-header">Add event</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div id="app">
                        <add-event-component></add-event-component>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
