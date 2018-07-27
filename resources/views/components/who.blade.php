@if(Auth::guard('web')->check())
<p class="text-success">Your are logged in as a <strong>USER</strong></p>
@else
<p class="text-danger">You are logged out as a <strong>User</strong></p>
@endif

@if(Auth::guard('admin')->check())
<p class="text-success">Your are logged in as a <strong>ADMIN</strong></p>
@else
<p class="text-danger">You are logged out as a <strong>ADMIN</strong></p>
@endif

