<div class="message is-link mt-7">
        <div class="message-body ">
            <div class="title">Register</div>
                <div class="control">
                    <form class="control" method="POST" action="{{ route('accounts.store') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="columns">
                            <div class="field column is-6">
                                <label for="first_name" class="label">Your First Name</label>
                                <div class="control has-icons-left has-icons-right">
                                    <input id="first_name" placeholder="First Name" type="text" class="input {{ $errors->has('first_name') ? 'is-danger' : '' }}" name="first_name" value="{{ old('first_name') }}" required autofocus>
                                    <span class="icon is-small is-left">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    @if ($errors->has('first_name'))
                                    <span class="icon is-small is-right">
                                        <i class="fa fa-warning"></i>
                                        </span>
                                        <span class="help is-danger">
                                            <strong>{{ $errors->first('first_name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="field column is-6">
                                    <label for="last_name" class="label">Your Last Name</label>
                                    <div class="control has-icons-left has-icons-right">
                                        <input id="name" placeholder="Last Name"type="text" class="input {{ $errors->has('last_name') ? 'is-danger' : '' }}" name="last_name" value="{{ old('last_name') }}" required autofocus>
                                        <span class="icon is-small is-left">
                                            <i class="fa fa-user"></i>
                                        </span>
                                        @if ($errors->has('last_name'))
                                        <span class="icon is-small is-right">
                                            <i class="fa fa-warning"></i>
                                        </span>
                                        <span class="help is-danger">
                                            <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="columns">
                                <div class="field column is-6">
                                    <label for="username" class="label">Your Username</label>
                                    <div class="control has-icons-left has-icons-right">
                                        <input id="username" placeholder="Your Username"type="text" class="input {{ $errors->has('username') ? 'is-danger' : '' }}" name="username" value="{{ old('username') }}" required autofocus>
                                        <span class="icon is-small is-left">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    @if ($errors->has('username'))
                                    <span class="icon is-small is-right">
                                        <i class="fa fa-warning"></i>
                                        </span>
                                        <span class="help is-danger">
                                            <strong>{{ $errors->first('username') }}</strong>
                                        </span>
                                        @endif
                                </div>
                            </div>
                        
                            <div class="field column is-6">
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
                        </div>
                        <div class="columns">
                            <div class="field column is-6">
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
                            <div class="field column is-6">
                            <label for="password-confirm" class="label">Confirm Password</label>
                            <div class="control has-icons-left">
                                <input id="password-confirm" placeholder="Please Confirm Your Password"type="password" class="input {{ $errors->has('password') ? ' has-error' : '' }}" name="password_confirmation" required>
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
                        </div>
                            <div class="field">
                                <div class="file is-centered is-boxed is-success has-name">
                                    <label class="file-label">
                                    <input placeholder="Please upload your profile image/avatar here"type="file" class="file-input {{ $errors->has('profileImage') ? ' has-error' : '' }}" name="profileImage">
                                    <span class="file-cta">
                                        <span class="file-icon">
                                            <i class="fa fa-upload"></i>
                                        </span>
                                    <span class="file-label">
                                        Upload Profile Image
                                    </span>
                                </span>
                                @if ($errors->has('profileImage'))
                                    <span class="help is-danger">
                                        <strong>{{ $errors->first('profileImage') }}</strong>
                                    </span>
                                @endif   
                            </label>                         
                                </div>
                        </div>
                        <div class="field">
                            <div class="columns is-mobile">
                                <div class="column is-three-quarters-desktop">
                                        <button type="submit" class="button is-link">
                                            Register
                                        </button>
                                </div>
                                <div class="column">    
                                    <a class="button is-danger ml-5" href="{{ route('password.request') }}">
                                        Forgot Password?
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
    </div>