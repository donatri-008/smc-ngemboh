@extends('layouts.app')
@section('title', 'Tentang Kami - Smart Maritim Community Ngemboh')

@section('content')
<div class="pt-10 space-y-16">

    @include('about.partials.sambutan')
    @include('about.partials.sejarah')
    @include('about.partials.programs')
    @include('about.partials.legalities')
    @include('about.partials.partners')
    @include('about.partials.team')
    @include('about.partials.kontak')
</div>
@endsection
