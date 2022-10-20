@props(['route'])

@if (request()->routeIs($route))
    <li class="nav-item border-bottom border-2 border-primary mx-2">
        <a class="nav-link active fw-bolder" href="{{ route($route) }}">{{ $slot }}</a>
    </li>
@else
    <li class="nav-item mx-2">
        <a class="nav-link" href="{{ route($route) }}">{{ $slot }}</a>
    </li>
@endif
