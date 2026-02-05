<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gestor de Tareas')</title>
    <style>
        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f6fa;
            color: #333;
        }

        /* Header */
        .header {
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header__container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header__titulo {
            color: #2c3e50;
            margin-bottom: 15px;
            font-size: 1.8em;
        }

        /* Navegación */
        .nav {
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        .nav__link {
            padding: 12px 24px;
            background: white;
            border: 2px solid #3498db;
            color: #3498db;
            border-radius: 8px;
            text-decoration: none;
            font-size: 1em;
            font-weight: 600;
            transition: all 0.3s;
        }

        .nav__link:hover {
            background: #ecf5ff;
            transform: translateY(-2px);
        }

        .nav__link--activo {
            background: #3498db;
            color: white;
        }

        /* Main */
        .main {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px 20px;
        }

        .pagina {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .pagina__titulo {
            color: #2c3e50;
            margin-bottom: 30px;
            font-size: 2em;
        }

        /* Alertas */
        .alert {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        /* Formulario */
        .formulario {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 40px;
        }

        .formulario__titulo {
            color: #2c3e50;
            margin-bottom: 20px;
            font-size: 1.3em;
        }

        .formulario__label {
            display: block;
            color: #555;
            font-weight: 600;
            margin-bottom: 8px;
            margin-top: 15px;
        }

        .formulario__input,
        .formulario__textarea,
        .formulario__select {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 1em;
            margin-bottom: 15px;
            transition: border-color 0.3s;
        }

        .formulario__input:focus,
        .formulario__textarea:focus,
        .formulario__select:focus {
            outline: none;
            border-color: #3498db;
        }

        .formulario__textarea {
            min-height: 100px;
            resize: vertical;
            font-family: inherit;
        }

        .formulario__color {
            width: 100%;
            height: 60px;
            border: 2px solid #ddd;
            border-radius: 8px;
            cursor: pointer;
            margin-bottom: 15px;
        }

        .formulario__boton {
            width: 100%;
            padding: 14px;
            background: #3498db;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.1em;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
        }

        .formulario__boton:hover {
            background: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(52, 152, 219, 0.3);
        }

        /* Etiquetas checkbox */
        .etiquetas-checkbox {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            padding: 15px;
            background: white;
            border: 2px solid #ddd;
            border-radius: 8px;
            min-height: 60px;
        }

        .etiqueta-checkbox-item {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 20px;
            color: white;
            cursor: pointer;
            transition: all 0.3s;
        }

        .etiqueta-checkbox-item:hover {
            transform: scale(1.05);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        .etiqueta-checkbox-item input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        .etiqueta-checkbox-item label {
            cursor: pointer;
            font-weight: 500;
            margin: 0;
        }

        /* Botones */
        .boton {
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.9em;
            font-weight: 600;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .boton:hover {
            transform: scale(1.05);
        }

        .boton--ver {
            background: #3498db;
            color: white;
        }

        .boton--editar {
            background: #f39c12;
            color: white;
        }

        .boton--eliminar {
            background: #e74c3c;
            color: white;
        }

        /* Mensaje vacío */
        .mensaje-vacio {
            text-align: center;
            color: #7f8c8d;
            padding: 60px 20px;
            font-size: 1.1em;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(3px);
        }

        .modal--activo {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .modal__contenido {
            background: white;
            padding: 30px;
            border-radius: 12px;
            width: 90%;
            max-width: 600px;
            max-height: 80vh;
            overflow-y: auto;
            position: relative;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        }

        .modal__cerrar {
            position: absolute;
            right: 20px;
            top: 15px;
            font-size: 32px;
            cursor: pointer;
            color: #999;
            transition: color 0.3s;
            background: none;
            border: none;
            padding: 0;
        }

        .modal__cerrar:hover {
            color: #333;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .nav {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="header__container">
            <nav class="nav">
                <a href="{{ route('tareas.index') }}" 
                   class="nav__link {{ request()->routeIs('tareas.*') ? 'nav__link--activo' : '' }}">
                    Tareas
                </a>
                <a href="{{ route('categorias.index') }}" 
                   class="nav__link {{ request()->routeIs('categorias.*') ? 'nav__link--activo' : '' }}">
                    Categorías
                </a>
                <a href="{{ route('etiquetas.index') }}" 
                   class="nav__link {{ request()->routeIs('etiquetas.*') ? 'nav__link--activo' : '' }}">
                    Etiquetas
                </a>
            </nav>
        </div>
    </header>

    <main class="main">
        @if(session('success'))
            <div class="alert alert-success">
                ✅ {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                ❌ {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>