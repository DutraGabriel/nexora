@extends('layouts.app')

@section('title', 'Produtos')

@section('content')

<div class="mx-auto max-w-7xl">
    <div class="mb-8">
        <p class="text-sm font-medium uppercase tracking-wide text-gray-500">Nexora</p>
        <h1 class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Produtos</h1>
        <p class="mt-3 max-w-2xl text-gray-600">
            Encontre e compare produtos e ofertas para fazer escolhas melhores no Nexora.
        </p>
    </div>

    @if ($products->isEmpty())
    <div class="rounded-2xl border border-dashed border-gray-300 bg-white px-6 py-12 text-center shadow-sm">
        <p class="font-medium text-gray-900">Nenhum produto cadastrado</p>
        <p class="mt-1 text-sm text-gray-500">Os produtos disponíveis aparecerão aqui.</p>
    </div>
    @else
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        @foreach ($products as $product)
        @php
        $image = $product->images->first();
        $activeOffers = $product->variants->flatMap->offers;
        $lowestPrice = $activeOffers
            ->map(fn ($offer) => $offer->sale_price ?? $offer->price)
            ->min();
        @endphp

        <article class="flex flex-col overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-200 transition hover:-translate-y-0.5 hover:shadow-md">
            <div class="flex aspect-square items-center justify-center bg-gray-50 p-6">
                @if ($image)
                <img
                    src="{{ asset('storage/' . $image->path) }}"
                    alt="{{ $image->alt_text ?? $product->name }}"
                    class="h-full w-full object-contain"
                    loading="lazy">
                @else
                <span class="text-sm font-medium text-gray-400">Sem imagem</span>
                @endif
            </div>

            <div class="flex flex-1 flex-col p-5">
                @if ($product->brand)
                <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">{{ $product->brand }}</p>
                @endif

                <h2 class="mt-2 text-lg font-semibold leading-6 text-gray-900">{{ $product->name }}</h2>

                @if ($product->category)
                <p class="mt-2 text-sm text-gray-500">{{ $product->category->name }}</p>
                @endif

                <div class="mt-5 min-h-16">
                    @if ($lowestPrice !== null)
                    <p class="text-xs font-medium uppercase tracking-wide text-gray-500">A partir de</p>
                    <p class="mt-1 text-2xl font-bold text-gray-900">
                        R$ {{ number_format((float) $lowestPrice, 2, ',', '.') }}
                    </p>
                    <p class="mt-1 text-xs text-gray-500">
                        {{ $activeOffers->count() }} {{ $activeOffers->count() === 1 ? 'oferta ativa' : 'ofertas ativas' }}
                    </p>
                    @else
                    <p class="text-sm font-medium text-gray-500">Sem ofertas disponíveis</p>
                    @endif
                </div>

                <a
                    href="{{ route('products.show', $product) }}"
                    class="mt-6 inline-flex items-center justify-center rounded-lg bg-gray-900 px-4 py-3 text-sm font-semibold text-white transition hover:bg-gray-700">
                    Ver produto
                </a>
            </div>
        </article>
        @endforeach
    </div>
    @endif
</div>

@endsection
