@component('mail::message')
# 感谢注册

欢迎来到ManCaveKeeper! 请点击一下按钮激活您的账号：

@component('mail::button', ['url' => 'http://localhost:4200/register/confirmation?token='.$token])
激活账号
@endcomponent

谢谢,<br>
{{ config('app.name') }}
@endcomponent
