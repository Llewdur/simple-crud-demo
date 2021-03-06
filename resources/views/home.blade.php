@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <a href='{!! url('/interests'); !!}'>{{ __('Manage Interests') }}</a>
                    <br>
                    <a href='{!! url('/languages'); !!}'>{{ __('Manage Languages') }}</a>
                    <br>
                    <a href='{!! url('/users'); !!}'>{{ __('Manage Users') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
