@extends('layouts.app')

@section('content')
    @include('users/includes/dataTable')
    @include('users/includes/addModal')
    @include('users/includes/editModal')
@endsection

@section('footer-scripts')
    <script type="text/javascript" src="js/generic.js"></script>
    <script type="text/javascript" src="js/users.js"></script>
@endsection
