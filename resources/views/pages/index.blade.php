 {{--
  @author: RonTea
  Website: https://live-rontea.pantheonsite.io/
  Version: 0
  Date: July, 07, 2023
  File: resources\views\pages\index.blade.php
 --}}

 <x-layouts.default>
    {{-- Header --}}

    <x-partials.header.header />


    {{-- session on --}}

    <x-partials.login.logout />

    <x-partials.auth.two-factorauth />


    <x-partials.auth.loginform />


    {{-- Footer --}}
    <x-partials.footer.footer />

</x-layouts.default>
