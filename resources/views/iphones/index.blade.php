@extends('layouts.app')

@section('title', 'iPhone - iStore')

@section('content')

    @php
        // Equipo que se muestra en el banner principal: el primero marcado como "Nuevo"
        $destacado = $iphones->firstWhere('nuevo', true) ?? $iphones->first();
    @endphp

    <div class="container">
        <h1 class="page-title">iPhone</h1>

        @if($iphones->isNotEmpty())
            {{-- Accesos rápidos a cada modelo --}}
            <nav class="model-strip" aria-label="Modelos de iPhone">
                @foreach($iphones as $iphone)
                    <a class="model-strip__item" href="#modelo-{{ $iphone->id }}">
                        <span class="model-strip__icon">@include('iphones.partials.phone', ['tipo' => 'icono'])</span>
                        <span class="model-strip__name">{{ $iphone->modelo }}</span>
                        @if($iphone->nuevo)
                            <span class="badge">Nuevo</span>
                        @endif
                    </a>
                @endforeach
            </nav>

            {{-- Banner principal --}}
            <section class="hero" aria-labelledby="hero-titulo">
                <div class="hero__top">
                    <div>
                        <h2 id="hero-titulo" class="hero__title">{{ $destacado->modelo }}</h2>
                        <p class="hero__text">{{ $destacado->descripcion }}</p>
                    </div>
                    <a class="btn" href="#modelo-{{ $destacado->id }}">Más información</a>
                </div>
                <div class="hero__visual">
                    @include('iphones.partials.phone', ['iphone' => $destacado, 'tipo' => 'foto'])
                </div>
            </section>
        @endif
    </div>

    {{-- Catálogo --}}
    <section class="family" id="familia" aria-labelledby="familia-titulo">
        <div class="container family__head">
            <h2 id="familia-titulo" class="family__title">Conoce a la familia.</h2>
            @if($iphones->isNotEmpty())
                <div class="family__arrows">
                    <button type="button" class="arrow" data-carousel="prev" aria-label="Anterior">&#8249;</button>
                    <button type="button" class="arrow" data-carousel="next" aria-label="Siguiente">&#8250;</button>
                </div>
            @endif
        </div>

        @if($iphones->isEmpty())
            <div class="container">
                <p class="empty">No hay iPhones disponibles por ahora. Vuelve pronto.</p>
            </div>
        @else
            <div class="carousel" id="carousel">
                @foreach($iphones as $iphone)
                    @php $agotado = $iphone->stock < 1; @endphp

                    <article class="card" id="modelo-{{ $iphone->id }}" style="--c: {{ $iphone->color_hex }}">
                        <div class="card__media">
                            @include('iphones.partials.phone', ['tipo' => 'foto'])
                        </div>

                        <div class="card__dots">
                            <span class="dot" title="{{ $iphone->color }}"></span>
                        </div>

                        <div class="card__body">
                            @if($iphone->nuevo)
                                <p class="badge">Nuevo</p>
                            @endif
                            <h3 class="card__name">{{ $iphone->modelo }}</h3>
                            <p class="card__desc">{{ $iphone->descripcion }}</p>
                            <p class="card__spec">{{ $iphone->almacenamiento }} en {{ $iphone->color }}</p>
                            <p class="card__price">${{ number_format($iphone->precio, 2) }}</p>

                            @if($agotado)
                                <p class="card__stock card__stock--out">Agotado</p>
                            @elseif($iphone->stock <= 3)
                                <p class="card__stock card__stock--low">Quedan {{ $iphone->stock }}</p>
                            @else
                                <p class="card__stock">Disponible</p>
                            @endif

                            <form action="{{ route('iphones.comprar', $iphone->id) }}" method="POST" class="buy">
                                @csrf
                                <label class="buy__qty">
                                    <span class="sr-only">Cantidad</span>
                                    <select name="cantidad" @disabled($agotado)>
                                        @for($i = 1; $i <= min($iphone->stock, 5); $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                        @if($agotado)
                                            <option>0</option>
                                        @endif
                                    </select>
                                </label>
                                <button type="submit" class="btn" @disabled($agotado)>Comprar</button>
                            </form>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </section>

@endsection
