<x-guest-layout>
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="{{ asset('adminlte/index2.html')}}" class="h1"><b>Dapur</b>Rempong</a>
        </div>
        <div class="card-body">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-group mb-3">
                    <x-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus placeholder="Email" />
                    {{-- <input type="email" class="form-control" placeholder="Email"> --}}
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <x-input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" placeholder="Password" />
                    {{-- <input type="password" class="form-control" placeholder="Password"> --}}
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>



                <div class="col-4 float-right">
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </div>


            </form>

        </div>

    </div>

    </div>
</x-guest-layout>
