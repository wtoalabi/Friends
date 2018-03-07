@component('layouts.main')
@slot('title')
 Reset Your Password
@endslot
<div class="columns is-centered">
    <div class="message is-link mt-7 column is-6 is-centered">
        <div class="message-body">
            <div class="title has-text-centered">Reset Password</div>
                @if (session('status'))
                    <p class="notification is-primary">
                        {{ session('status') }}
                    </p>
                @endif
                <form class="control" method="POST" action="{{ route('password.email') }}">
                    {{ csrf_field() }}
                    <div class="field is-grouped">
                        <p class="control is-expanded">
                            <input name="email" id="email" type="email" class="input {{$errors->has('email') ? 'is-danger' : ''}}" type="text" placeholder="Fill in your Email Address" value="{{ old('email') }}" required>
                        </p>
                        <p class="control">
                            <button type="submit" class="button is-info">Submit</button>
                        </p>
                    </div>
                    @if ($errors->has('email'))
                        <p class="help is-danger">
                            <strong>{{ $errors->first('email') }}</strong>
                        </p>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endcomponent