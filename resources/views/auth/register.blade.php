@extends('layouts.app')

@section('content')
<link href="{{ asset('css/register.css') }}" rel="stylesheet">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Name -->
                        <div>
                            <label for="name">Name</label>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
                            @error('name')
                                <span>{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email">Email</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <span>{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password">Password</label>
                            <input id="password" type="password" name="password" required>
                            @error('password')
                                <span>{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation">Confirm Password</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" required>
                            @error('password_confirmation')
                                <span>{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Staff -->
                        <div>
                            <label for="staff_id">Staff</label>
                            <select id="staff_id" name="staff_id" required>
                                <option value="">Select a staff</option>
                                @foreach(App\Models\Staff::all() as $staff)
                                    <option value="{{ $staff->staff_id }}" {{ old('staff_id') == $staff->staff_id ? 'selected' : '' }}>
                                        {{ $staff->name_staff }}
                                    </option>
                                @endforeach
                            </select>
                            @error('staff_id')
                                <span>{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <button type="submit">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
