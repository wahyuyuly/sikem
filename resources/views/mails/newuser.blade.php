@component('mail::message')
Hi **{{$name}}**,  {{-- use double space for line break --}}   
Anda menerima email ini karena telah mendaftar pada Aplikasi Sistem Administrasi Kemahasiswaan dan Alumni Politeknik Kesehatan Negeri Tanjung Karang.  

Saat ini akun anda masih dalam tahap peninjauan oleh petugas, mohon hubungi petugas Kemahasiswaan jika anda mengalami kendala.

Berikut infromasi akun anda :  

**Username :** {{$username}}  
**Email :** {{$email}}  
**Password :** {{$password}}  

Anda bisa login melalui tautan berikut :
@component('mail::button', ['url' => $url])
Login
@endcomponent

Jika anda merasa tidak pernah mendaftar, mohon abaikan email ini.


Terima kasih,      

Bagian Kemahasiswaan  
Politeknik Kesehatan Tanjung Karang
@endcomponent