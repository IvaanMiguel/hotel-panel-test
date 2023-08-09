<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{route('register')}}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="name">
        @error('name')
            <p>{{ $message }}</p>
        @enderror
        
        <input type="text" name="email"  placeholder="email">
        @error('email')
            <p>{{ $message }}</p>
        @enderror
        
        <input type="text" name="password" placeholder="password">
        <input type="text" name="password_confirmation" placeholder="password_confirmation">
        @error('password')
            <p>{{ $message }}</p>
        @enderror
        <input type="submit" >
    </form>
</body>
</html>