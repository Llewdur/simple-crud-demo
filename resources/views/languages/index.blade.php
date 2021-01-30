@extends('layouts.app')

@section('content')
    @include('languages/includes/dataTable')
    @include('languages/includes/addModal')
    @include('languages/includes/editModal')
@endsection

@section('footer-scripts')
    <script type="text/javascript" src="js/generic.js"></script>
    <script type="text/javascript" src="js/languages.js"></script>
@endsection
