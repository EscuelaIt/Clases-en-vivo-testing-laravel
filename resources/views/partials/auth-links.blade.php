@guest
<nav class="flex justify-end space-x-4 p-4 bg-white">
    <a href="{{ route('login') }}" class="px-4 py-2 text-indigo-600 hover:text-indigo-800 font-medium transition">
        Iniciar sesión
    </a>

    <a href="{{ route('register') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">
        Registrarse
    </a>
</nav>
@endguest
