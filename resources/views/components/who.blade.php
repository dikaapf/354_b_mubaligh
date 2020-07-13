@if(Auth::guard('web')->check())
<p class="text-success">Anda login sebagai <strong>User</strong> </p>
@else
<p class="text-danger">Anda logout sebagai <strong>User</strong> </p>

@endif

@if(Auth::guard('admin')->check())
<p class="text-success">Anda login sebagai <strong>Admin</strong> </p>
@else
<p class="text-danger">Anda logout sebagai <strong>Admin</strong> <a href="<?= route('admin.login') ?>">LOGIN ADMIN</a> </p>

@endif

