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
