<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Alprisma Tours</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html { scroll-behavior: smooth; }

        
        .portada {
            min-height: 100vh;
            background:
                linear-gradient(90deg, rgba(8, 47, 43, 0.88) 0%, rgba(15, 118, 110, 0.55) 42%, rgba(0, 0, 0, 0.05) 100%),
                url('/img/portada.jpg') center / cover no-repeat;
            color: #fff;
            display: flex;
            flex-direction: column;
        }

        .portada .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: #fff;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.5);
        }

        .portada-contenido {
            flex: 1;
            display: flex;
            align-items: flex-end;
            padding-bottom: 2.5rem;
        }

        .portada h1 {
            font-size: clamp(2.2rem, 4.5vw, 3.8rem);
            font-weight: 800;
            line-height: 1.1;
            text-shadow: 0 3px 14px rgba(0, 0, 0, 0.55);
        }

        .portada p.lead {
            font-size: 1.5rem;
            font-weight: 600;
            opacity: 1;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.45);
        }

        .btn-ingresar,
        .btn-registro,
        .btn-claro {
            border: none;
            border-radius: 50rem;
            padding: 0.75rem 2rem;
            font-weight: 600;
            transition: transform 0.15s ease, box-shadow 0.15s ease;
        }
        .btn-ingresar { background: #fff; color: #0f766e; }
        .btn-registro { background: linear-gradient(135deg, #f59e0b, #f97316); color: #fff; }
        .btn-claro {
            background: rgba(0, 0, 0, 0.25);
            color: #fff;
            border: 2px solid #fff;
            padding: 0.5rem 1.4rem;
        }
        .btn-ingresar:hover,
        .btn-registro:hover,
        .btn-claro:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.35);
        }
        .btn-ingresar:hover { color: #0f766e; background: #fff; }
        .btn-registro:hover { color: #fff; }
        .btn-claro:hover { background: #fff; color: #0f766e; }

        .enlace-abajo {
            color: #fff;
            text-decoration: none;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.6);
        }

        .ventajas { padding: 5rem 0; background: #f8f9fa; }
        .ventaja {
            border: none;
            border-top: 5px solid #0f766e;
            border-radius: 1rem;
            transition: transform 0.2s ease;
        }
        .ventaja:hover { transform: translateY(-6px); }
        .ventaja .icono {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            background: #ccfbf1;
            margin: 0 auto 1rem;
        }

        .pie { background: #134e4a; color: #fff; padding: 1.5rem 0; }
    </style>
</head>
<body>

<section class="portada">
    <nav class="navbar navbar-expand-lg py-3">
        <div class="container">
            <a class="navbar-brand" href="/">Alprisma Tours</a>
            <div class="ms-auto d-flex gap-2">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-claro">Ir al panel</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-claro">Iniciar sesión</a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="portada-contenido">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h1 class="mb-3">Descubre Guatemala y reserva tu próxima aventura</h1>
                    <p class="lead mb-4">
                        Elige tu destino, consulta los paquetes disponibles y reserva en pocos pasos.
                    </p>

                    @auth
                        <a href="{{ route('catalogo') }}" class="btn btn-ingresar btn-lg">Ver paquetes</a>
                    @else
                        <div class="d-flex flex-wrap gap-3">
                            <a href="{{ route('login') }}" class="btn btn-ingresar btn-lg">Iniciar sesión</a>
                            <a href="{{ route('register') }}" class="btn btn-registro btn-lg">Registrarse</a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <div class="text-center pb-3">
        <a href="#ventajas" class="enlace-abajo">Conoce más ↓</a>
    </div>
</section>

<section class="ventajas" id="ventajas">
    <div class="container">
        <h2 class="text-center fw-bold mb-5" style="color: #0f766e;">¿Por qué reservar con nosotros?</h2>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card ventaja shadow-sm h-100 text-center p-4">
                    <div class="icono">🌋</div>
                    <h5 class="fw-bold">Destinos únicos</h5>
                    <p class="text-muted mb-0">Antigua, Atitlán, Tikal, Semuc Champey y más lugares por descubrir.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card ventaja shadow-sm h-100 text-center p-4">
                    <div class="icono">🎫</div>
                    <h5 class="fw-bold">Reserva fácil</h5>
                    <p class="text-muted mb-0">Escoge un paquete, indica cuántas personas viajan y confirma al instante.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card ventaja shadow-sm h-100 text-center p-4">
                    <div class="icono">✅</div>
                    <h5 class="fw-bold">Cupos al día</h5>
                    <p class="text-muted mb-0">Ves cuántos lugares quedan, y si cancelas, el cupo se devuelve.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="pie text-center">
    <div class="container">
        <small>© {{ date('Y') }} Alprisma Tours. Todos los derechos reservados.</small>
        <br>
        
    </div>
</footer>

</body>
</html>