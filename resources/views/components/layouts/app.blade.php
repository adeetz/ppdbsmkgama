<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tambahan meta tags untuk prevent back history -->
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>{{ $title ?? 'PPDB SMK GAMA' }}</title>

    <!-- Livewire Styles -->
    @livewireStyles

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    

    <!-- Script untuk prevent back history -->
    <script>
        window.onload = function() {
            if (window.history && window.history.pushState) {
                window.history.pushState('forward', null, '');
                window.addEventListener('popstate', function() {
                    window.history.pushState('forward', null, '');
                });
            }
        }

        // Tambahan untuk mencegah cache di browser
        window.onpageshow = function(event) {
            if (event.persisted) {
                window.location.reload();
            }
        };

        // Mencegah klik kanan
        document.addEventListener('contextmenu', function(e) {
            e.preventDefault();
        });

        // Mencegah keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            if (
                // Mencegah F5
                e.key == 'F5' ||
                // Mencegah Ctrl+R
                (e.ctrlKey && e.key == 'r') ||
                // Mencegah Ctrl+Shift+R
                (e.ctrlKey && e.shiftKey && e.key == 'R')
            ) {
                e.preventDefault();
            }
        });
    </script>

</head>

<body>
    <div class="container">
        <livewire:nav-bar />
        {{ $slot }}
    </div>
    <!-- Livewire Scripts -->
    @livewireScripts

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <!-- Script untuk sweet alert dengan Livewire -->
    <script>
        window.addEventListener('swal:modal', event => {
            Swal.fire({
                title: event.detail.title,
                text: event.detail.text,
                icon: event.detail.type,
            });
        });

        window.addEventListener('swal:confirm', event => {
            Swal.fire({
                title: event.detail.title,
                text: event.detail.text,
                icon: event.detail.type,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.livewire.emit(event.detail.method);
                }
            });
        });
    </script>
</body>

</html>