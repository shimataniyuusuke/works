const elements = stripe.elements();
const cardElement = elements.create('card');
cardElement.mount('#card-element');

const cardHolderName = document.getElementById('card-holder-name');
const cardButton = document.getElementById('card-button');

cardButton.addEventListener('click', async (e) => {
    console.log(cardHolderName.value)
});

stripe
    .confirmCardSetup('{SETUP_INTENT_CLIENT_SECRET}', {
        payment_method: {
            card: cardElement,
            billing_details: {
                name: 'shimatani',
            },
        },
    })
    .then(function(result) {
        // Handle result.error or result.setupIntent
    });
