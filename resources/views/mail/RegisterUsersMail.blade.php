@component('mail::message')
# Congrats {{$user->name}},

<section>
    <p>
        You have successfully registered with MO-AFRICA. Kindly find the attached code as your ID <br>

        <p>
            Code : {{$code}}
        </p>
    </p>

</section>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
