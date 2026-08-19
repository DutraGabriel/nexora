<header class="border-b border-gray-200 bg-white">
    <div class="mx-auto flex max-w-7xl items-center justify-between gap-6 px-4 py-4 sm:px-6 lg:px-8">
        <a
            href="{{ route('home') }}"
            class="shrink-0 text-2xl font-bold tracking-tight text-gray-900 transition hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2">
            Nexora
        </a>

        <nav aria-label="Navegação principal" class="hidden items-center gap-1 lg:flex">
            <a href="{{ route('home') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-gray-700 transition hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2">Início</a>
            <a href="{{ route('products.index') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-gray-700 transition hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2">Produtos</a>
            <a href="{{ url('/#categorias') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-gray-700 transition hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2">Categorias</a>
            <a href="{{ url('/#como-funciona') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-gray-700 transition hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2">Sobre</a>
            <a href="{{ url('/#contato') }}" class="rounded-lg px-3 py-2 text-sm font-medium text-gray-700 transition hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2">Contato</a>
        </nav>

        <div class="hidden items-center gap-2 lg:flex">
            <a href="#" aria-disabled="true" class="rounded-lg px-3 py-2 text-sm font-medium text-gray-500 transition hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2">Entrar</a>
            <a href="#" aria-disabled="true" class="rounded-lg bg-gray-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2">Criar conta</a>
        </div>

        <button
            type="button"
            data-menu-toggle
            aria-controls="mobile-navigation"
            aria-expanded="false"
            aria-label="Abrir menu"
            class="inline-flex h-10 w-10 items-center justify-center rounded-lg border border-gray-200 text-gray-700 transition hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2 lg:hidden">
            <svg data-menu-open-icon aria-hidden="true" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <svg data-menu-close-icon aria-hidden="true" class="hidden h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 6l12 12M6 18L18 6" />
            </svg>
        </button>
    </div>

    <div id="mobile-navigation" data-mobile-menu class="hidden border-t border-gray-100 bg-white lg:hidden">
        <nav aria-label="Navegação mobile" class="mx-auto max-w-7xl space-y-1 px-4 py-4 sm:px-6">
            <a href="{{ route('home') }}" class="block rounded-lg px-3 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-100">Início</a>
            <a href="{{ route('products.index') }}" class="block rounded-lg px-3 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-100">Produtos</a>
            <a href="{{ url('/#categorias') }}" class="block rounded-lg px-3 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-100">Categorias</a>
            <a href="{{ url('/#como-funciona') }}" class="block rounded-lg px-3 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-100">Sobre</a>
            <a href="{{ url('/#contato') }}" class="block rounded-lg px-3 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-100">Contato</a>
            <div class="mt-3 flex gap-2 border-t border-gray-100 pt-3">
                <a href="#" aria-disabled="true" class="flex-1 rounded-lg border border-gray-200 px-3 py-2.5 text-center text-sm font-medium text-gray-600">Entrar</a>
                <a href="#" aria-disabled="true" class="flex-1 rounded-lg bg-gray-900 px-3 py-2.5 text-center text-sm font-semibold text-white">Criar conta</a>
            </div>
        </nav>
    </div>
</header>
