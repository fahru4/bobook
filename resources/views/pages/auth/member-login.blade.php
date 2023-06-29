@extends('components.login')

<div class="container">
    <div class="row justify-content-center p-5">
        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Hallo Member!</h1>
                                </div>
                                <form method="POST" action="{{ route('member-login') }}" class="user">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">Username</label>

                                        <input id="username" type="text"
                                            class="form-control form-control-user @error('username') is-invalid @enderror"
                                            name="username" value="{{ old('username') }}" required placeholder="Enter Username..."
                                            autocomplete="username" autofocus>

                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">Password</label>

                                        <input id="password" type="password"
                                            class="form-control form-control-user @error('password') is-invalid @enderror"
                                            name="password" value="{{ old('password') }}" required placeholder="Enter Password..."
                                            autocomplete="password" autofocus>

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Login
                                    </button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
