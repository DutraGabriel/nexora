<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Nexora')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-900">

    <header class="border-b border-gray-200 bg-white">
        <div class="mx-auto flex max-w-7xl flex-wrap items-center gap-4 px-6 py-4">
            <a
                href="/"
                class="shrink-0 text-2xl font-bold tracking-tight text-gray-900 transition hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2">
                Nexora
            </a>

            <div class="order-3 flex w-full items-center rounded-lg border border-gray-200 bg-gray-50 px-3 py-2 sm:order-none sm:min-w-56 sm:flex-1">
                <svg
                    aria-hidden="true"
                    class="mr-2 h-5 w-5 shrink-0 text-gray-500"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-4.35-4.35m2.35-5.4a7.75 7.75 0 1 1-15.5 0 7.75 7.75 0 0 1 15.5 0Z" />
                </svg>
                <input
                    type="search"
                    placeholder="Buscar produtos..."
                    aria-label="Buscar produtos"
                    class="min-w-0 flex-1 border-0 bg-transparent p-0 text-sm text-gray-900 placeholder:text-gray-500 focus:outline-none focus:ring-0">
            </div>

            <nav aria-label="Navegação principal" class="flex items-center gap-1 sm:ml-auto">
                <a
                    href="{{ route('products.index') }}"
                    class="rounded-lg px-3 py-2 text-sm font-medium text-gray-700 transition hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2">
                    Produtos
                </a>
                <a
                    href="#"
                    aria-disabled="true"
                    class="rounded-lg px-3 py-2 text-sm font-medium text-gray-500 transition hover:bg-gray-100 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2">
                    Categorias
                </a>
            </nav>
        </div>
    </header>

    <main class="mx-auto max-w-7xl px-6 py-8">
        @yield('content')
    </main>

</body>

</html>
