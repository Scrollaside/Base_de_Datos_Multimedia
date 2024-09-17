window.paypal
    .Buttons({
        style: {
            shape: "rect",
            layout: "vertical",
            color: "gold",
            label: "paypal",
        },
        message: {
            amount: 100,
        } ,

        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: 50
                    }
                }]
            });
        },
        onApprove(data, actions) {
            return actions.order.capture().then(function(detalles){
                console.log(detalles)
            });
        },
    })
    .render("#paypal-button-container");