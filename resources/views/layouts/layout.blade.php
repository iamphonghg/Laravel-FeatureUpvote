<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <title>Document</title>
        <style>
            * {
                font-family: JetBrains Mono;
            }

        </style>
    </head>
    <body>
        <main>
            <section class="header">
                <div class="container-fluid bg-dark">
                    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4">
                        <a href="/boards/{{ $board }}" class="h3 text-light ms-5 text-decoration-none">{{ $board }} User Suggestions</a>
                    </header>
                </div>
            </section>
            @yield('content')
        </main>
    </body>
</html>
