window.addEventListener("DOMContentLoaded", function () {
    window.paypal
    .Buttons({
        style: {
            shape: "rect",
            layout: "vertical",
            color: "gold",
            label: "paypal",
        },
        createOrder(data, actions) {
            var costoNivel = localStorage.getItem('costoNivel');
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: costoNivel
                    }
                }]
            });
        },
        onApprove(data, actions) {
            return actions.order.capture().then(function (orderData) {
                console.log(orderData)
            });
        },
    })
    .render("#paypal-button-container");

    
    
    const cursoCompleto = document.getElementById('fullCourseCheckbox');
    const nivelIndividual = document.getElementById('individualLevelsCheckbox');
    var nivelSelec = document.getElementById('levelSelect');
    cursoCompleto.addEventListener('click', function () {
        if(cursoCompleto.checked){
            cuadro.style = "display: block";
            nivelSelec.selectedIndex = 0;
        }
    });
   

    const cuadro = document.getElementById("paypal-button-container");
    
    nivelSelec.addEventListener('change', function () {
        if (nivelSelec.value !== '--Selecciona un nivel--') {
           cuadro.style = "display: block";
        }
    });

    nivelIndividual.addEventListener('click', function () {
        if(nivelIndividual.checked){
            if(nivelSelec.value !== '--Selecciona un nivel--'){
                cuadro.style = "display: block";
            }else{
                const precioHtml = document.getElementById('pago-contenido');
                precioHtml.innerHTML = '';
                cuadro.style = "display: none";
            }
        }
    });

});
