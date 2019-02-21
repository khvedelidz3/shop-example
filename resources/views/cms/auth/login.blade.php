<!doctype html>
<html lang="en">
@include('cms.partials.header')
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 pt-5">
            <div class="card">
                <div class="card-header text-center">{{ __('Admin') }}</div>

                <div class="card-body">
                    <form method="POST" action="/admin/login">
                        @csrf

                        <div class="form-group row">
                            <label for="email"
                                   class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email"
                                       class="form-control"
                                       name="email" value="{{ old('email') }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                       class="form-control"
                                       name="password" required>

                            </div>
                            @if($errors->has('verificationError'))
                                <div class="col-md-4"></div>
                                <div class="text-danger col-md-6 pr-0">
                                    {{$errors->first('verificationError')}}
                                </div>
                            @endif
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('cms.partials.footer')
</body>
</html>