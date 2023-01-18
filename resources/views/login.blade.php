<!DOCTYPE html>
<html>
    <head>
        <title>Test post things</title>
    </head>
    <body>
        <form method="POST" action="/login">
            @csrf
            <input name="email" placeholder='blog id'/>
            <input name="password" placeholder='tag id'/>
         
            <!-- Equivalent to... -->
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <button type='submit'>submit</button>
        </form>
    </body>
</html>