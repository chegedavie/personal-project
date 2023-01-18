<!DOCTYPE html>
<html>
    <head>
        <title>Test post things</title>
    </head>
    <body>
        <form method="POST" action="/api/blog/tag/add">
            @csrf
            <input name="blog_id" placeholder='blog id'/>
            <input name="tag_id" placeholder='tag id'/>
         
            <!-- Equivalent to... -->
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <button type='submit'>submit</button>
        </form>
    </body>
</html>