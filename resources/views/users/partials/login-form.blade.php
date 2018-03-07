<div class="message is-link">
        <div class="message-body ">
            <div class="title has-text-centered">Login</div>
                <div class="control">
                    <form class="control" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="field">
                            <label for="email" class="label">E-Mail Address</label>
                            <div class="control has-icons-left has-icons-right">
                                <input id="email" placeholder="test@test.com"type="email" class="input {{ $errors->has('email') ? 'is-danger' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
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
                        <div class="columns is-centered is-mobile">
                                        <div class="control column">
                                            <button type="submit" class="button is-link">
                                                Login
                                            </button>
                                        </div>
                                        <div class="column">    
                                            <a class="button is-danger ml-5" href="{{ route('password.request') }}">
                                                    Forgot Your Password?
                                            </a>
                                        </div>
                        </div>
                    </form>
                </div>
        </div>
    </div>