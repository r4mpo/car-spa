<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- JQuery --}}
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
        crossorigin="anonymous"></script>


    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    {{-- Icons --}}
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    {{-- CSS --}}
    <link rel="stylesheet" href="/css/style.css">

    {{-- Icon --}}
    <link rel="shortcut icon" href="/images/blue-car icon.png" type="image/x-icon">

    {{-- Arquivos JavaScript --}}
    <script src="/js/mask/apenas_numeros.js"></script>
    <script src="/js/mask/moedas.js"></script>

    {{-- Sweet Alert --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>CarShop</title>
</head>

<body>

    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="js/materialize.min.js"></script>

    {{-- Trazendo o vue.js para a view --}}
    <div id="app">
        <app></app>
    </div>
    {{-- Importando arquivo JS --}}
    <script src="{{ mix('js/app.js') }}"></script>

</body>

</html>
