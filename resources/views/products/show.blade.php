@extends('layouts.app')

@section('title', $product->name)

@section('content')

@php
$variantsData = $product->variants->map(function ($variant) {
return [
'id' => $variant->id,
'sku' => $variant->sku,
'name' => $variant->name,
'attribute_value_ids' => $variant->attributeValues
->pluck('id')
->values(),
];
})->values();
@endphp

<div
    id="product-data"
    data-variants="{{ $variantsData->toJson() }}"></div>

<div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">

    {{-- Breadcrumb --}}
    <nav class="mb-8 text-sm text-gray-500">
        <a
            href="/"
            class="hover:text-gray-900">
            Início
        </a>

        <span class="mx-2">/</span>

        @if ($product->category)
        <span>{{ $product->category->name }}</span>
        <span class="mx-2">/</span>
        @endif

        <span class="text-gray-900">
            {{ $product->name }}
        </span>
    </nav>


    {{-- Produto --}}
    <div class="grid gap-10 lg:grid-cols-2">

        {{-- Galeria --}}
        <div>

            @if ($product->images->isNotEmpty())

            @php
            $primaryImage = $product->images
            ->firstWhere('is_primary', true)
            ?? $product->images->first();
            @endphp

            {{-- Imagem principal --}}
            <div class="flex aspect-square items-center justify-center overflow-hidden rounded-2xl bg-white p-8 shadow-sm ring-1 ring-gray-200">

                <img
                    id="main-product-image"
                    src="{{ asset('storage/' . $primaryImage->path) }}"
                    alt="{{ $primaryImage->alt_text ?? $product->name }}"
                    class="h-full w-full object-contain">

            </div>


            {{-- Miniaturas --}}
            @if ($product->images->count() > 1)

            <div class="mt-4 grid grid-cols-4 gap-3">

                @foreach ($product->images as $image)

                <button
                    type="button"
                    class="product-thumbnail overflow-hidden rounded-xl border border-gray-200 bg-white p-2 transition hover:border-gray-900"
                    data-image="{{ asset('storage/' . $image->path) }}"
                    data-alt="{{ $image->alt_text ?? $product->name }}">
                    <img
                        src="{{ asset('storage/' . $image->path) }}"
                        alt="{{ $image->alt_text ?? $product->name }}"
                        class="h-24 w-full object-contain">
                </button>

                @endforeach

            </div>

            @endif

            @else

            <div class="flex aspect-square items-center justify-center rounded-2xl bg-gray-100 text-gray-400">
                Sem imagem disponível
            </div>

            @endif

        </div>


        {{-- Informações --}}
        <div class="flex flex-col">

            {{-- Marca --}}
            @if ($product->brand)

            <p class="text-sm font-medium uppercase tracking-wide text-gray-500">
                {{ $product->brand }}
            </p>

            @endif


            {{-- Nome --}}
            <h1 class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                {{ $product->name }}
            </h1>


            <p class="mt-2 text-sm text-gray-500">
                Produto original
            </p>


            {{-- Descrição curta --}}
            @if ($product->description)

            <div class="mt-6 border-b border-gray-200 pb-6">

                <p class="leading-7 text-gray-600">
                    {{ $product->description }}
                </p>

            </div>

            @endif


            {{-- Atributos --}}
            @if ($product->attributes->isNotEmpty())

            <div class="mt-6 space-y-6">

                @foreach ($product->attributes as $attribute)

                <div>

                    <div class="mb-3 flex items-center justify-between">

                        <h2 class="text-sm font-semibold text-gray-900">
                            {{ $attribute->name }}
                        </h2>

                        <span
                            id="selected-attribute-{{ $attribute->id }}"
                            class="text-sm text-gray-500"></span>

                    </div>


                    <div class="flex flex-wrap gap-2">

                        @foreach ($attribute->values as $value)

                        <button
                            type="button"
                            class="attribute-option rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 transition hover:border-gray-900 hover:bg-gray-900 hover:text-white"
                            data-attribute-id="{{ $attribute->id }}"
                            data-value-id="{{ $value->id }}"
                            data-value="{{ $value->value }}">
                            {{ $value->value }}
                        </button>

                        @endforeach

                    </div>

                </div>

                @endforeach

            </div>

            @endif


            {{-- Variante selecionada --}}
            <div
                id="selected-variant"
                class="mt-6 hidden rounded-xl border border-gray-200 bg-gray-50 p-4">

                <p class="text-xs font-medium uppercase tracking-wide text-gray-500">
                    Variante selecionada
                </p>

                <p
                    id="selected-variant-name"
                    class="mt-1 font-semibold text-gray-900"></p>

                <p
                    id="selected-variant-sku"
                    class="mt-1 text-sm text-gray-500"></p>

            </div>


            {{-- Preço --}}
            @php
            $activeOffers = $product->variants
            ->flatMap(fn ($variant) => $variant->offers)
            ->where('is_active', true);

            $lowestOffer = $activeOffers
            ->sortBy(fn ($offer) => $offer->sale_price ?? $offer->price)
            ->first();
            @endphp

            @if ($lowestOffer)

            <div class="mt-8 rounded-2xl bg-gray-50 p-5">

                <p class="text-sm text-gray-500">
                    A partir de
                </p>

                @if ($lowestOffer->sale_price)

                <p class="mt-1 text-sm text-gray-400 line-through">
                    R$ {{ number_format($lowestOffer->price, 2, ',', '.') }}
                </p>

                <p class="text-3xl font-bold tracking-tight text-gray-900">
                    R$ {{ number_format($lowestOffer->sale_price, 2, ',', '.') }}
                </p>

                @else

                <p class="text-3xl font-bold tracking-tight text-gray-900">
                    R$ {{ number_format($lowestOffer->price, 2, ',', '.') }}
                </p>

                @endif

            </div>

            @endif


            {{-- Botão --}}
            <div class="mt-6">

                <a
                    href="#ofertas"
                    class="inline-flex w-full items-center justify-center rounded-xl bg-gray-900 px-6 py-3.5 text-sm font-semibold text-white transition hover:bg-gray-700">
                    Ver ofertas
                </a>

            </div>

        </div>

    </div>


    {{-- Ofertas --}}
    <section
        id="ofertas"
        class="mt-16 border-t border-gray-200 pt-12">

        <div class="mb-6">

            <h2 class="text-2xl font-bold tracking-tight text-gray-900">
                Ofertas
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Compare preços e condições disponíveis para este produto.
            </p>

        </div>


        <div class="space-y-4">

            @forelse ($product->variants as $variant)

            @foreach ($variant->offers as $offer)

            @if ($offer->is_active)

            <article
                class="offer-card rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-200 transition hover:shadow-md"
                data-variant-id="{{ $variant->id }}">

                <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between">

                    {{-- Loja --}}
                    <div class="min-w-0">

                        <div class="flex items-center gap-3">

                            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-gray-100 text-sm font-bold text-gray-700">
                                {{ strtoupper(substr($offer->store->name, 0, 1)) }}
                            </div>

                            <div>

                                <h3 class="font-semibold text-gray-900">
                                    {{ $offer->store->name }}
                                </h3>

                                <p class="text-sm text-gray-500">
                                    {{ $variant->name }}
                                </p>

                            </div>

                        </div>


                        <div class="mt-4 flex flex-wrap gap-x-5 gap-y-2 text-sm text-gray-500">

                            <span>
                                SKU:
                                <span class="font-medium text-gray-700">
                                    {{ $offer->sku }}
                                </span>
                            </span>

                            <span>
                                Estoque:
                                <span class="font-medium text-gray-700">
                                    {{ $offer->stock }} unidades
                                </span>
                            </span>

                            @if ($offer->condition)

                            <span class="capitalize">
                                {{ $offer->condition }}
                            </span>

                            @endif

                        </div>

                    </div>


                    {{-- Preço --}}
                    <div class="flex flex-col items-start md:items-end">

                        @if ($offer->sale_price)

                        <span class="text-sm text-gray-400 line-through">
                            R$ {{ number_format($offer->price, 2, ',', '.') }}
                        </span>

                        <span class="text-2xl font-bold text-gray-900">
                            R$ {{ number_format($offer->sale_price, 2, ',', '.') }}
                        </span>

                        @else

                        <span class="text-2xl font-bold text-gray-900">
                            R$ {{ number_format($offer->price, 2, ',', '.') }}
                        </span>

                        @endif

                        <button
                            type="button"
                            class="mt-3 rounded-lg bg-gray-900 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-gray-700">
                            Ver oferta
                        </button>

                    </div>

                </div>

            </article>

            @endif

            @endforeach

            @empty

            <div class="rounded-2xl bg-white p-8 text-center ring-1 ring-gray-200">

                <p class="text-gray-500">
                    Nenhuma oferta disponível no momento.
                </p>

            </div>

            @endforelse

        </div>

    </section>


    {{-- Descrição --}}
    <section class="mt-16 border-t border-gray-200 pt-12">

        <div class="max-w-3xl">

            <h2 class="text-2xl font-bold tracking-tight text-gray-900">
                Sobre este produto
            </h2>

            @if ($product->description)

            <p class="mt-4 leading-7 text-gray-600">
                {{ $product->description }}
            </p>

            @endif


            @if ($product->box_contents)

            <div class="mt-8">

                <h3 class="text-lg font-semibold text-gray-900">
                    Conteúdo da caixa
                </h3>

                <p class="mt-2 leading-7 text-gray-600">
                    {{ $product->box_contents }}
                </p>

            </div>

            @endif

        </div>

    </section>

</div>

@endsection