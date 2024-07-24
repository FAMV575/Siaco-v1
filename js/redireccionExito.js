// Redirección después de 2 segundos (2000 milisegundos)
let countdown = 2;
let countdownElement = document.getElementById('countdown');

function updateCountdown() {
    countdown -= 1;
    countdownElement.textContent = countdown;
    
    if (countdown <= 0) {
        window.location.href = "./"; // Cambia la URL de redirección
    } else {
        setTimeout(updateCountdown, 1000); // Actualiza cada 1 segundo (1000 milisegundos)
    }
}

setTimeout(updateCountdown, 1000); // Inicia el conteo inicial después de 1 segundo (1000 milisegundos)
