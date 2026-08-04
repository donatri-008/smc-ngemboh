@props(['message' => 'Belum ada data.'])

<p {{ $attributes->merge(['class' => 'text-sm text-gray-400 text-center py-6 col-span-full']) }}>
    {{ $message }}
</p>