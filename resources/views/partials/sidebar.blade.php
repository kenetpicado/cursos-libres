<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bolder" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                <x-sidebar-item route="cursos">Cursos</x-sidebar-item>
                <x-sidebar-item route="docentes">Docentes</x-sidebar-item>
                <x-sidebar-item route="grupos">Grupos</x-sidebar-item>
                <x-sidebar-item route="alumnos">Alumnos</x-sidebar-item>
                <x-sidebar-item route="pagos">Pagos</x-sidebar-item>
            </ul>
        </div>
    </div>
</nav>