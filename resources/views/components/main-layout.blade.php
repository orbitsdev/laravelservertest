<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles

        <wireui:scripts />
        <script src="//unpkg.com/alpinejs" defer></script>

        <style>

            .lp{
                display: flex;
                justify-content: center;
                align-items: center          
            }
            .lds-dual-ring {
  display: inline-block;
  width: 80px;
  height: 80px;
}
.lds-dual-ring:after {
  content: " ";
  display: block;
  width: 64px;
  height: 64px;
  margin: 8px;
  border-radius: 50%;
  border: 6px solid #0F6EFF;
  border-color: #0F6EFF transparent #0F6EFF transparent;
  animation: lds-dual-ring 1.2s linear infinite;
}
@keyframes lds-dual-ring {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

        </style>
    </head>
    <body class="font-sans antialiased">

        <div class="min-h-screen bg-gray-50">  

            
    
            <main class="p-8">
                {{ $slot }}
            </main>
        </div>  


        <script>
            // document.addEventListener('DOMContentLoaded', function() {
            //     Livewire.on('showSuccess', postId => {
            //         alert('A post was added with the id of: ' + postId);
            //     });
            // });
        </script>

        @stack('modals')

        @livewireScripts
    </body>
</html>
