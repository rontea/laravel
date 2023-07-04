 {{--
  @author: RonTea
  Website: https://live-rontea.pantheonsite.io/
  Version: 0
  Date: June, 30, 2023
  File: resources\views\dashboard.blade.php
 --}}

<x-default>
    {{-- Header --}}

    <x-layout.header>

    </x-layout.header>


    @auth
        {{-- session on --}}
        <x-layout.login.loginhome>

        </x-layout.login.loginhome>

        <x-layout.login.flash />

        <x-layout.login.logout>

        </x-layout.login.logout>
    @else
     {{-- session off --}}
     <x-layout.login>

     </x-layout.login>

    @endauth



    {{-- Footer --}}
    <x-layout.footer>
    </x-layout.footer>
</x-default>
