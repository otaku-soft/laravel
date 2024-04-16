@extends('layouts/public')
@section('content')
<h2>Welcome to {{ env('APP_NAME') }} Studios</h2>
<br/><br/>
<p >
    {{ env('APP_DESCRIPTION') }}
</p>
    <br/><br/>
    <img src ="custom/banner.jpeg" style="width:100%" />
@endsection
