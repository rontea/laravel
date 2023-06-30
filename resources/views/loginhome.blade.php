 {{--
  @author: RonTea
  Website: https://live-rontea.pantheonsite.io/
  Version: 0
  Date: June, 30, 2023
  File: resources\views\loginhome.blade.php
 --}}

<x-default>
    {{-- Header --}}

    <x-layout.header>

    </x-layout.header>


    @auth
        {{-- session on --}}
        <x-layout.login.loginhome>

        </x-layout.login.loginhome>
        <x-layout.login.logout>

        </x-layout.login.logout>
    @endauth
    @guest
                 {{-- session off --}}
                 <x-layout.login>

                 </x-layout.login>

    @endguest


    {{-- Footer --}}
    <x-layout.footer>
    </x-layout.footer>
</x-default>
