<x-mail::message>
# Thanks for your mesage

**Hello sir**
<x-mail::panel>
I have received your message and I will get back to you as fast as possible. In the meantime, you can check out my blog at [blog]({{ config('app.FRONTEND_URL').'/blog' }}) or check out posts below.
</x-mail::panel>

<x-mail::button :url="'http://localhost:3000/blog'">
Back to blog
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
