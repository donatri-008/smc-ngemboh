@extends('layouts.app')
@section('title', 'Tentang Kami - Smart Maritim Community Ngemboh')

@section('content')
<div class="pt-10 space-y-16">
    <h1 class="text-2xl font-bold text-gray-700">Tentang Kami</h1>

    @include('about.partials.sambutan')
    @include('about.partials.programs')
    @include('about.partials.team')
    @include('about.partials.legalities')
    @include('about.partials.partners')
</div>
@endsection