@extends('layouts.guest')
@section('title', 'Login Admin - Smart Maritim Community Ngemboh')

@section('content')
<div class="min-h-screen flex flex-col bg-[#F6F9FF]">

    {{-- Header - TopAppBar --}}
    <header class="w-full h-14 px-6 py-2 flex items-center bg-[#F6F9FF]">
        <span class="text-[32px] leading-10 font-bold text-[#2681FA]">Smart Maritime</span>
    </header>

    {{-- Main Content --}}
    <main class="relative flex-1 flex items-center justify-center px-6 py-10 overflow-hidden">

        {{-- Atmospheric ambient blur elements --}}
        <div class="absolute w-64 h-64 -left-32 -top-32 bg-[#B2ECFD] opacity-20 blur-[50px] rounded-full pointer-events-none"></div>
        <div class="absolute w-96 h-96 -right-32 -bottom-32 bg-[#B9ECEE] opacity-20 blur-[60px] rounded-full pointer-events-none"></div>

        {{-- Login Card --}}
        <div class="relative z-10 w-full max-w-[448px]" x-data="{ showPassword: false }">
            <div class="bg-[#F6F9FF] rounded-2xl p-12 space-y-8"
                 style="box-shadow: -6px -6px 12px #FFFFFF, 6px 6px 12px #BABECC;">

                {{-- Header --}}
                <div class="space-y-2 text-center">
                    <h1 class="text-[32px] leading-10 font-bold text-[#2681FA]">Login Admin</h1>
                    <p class="text-base text-[#40484B]">Akses dashboard pengelola Smart Maritim</p>
                </div>

                {{-- Session Status --}}
                @if (session('status'))
                <div class="rounded-xl px-4 py-3 text-sm font-semibold text-[#4CC71C] bg-[#F6F9FF]"
                     style="box-shadow: inset -4px -4px 8px #FFFFFF, inset 4px 4px 8px #BABECC;">
                    {{ session('status') }}
                </div>
                @endif

                {{-- Validation Errors --}}
                @if ($errors->any())
                <div class="rounded-xl px-4 py-3 text-sm font-semibold text-red-500 bg-[#F6F9FF] space-y-1"
                     style="box-shadow: inset -4px -4px 8px #FFFFFF, inset 4px 4px 8px #BABECC;">
                    @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                    @endforeach
                </div>
                @endif

                {{-- Form --}}
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    {{-- Email / Username --}}
                    <div class="space-y-2">
                        <label for="email" class="block px-2 text-[13px] font-semibold tracking-wide text-[#40484B]">
                            Email atau Username
                        </label>
                        <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-[#F6F9FF]"
                            style="box-shadow: inset -6px -6px 12px #FFFFFF, inset 6px 6px 12px #BABECC;">
                            <x-heroicon-o-user class="w-4 h-4 text-[#4CC71C] shrink-0" />
                            <input id="email" type="email" name="email" value="{{ old('email') }}"
                                required autofocus autocomplete="username"
                                placeholder="Masukkan email/username"
                                class="w-full bg-transparent border-0 focus:ring-0 focus:outline-none outline-none text-base text-[#171C21] placeholder-[#BFC8CB]">
                        </div>
                    </div>

                    {{-- Password --}}
                    <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-[#F6F9FF]"
                        style="box-shadow: inset -6px -6px 12px #FFFFFF, inset 6px 6px 12px #BABECC;">
                        <x-heroicon-o-lock-closed class="w-4 h-4 text-[#4CC71C] shrink-0" />
                        <input :type="showPassword ? 'text' : 'password'"
                            id="password" name="password"
                            required autocomplete="current-password"
                            placeholder="••••••••"
                            class="w-full bg-transparent border-0 focus:ring-0 focus:outline-none outline-none text-base text-[#171C21] placeholder-[#BFC8CB]">
                        <button type="button" @click="showPassword = !showPassword" class="shrink-0 text-[#40484B]">
                            <x-heroicon-o-eye class="w-4 h-4" x-show="!showPassword" />
                            <x-heroicon-o-eye-slash class="w-4 h-4" x-show="showPassword" x-cloak />
                        </button>
                    </div>

                    {{-- Submit --}}
                    <button type="submit"
                            class="w-full flex items-center justify-center gap-2 py-4 rounded-2xl bg-[#F6F9FF] font-bold text-xl text-[#4CC71C] transition active:scale-95"
                            style="box-shadow: -6px -6px 12px #FFFFFF, 6px 6px 12px #BABECC;">
                        Masuk
                        <x-heroicon-o-arrow-right-on-rectangle class="w-5 h-5" />
                    </button>
                </form>
            </div>

            {{-- Branding Accent --}}
            <div class="flex items-center justify-center gap-2 mt-6">
                <svg class="w-3 h-3 text-[#70787B]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 2v6m0 0a3 3 0 100 6 3 3 0 000-6zm0 6v10m0 0c-4.418 0-8-2.239-8-5m8 5c4.418 0 8-2.239 8-5M4 13H2m20 0h-2" />
                </svg>
                <p class="text-[13px] font-semibold tracking-wide text-[#70787B]">Membangun Komunitas Maritim Digital</p>
            </div>
        </div>
    </main>
</div>
@endsection