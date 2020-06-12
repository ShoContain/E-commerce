@component('mail::message')
{{--マークダウンは左揃え--}}
# ご注文ありがとうございます

**ID:** {{ $order->id }} <br>
**お名前:** {{ $order->billing_name }} <br>
**合計請求金額:** {{ presentPrice($order->billing_total) }} <br>


@component('mail::button',['url'=>config('app.url'),'color'=>'green'])
    ホームページに行く
@endcomponent

    この度は弊社をご利用いただき誠にありがとうございました。またのご利用お待ちしております。
@endcomponent
