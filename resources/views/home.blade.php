@extends('layouts.app')
<style>
    .top-left-corner {
        position: fixed;
        bottom: 20;
        left: 109;
    }
    .top-right-corner {
        position: fixed;
        bottom: 20;
        right: 109;
    }
</style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
    <div class="top-left-corner">
    @if(auth()->user()->type === 'patient')
        <a href="{{ route('checkpatientinfo') }}" class="btn btn-primary">Edit Details</a>
    @elseif(auth()->user()->type === 'donor')
        <a href="{{ route('checkdonarinfo') }}" class="btn btn-primary">Edit Details</a>
    @elseif(auth()->user()->type === 'hospital')
        <a href="{{ route('checkhospitalinfo') }}" class="btn btn-primary">Edit Details</a>
    @endif
</div>
</div>

<div class="top-right-corner">
    @if(auth()->user()->type === 'patient')
        <a href="{{ route('checkpatientinfo') }}" class="btn btn-danger">Blood Request</a>
    @elseif(auth()->user()->type === 'donor')
        <a href="{{ route('checkdonarinfo') }}" class="btn btn-primary">Edit Details</a>
    @elseif(auth()->user()->type === 'hospital')
        <a href="{{ route('checkhospitalinfo') }}" class="btn btn-primary">Edit Details</a>
    @endif
</div>

</div>
@endsection
