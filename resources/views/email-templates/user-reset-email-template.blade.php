<!DOCTYPE html>
<html>

<p> Dear {{ $user->name }} </p>
<p>
    Your password on Tracer Study JTIK system was changed successfully.
    Here is your new login credentials:
    <br>
    <b>Login ID: </b>{{ $user->username }} or {{ $user->email }}
    <br>
    <b>Password: </b>{{ $new_password }}
</p>
<br>
Please, keep your credentials confidential. Your username and password are your own credentials and you should
never share them with anybody else.

</html>
