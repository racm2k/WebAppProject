@extends('layouts.app')

@section('title')
Painel de Controlo
@endsection

@section('content')

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<ul class="list-group">
    @forelse($users as $user)
    <li class="list-group-item">
        <h5>{{$user->id}} - {{$user->name}} - {{$user->role}} - {{$user->email}}</h5>
        
    </li>
    @empty
    <h5 class="text-center">No Users Found!</h5>
    @endforelse
</ul>

{!! $users->links('pagination::bootstrap-4') !!}

@endsection