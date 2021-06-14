@extends('layouts.app')

@section('head')
    <script src="https://js.stripe.com/v3/"></script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-8">
            <h1 class="text-center mb-4">Abonnements</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if ($plans->count())

            <form method="post" id="payment-form">
                @csrf

                <h5>Choisissez votre abonnement</h4>

                @foreach ($plans as $plan)
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="plan" id="plan{{ $plan->id }}" value="{{ $plan->id }}">
                  <label class="form-check-label" for="plan{{ $plan->id }}">
                    Abonnement {{ $plan->name }} ({{ number_format($plan->price / 100, 2, ',', ' ') }} €)
                  </label>
                </div>
                @endforeach

                  <div class="my-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name">
                  </div>

                  <div id="card-element" class="mt-4"></div>

                <div class="text-danger" id="card-errors" role="alert" class="mb-4"></div>

                 <div class="my-3">
                    <label for="coupon" class="form-label">Code promo</label>
                    <input type="text" class="form-control" id="coupon" name="coupon">
                  </div>
                  
                  <button type="submit" class="btn btn-primary mt-4" id="card-button" data-secret="{{ $intent->client_secret }}">Payer maintenant</button>
                </form>

                @else

                <p>Aucun abonnement disponible.</p>

                @endif
        </div>
    </div>
</div>

<script>
    const stripe = Stripe('{{ $stripeKey }}');
    const elements = stripe.elements();

    const card = elements.create("card");
    card.mount("#card-element");

    const cardHolderName = document.getElementById('name');
    const cardButton = document.getElementById('card-button');
    const clientSecret = cardButton.dataset.secret;

    card.on('change', ({error}) => {
      let displayError = document.getElementById('card-errors');
      if (error) {
        displayError.textContent = error.message;
      } else {
        displayError.textContent = '';
      }
    });

    const form = document.getElementById('payment-form');

form.addEventListener('submit', async (e) => {
  e.preventDefault();

  let displayError = document.getElementById('card-errors');

   const { setupIntent, error } = await stripe.confirmCardSetup(
        clientSecret, {
            payment_method: {
                card: card,
                billing_details: { name: cardHolderName.value }
            }
        }
    );

    if (error) {
        displayError.textContent = error.message;
    } else {
        displayError.textContent = '';
        //console.log(setupIntent);
        
        let paymentMethod = document.createElement('input');
        paymentMethod.setAttribute('type', 'hidden');
        paymentMethod.setAttribute('name', 'payment_method');
        paymentMethod.value = setupIntent.payment_method;

        form.appendChild(paymentMethod);
        form.submit();
    }
});

</script>
    
@endsection
