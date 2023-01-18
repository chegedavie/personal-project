<x-mail::message>
# Incoming message!

Hey, David

You have received the following email from {{ $message->firstname.' '.$message->lastname }} on {{ $message->created_at }}. Kindly reach out as soon as you can.

<x-mail::panel>
Subject: {{ $message->subject }}

message: {{ $message->message }}
</x-mail::panel>

Regards,<br>
{{ config('app.name') }}
</x-mail::message>
