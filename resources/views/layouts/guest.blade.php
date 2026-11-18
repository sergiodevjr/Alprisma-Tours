<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Alprisma Tours</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                background: linear-gradient(135deg, #0f766e 0%, #14b8a6 55%, #f59e0b 100%);
                min-height: 100vh;
            }
            .tarjeta-login {
                border-top: 6px solid #0f766e;
                border-radius: 1rem;
            }
            /* Botón principal (Log in, Register, etc.) */
            .tarjeta-login button[type="submit"] {
                background-color: #0f766e !important;
                color: #fff !important;
            }
            .tarjeta-login button[type="submit"]:hover {
                background-color: #115e59 !important;
            }
            /* Campos al enfocarlos */
            .tarjeta-login input:focus {
                border-color: #0f766e !important;
                box-shadow: 0 0 0 1px #0f766e !important;
            }
            .tarjeta-login input[type="checkbox"] {
                accent-color: #0f766e;
            }
            /* Enlaces */
            .tarjeta-login a {
                color: #0f766e !important;
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div>
                <a href="/" style="color: #090606 !important; font-size: 2rem; font-weight: 700; text-decoration: none;">
                    Alprisma Tours
                </a>
            </div>

            <div class="tarjeta-login w-full sm:max-w-md mt-6 px-6 py-6 bg-white shadow-xl overflow-hidden">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>