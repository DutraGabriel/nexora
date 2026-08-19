<footer id="contato" class="border-t border-gray-200 bg-white">
    <div class="mx-auto grid max-w-7xl gap-10 px-4 py-12 sm:px-6 md:grid-cols-2 lg:grid-cols-4 lg:px-8">
        <div class="md:col-span-2">
            <a href="{{ route('home') }}" class="text-xl font-bold tracking-tight text-gray-900">Nexora</a>
            <p class="mt-3 max-w-sm text-sm leading-6 text-gray-500">Compare preços. Compre melhor.</p>
            <p class="mt-6 text-xs text-gray-400">O Nexora direciona você para lojas externas. Não realizamos vendas dentro da plataforma.</p>
        </div>

        <div>
            <h2 class="text-sm font-semibold text-gray-900">Explorar</h2>
            <nav class="mt-4 space-y-3 text-sm text-gray-500" aria-label="Links do rodapé">
                <a href="{{ route('products.index') }}" class="block transition hover:text-gray-900">Produtos</a>
                <a href="{{ url('/#categorias') }}" class="block transition hover:text-gray-900">Categorias</a>
                <a href="{{ url('/#como-funciona') }}" class="block transition hover:text-gray-900">Sobre</a>
                <a href="{{ url('/#contato') }}" class="block transition hover:text-gray-900">Contato</a>
            </nav>
        </div>

        <div>
            <h2 class="text-sm font-semibold text-gray-900">Conta e informações</h2>
            <nav class="mt-4 space-y-3 text-sm text-gray-500" aria-label="Conta e informações legais">
                <a href="#" aria-disabled="true" class="block transition hover:text-gray-900">Entrar</a>
                <a href="#" aria-disabled="true" class="block transition hover:text-gray-900">Criar conta</a>
                <a href="#" aria-disabled="true" class="block transition hover:text-gray-900">Termos de uso</a>
                <a href="#" aria-disabled="true" class="block transition hover:text-gray-900">Política de privacidade</a>
            </nav>
        </div>
    </div>

    <div class="border-t border-gray-100">
        <div class="mx-auto max-w-7xl px-4 py-5 text-xs text-gray-400 sm:px-6 lg:px-8">
            © {{ date('Y') }} Nexora. Todos os direitos reservados.
        </div>
    </div>
</footer>
