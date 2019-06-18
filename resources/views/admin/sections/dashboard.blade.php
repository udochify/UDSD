<?php
$showReg = $showLogin = "";
if(session('can_register', 'no') == 'yes')
{
	$showLogin = 'style=display:none';
} 
else 
{
	$showReg = 'style=display:none';
}
?>
<div id="login">
@if(!$loggedin)
	<form class="form-horizontal" method="POST" action="{{ route('admin.login') }}" {{ $showLogin }}>
		{{ csrf_field() }}

		<div class="form-col first-col">
			<div class="email-row form-row form-row-up">
				<span>
					<input class="inputTxt authTxt" id="email" type="email" class="form-control" name="email" value="{{ old('email', 'username or email') }}" required autofocus>
				</span>
			</div>
			<div class="password-row form-row form-row-down">
				<span>
					<input class="inputTxt authTxt" id="password" type="password" class="form-control" name="password" value="password" required>
				<span>
			</div>
		</div>

		<div class="form-col second-col">
			<div class="rem-row form-row form-row-up">
				<span>
					<label>
						<input class="checkbox" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
						<span id="checkLabel">Remember Me</span>
					</label>
				</span>	
			</div>
			<div class="btn-row form-row form-row-down">
				<span>
					<button type="submit" class="sBtn btn-primary">
						Enter
					</button>
				</span>	
			</div>
		</div>
	</form>
	<div class="form-col last-col">
		<div id="signup" class="signup-row form-row form-row-up">
			<span>
				<a id="signup" href="{{ route('admin.register.show') }}" {{ $showReg }}>
					sign&nbsp;up!
				</a>
			</span>
		</div>
		<div id="forgot" class="forgot-row form-row form-row-down" {{ $showLogin }}>
			<span>
				<a id="password-forget" href="{{ route('password.request') }}">
					Forgot Your Password?
				</a>
			</span>
		</div>
	</div>
	<div class="form-col{{ $errors->has('email')||$errors->has('password') ? ' has-error' : '' }}">
		<div class="form-row form-row-up">
		@if ($errors->has('password'))
			<span class="help-block">
				<strong>{{ $errors->first('password') }}</strong>
			</span>
		@endif
		</div>
		<div class="form-row form-row-down">
		@if ($errors->has('email'))
			<span class="help-block">
				<strong>{{ $errors->first('email') }}</strong>
			</span>
		@endif
		</div>
	</div>
@endif
	<form style="position:relative" class="welcome-form form-horizontal" method="POST" action="{{ route('admin.logout') }}">
		{{ csrf_field() }}
		<div class="welcome-col form-col">
			<div class="welcome-row form-row form-row-down">
				@if($loggedin)
				<span>
					Welcome.&nbsp;You&nbsp;are&nbsp;logged&nbsp;in&nbsp;as&nbsp;<strong id="uname">{{ $uname }}</strong>
				</span>@endif&nbsp;<span>
					<button type="submit" class="sBtn btn-primary">
						Logout
					</button>
				</span>
			</div>
		</div>
	</form>
</div>