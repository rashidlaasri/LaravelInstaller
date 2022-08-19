@component('mail::message')
    <h2>Hi Admin.</h2>
    <p>Congratulations, for successful installation.</p>
    <p>Click the link below to log in to admin panel and start creating services.</p>
    @component('vendor.mail.html.button', ['url' => url('ch-admin')])
        Admin Panel
    @endcomponent
    <p>Thanks so much for using our application to provide amazing services. We appreciate you becoming a part of our community.</p>
    Regards,<br>
    {{setting('app.name', 'ChargePanda')}}.
@endcomponent