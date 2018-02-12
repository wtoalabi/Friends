@component('layouts.main')
@slot('title')
 Signup Page
@endslot
    <div class="message is-link mt-7">
        <div class="message-body ">
            <div class="title">Register</div>
                <div class="control">
                    <form class="control" method="POST" action="{{ route('accounts.store') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="field">
                                <label for="name" class="label">Your Name</label>
                                <div class="control has-icons-left has-icons-right">
                                    <input id="name" placeholder="Your Name in Full"type="text" class="input {{ $errors->has('name') ? 'is-danger' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                                    <span class="icon is-small is-left">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    @if ($errors->has('name'))
                                        <span class="icon is-small is-right">
                                            <i class="fa fa-warning"></i>
                                        </span>
                                        <span class="help is-danger">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
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
                        <div class="field">
                            <label for="profileImage" class="label">Upload Profile Image</label>
                            <div class="control has-icons-left">
                                <input id="profileImage" placeholder="Please upload your profile image/avatar here"type="file" class="input {{ $errors->has('profileImage') ? ' has-error' : '' }}" name="profileImage">
                                    <span class="icon is-small is-left">
                                        <i class="fa fa-camera"></i>
                                    </span>
                                @if ($errors->has('profileImage'))
                                    <span class="help is-danger">
                                        <strong>{{ $errors->first('profileImage') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="field">
                            <div class="columns">
                                <div class="column is-2">
                                    <div class="control">
                                        <button type="submit" class="button is-link">
                                            Click to Register your Account
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