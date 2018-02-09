@component('layouts.main')
@slot('title')
 Login Page
@endslot
    <div class="message is-link mt-7">
        <div class="message-body ">
            <div class="title">Login</div>
                <div class="control">
                    <form class="control" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="field">
                            <label for="email" class="label">E-Mail Address</label>
                            <div class="control has-icons-left has-icons-right">
                                <input id="email" placeholder="Email Address"type="email" class="input {{ $errors->has('email') ? 'is-danger' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                                <span class="icon is-small is-left">
                                    <i class="fa fa-envelope"></i>
                                </span>
                                @if ($errors->has('email'))
                                    <span class="icon is-small is-right">
                                        <i class="fa fa-warning"></i>
                                    </span>
                                    <span class="help is-danger">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="field">
                            <label for="password" class="label">Password</label>
                            <div class="control has-icons-left">
                                <input id="password" placeholder="Password"type="password" class="input {{ $errors->has('password') ? ' has-error' : '' }}" name="password" required>
                                    <span class="icon is-small is-left">
                                        <i class="fa fa-envelope"></i>
                                    </span>
                                @if ($errors->has('password'))
                                    <span class="help is-danger">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="field">
                            <div class="control">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <div class="columns">
                                <div class="column is-2">
                                    <div class="control">
                                        <button type="submit" class="button is-link">
                                            Login
                                        </button>
                                    </div>
                                </div>
                                <div class="column is-3 is-offset-6">    
                                    <a class="button is-danger ml-5" href="{{ route('password.request') }}">
                                        Forgot Your Password?
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
    </div>
@endcomponent