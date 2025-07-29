@component('mail::message')
# Halo!

Anda menerima email ini karena kami menerima permintaan reset kata sandi untuk akun Anda.

@component('mail::button', ['url' => $url])
Reset Kata Sandi
@endcomponent

Tautan reset kata sandi ini akan kedaluwarsa dalam {{ $expire }} menit.

Jika Anda tidak meminta reset kata sandi, tidak perlu melakukan tindakan lebih lanjut.

Jika mengalami kesulitan mengklik tombol di atas, salin dan tempel URL berikut di browser Anda: {{ $url }}

Hormat kami,  
{{ $appName }}
@endcomponent
