
 {{--
  @author: RonTea
  Website: https://live-rontea.pantheonsite.io/
  Version: 0
  Date: July, 07, 2023
  File: resources\views\components\partials\auth\two-factorauth.blade.php
 --}}

@auth
    <div class="card mx-auto">
        <div class="card-body">
            <p class="card-text">
                @if (! auth()->user()->two_factor_secret)
                    You have not set 2fa

                <form method="POST" action="{{ url('user/two-factor-authentication') }}">
                    @csrf
                    <div class="d-flex flex-row-start">
                        <div class="me-2">
                            <button type="submit"
                             class="btn btn-primary mb-3">
                             Enable
                            </button>
                        </div>
                    </div>

                </form>
                @else
                    You have 2fa enabled
                    <form method="POST" action="{{ url('user/two-factor-authentication') }}">
                        @csrf
                        @method('DELETE')
                        <div class="d-flex flex-row-start">
                            <div class="me-2">
                                <button type="submit"
                                    class="btn btn-primary mb-3">
                                    Disable
                                </button>
                            </div>
                        </div>

                    </form>
                    @if (!session('status') == 'two-factor-authentication-confirmed')

                        <x-partials.auth.two-factor-confirmationform />
                    @else
                    2FA is verified :{{auth()->user()->two_factor_confirmed_at}}
                    @endif

                @endif




            </p>
                @if(session('status') == 'two-factor-authentication-enabled')
                <p> You have now enabled 2fa, please scan the following
                    QR Code into your phone authenticator application
                </p>
                {{!! auth()->user()->twoFactorQRCodeSvg() !!}}
                <p> Please store this recovery key in a secure location </p>
                    @foreach ( json_decode(
                        decrypt(
                            auth()->user()->two_factor_recovery_codes,
                            true
                        )
                    ) as $code)

                        {{ trim($code) }} <br>

                    @endforeach

                @endif
        </div>
    </div>

@endauth
