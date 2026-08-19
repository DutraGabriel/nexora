@extends('layouts.app')

@section('title', 'Compare preços e encontre as melhores ofertas')

@section('content')
<div class="bg-white">
    <section class="border-b border-gray-200 bg-gray-50">
        <div class="mx-auto grid max-w-7xl gap-12 px-4 py-16 sm:px-6 sm:py-20 lg:grid-cols-[1.05fr_0.95fr] lg:items-center lg:px-8 lg:py-24">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.18em] text-gray-500">Comparação sem complicação</p>
                <h1 class="mt-5 max-w-3xl text-4xl font-bold tracking-tight text-gray-950 sm:text-6xl">
                    Compare preços e encontre as melhores ofertas.
                </h1>
                <p class="mt-6 max-w-xl text-lg leading-8 text-gray-600">
                    O Nexora reúne ofertas de diferentes lojas para você comparar valores, condições e disponibilidade antes de decidir onde comprar.
                </p>

                <form action="{{ route('products.index') }}" method="GET" class="mt-8 flex max-w-xl flex-col gap-3 sm:flex-row">
                    <label for="home-search" class="sr-only">Buscar produtos</label>
                    <div class="flex min-h-14 flex-1 items-center gap-3 rounded-xl border border-gray-300 bg-white px-4 shadow-sm focus-within:border-gray-900 focus-within:ring-2 focus-within:ring-gray-900/10">
                        <svg aria-hidden="true" class="h-5 w-5 shrink-0 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m21 21-4.35-4.35m2.35-5.4a7.75 7.75 0 1 1-15.5 0 7.75 7.75 0 0 1 15.5 0Z" />
                        </svg>
                        <input id="home-search" name="q" type="search" placeholder="O que você está procurando?" class="min-w-0 flex-1 border-0 bg-transparent text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-0">
                    </div>
                    <button type="submit" class="inline-flex min-h-14 items-center justify-center rounded-xl bg-gray-900 px-6 text-sm font-semibold text-white transition hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2">
                        Pesquisar produtos
                    </button>
                </form>

                <div class="mt-8 flex flex-wrap gap-x-6 gap-y-3 text-sm text-gray-500">
                    <span class="inline-flex items-center gap-2"><span class="h-1.5 w-1.5 rounded-full bg-gray-900"></span>Ofertas de várias lojas</span>
                    <span class="inline-flex items-center gap-2"><span class="h-1.5 w-1.5 rounded-full bg-gray-900"></span>Preços para comparar</span>
                </div>
            </div>

            <div class="relative rounded-3xl border border-gray-200 bg-white p-6 shadow-sm sm:p-8">
                <div class="flex items-center justify-between border-b border-gray-100 pb-5">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.16em] text-gray-400">Visão Nexora</p>
                        <p class="mt-1 text-lg font-semibold text-gray-900">Uma escolha mais clara</p>
                    </div>
                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-gray-900 text-white" aria-hidden="true">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 19V5m0 14h16M8 16v-5m4 5V7m4 9v-8" />
                        </svg>
                    </div>
                </div>
                <div class="space-y-4 pt-6">
                    <div class="rounded-2xl border border-gray-200 p-4">
                        <div class="flex items-center justify-between gap-4">
                            <span class="text-sm font-medium text-gray-700">Preço atual</span>
                            <span class="text-xs font-medium text-gray-400">comparado</span>
                        </div>
                        <div class="mt-4 flex items-end gap-3">
                            <span class="text-3xl font-bold tracking-tight text-gray-950">R$ 1.899,90</span>
                            <span class="mb-1 text-sm font-medium text-gray-500">menor valor</span>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="rounded-2xl bg-gray-50 p-4">
                            <p class="text-xs text-gray-500">Lojas analisadas</p>
                            <p class="mt-2 text-xl font-bold text-gray-900">{{ $storeCount }}</p>
                        </div>
                        <div class="rounded-2xl bg-gray-50 p-4">
                            <p class="text-xs text-gray-500">Ofertas reunidas</p>
                            <p class="mt-2 text-xl font-bold text-gray-900">{{ $activeOfferCount }}</p>
                        </div>
                    </div>
                </div>
                <p class="mt-6 text-xs leading-5 text-gray-400">Os valores exibidos na plataforma podem mudar na loja de destino.</p>
            </div>
        </div>
    </section>

    <section id="categorias" class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.16em] text-gray-500">Explore por assunto</p>
                <h2 class="mt-2 text-3xl font-bold tracking-tight text-gray-950">Encontre o que importa para você</h2>
            </div>
            <a href="{{ route('products.index') }}" class="text-sm font-semibold text-gray-700 underline decoration-gray-300 underline-offset-4 transition hover:text-gray-950">Ver todos os produtos</a>
        </div>

        @if ($categories->isNotEmpty())
        <div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($categories as $category)
            <a href="{{ route('products.index') }}" class="group rounded-2xl border border-gray-200 bg-white p-5 transition hover:border-gray-400 hover:shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2">
                <div class="flex items-center justify-between gap-4">
                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-gray-100 text-gray-700" aria-hidden="true">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 5.5A1.5 1.5 0 0 1 5.5 4h5A1.5 1.5 0 0 1 12 5.5v5a1.5 1.5 0 0 1-1.5 1.5h-5A1.5 1.5 0 0 1 4 10.5v-5ZM12 13.5a1.5 1.5 0 0 1 1.5-1.5h5a1.5 1.5 0 0 1 1.5 1.5v5a1.5 1.5 0 0 1-1.5 1.5h-5a1.5 1.5 0 0 1-1.5-1.5v-5Z" />
                        </svg>
                    </div>
                    <svg aria-hidden="true" class="h-5 w-5 text-gray-400 transition group-hover:translate-x-1 group-hover:text-gray-900" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m9 18 6-6-6-6" />
                    </svg>
                </div>
                <h3 class="mt-5 font-semibold text-gray-900">{{ $category->name }}</h3>
                <p class="mt-1 text-sm text-gray-500">{{ $category->products_count }} {{ $category->products_count === 1 ? 'produto' : 'produtos' }} para comparar</p>
            </a>
            @endforeach
        </div>
        @else
        <div class="mt-8 rounded-2xl border border-dashed border-gray-300 px-6 py-10 text-center">
            <p class="font-medium text-gray-900">Categorias em breve</p>
            <p class="mt-1 text-sm text-gray-500">Assim que houver categorias cadastradas, elas aparecerão aqui.</p>
        </div>
        @endif
    </section>

    <section class="border-y border-gray-200 bg-gray-50">
        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
            <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.16em] text-gray-500">Seleção atual</p>
                    <h2 class="mt-2 text-3xl font-bold tracking-tight text-gray-950">Produtos em destaque</h2>
                    <p class="mt-2 max-w-xl text-gray-600">Veja alguns produtos do catálogo e compare as ofertas disponíveis.</p>
                </div>
                <a href="{{ route('products.index') }}" class="text-sm font-semibold text-gray-700 underline decoration-gray-300 underline-offset-4 transition hover:text-gray-950">Explorar catálogo</a>
            </div>

            @if ($products->isNotEmpty())
            <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($products as $product)
                @php
                    $image = $product->images->first();
                    $activeOffers = $product->variants->flatMap->offers;
                    $lowestPrice = $activeOffers->map(fn ($offer) => $offer->sale_price ?? $offer->price)->min();
                @endphp
                <article class="flex flex-col overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-200 transition hover:-translate-y-0.5 hover:shadow-md">
                    <div class="flex aspect-square items-center justify-center bg-gray-50 p-6">
                        @if ($image)
                        <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $image->alt_text ?? $product->name }}" class="h-full w-full object-contain" loading="lazy">
                        @else
                        <span class="text-sm font-medium text-gray-400">Sem imagem</span>
                        @endif
                    </div>
                    <div class="flex flex-1 flex-col p-5">
                        @if ($product->brand)
                        <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">{{ $product->brand }}</p>
                        @endif
                        <h3 class="mt-2 font-semibold leading-6 text-gray-900">{{ $product->name }}</h3>
                        <div class="mt-5 min-h-16">
                            @if ($lowestPrice !== null)
                            <p class="text-xs font-medium uppercase tracking-wide text-gray-500">A partir de</p>
                            <p class="mt-1 text-xl font-bold text-gray-900">R$ {{ number_format((float) $lowestPrice, 2, ',', '.') }}</p>
                            @else
                            <p class="text-sm font-medium text-gray-500">Sem ofertas disponíveis</p>
                            @endif
                        </div>
                        <a href="{{ route('products.show', $product) }}" class="mt-5 inline-flex items-center justify-center rounded-lg bg-gray-900 px-4 py-3 text-sm font-semibold text-white transition hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2">Ver produto</a>
                    </div>
                </article>
                @endforeach
            </div>
            @else
            <div class="mt-8 rounded-2xl border border-dashed border-gray-300 bg-white px-6 py-12 text-center">
                <p class="font-medium text-gray-900">O catálogo está sendo preparado</p>
                <p class="mt-1 text-sm text-gray-500">Os produtos disponíveis aparecerão aqui.</p>
            </div>
            @endif
        </div>
    </section>

    <section id="como-funciona" class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="max-w-2xl">
            <p class="text-sm font-semibold uppercase tracking-[0.16em] text-gray-500">Como funciona</p>
            <h2 class="mt-2 text-3xl font-bold tracking-tight text-gray-950">Decida com mais contexto.</h2>
            <p class="mt-3 text-gray-600">O Nexora organiza a comparação para que você encontre a oferta que faz sentido e siga para a loja escolhida.</p>
        </div>
        <div class="mt-10 grid gap-8 md:grid-cols-3">
            <div class="border-t-2 border-gray-900 pt-5">
                <span class="text-sm font-bold text-gray-400">01</span>
                <h3 class="mt-3 font-semibold text-gray-900">Encontre um produto</h3>
                <p class="mt-2 text-sm leading-6 text-gray-600">Use a busca ou explore o catálogo organizado por categorias.</p>
            </div>
            <div class="border-t-2 border-gray-900 pt-5">
                <span class="text-sm font-bold text-gray-400">02</span>
                <h3 class="mt-3 font-semibold text-gray-900">Compare as ofertas</h3>
                <p class="mt-2 text-sm leading-6 text-gray-600">Avalie preço, condição, estoque e as lojas disponíveis.</p>
            </div>
            <div class="border-t-2 border-gray-900 pt-5">
                <span class="text-sm font-bold text-gray-400">03</span>
                <h3 class="mt-3 font-semibold text-gray-900">Visite a loja</h3>
                <p class="mt-2 text-sm leading-6 text-gray-600">Quando decidir, acesse a oferta diretamente no site da loja.</p>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 pb-20 sm:px-6 lg:px-8">
        <div class="flex flex-col items-start justify-between gap-6 rounded-2xl bg-gray-900 px-6 py-10 text-white sm:flex-row sm:items-center sm:px-10">
            <div>
                <h2 class="text-2xl font-bold tracking-tight">Pronto para comparar?</h2>
                <p class="mt-2 max-w-lg text-sm leading-6 text-gray-300">Explore o catálogo e encontre informações para fazer sua próxima escolha.</p>
            </div>
            <a href="{{ route('products.index') }}" class="inline-flex shrink-0 items-center justify-center rounded-lg bg-white px-5 py-3 text-sm font-semibold text-gray-900 transition hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-900">Explorar produtos</a>
        </div>
    </section>
</div>
@endsection
