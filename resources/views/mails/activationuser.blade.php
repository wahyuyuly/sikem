@component('mail::message')
Hi **{{$name}}**,  {{-- use double space for line break --}}   
Selamat permohonan aktivasi akun anda pada Aplikasi Sistem Administrasi Kemahasiswaan dan Alumni Politeknik Kesehatan Negeri Tanjung Karang telah disetujui.  

Berikut infromasi akun anda :  

**Username :** {{$username}}  
**Email :** {{$email}}  
**Password :** {{$password}}  

Anda bisa login melalui tautan berikut :
@component('mail::button', ['url' => $url])
Login
@endcomponent

Terima kasih,      

Bagian Kemahasiswaan  
Politeknik Kesehatan Tanjung Karang
@endcomponent