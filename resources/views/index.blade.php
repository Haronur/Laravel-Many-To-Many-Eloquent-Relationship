<html>
<head>
   
</head>
<style>
 
 
</style>
<body>
 
<h1> Laravel Many to Many Example </h1>
<h2> User 1 (John) is playing below Roles

@if ($user->roles->count() > 0)

  <ul>

  @foreach($user->roles as $records)

    <li>{{ $records->role_name }}</li>

  @endforeach

  </ul>

@endif

<h2> Role 3 (Reader) is played by below Users

@if ($role->users->count() > 0)

  <ul>

  @foreach($role->users as $records)

    <li>{{ $records->name }}</li>

  @endforeach

  </ul>

@endif

</body>
</html>