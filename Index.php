<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roleta da Sorte</title>
</head>
<body>
  <styles>
    body {
    font-family: Arial, sans-serif;
    text-align: center;
    background: #222;
    color: white;
}

.container {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 50px;
}

input {
    padding: 10px;
    font-size: 16px;
    margin-bottom: 20px;
}

.wheel-container {
    position: relative;
    width: 300px;
    height: 300px;
}

.wheel {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    overflow: hidden;
    position: relative;
    transition: transform 4s ease-out;
}

.wheel img {
    width: 100%;
    height: 100%;
    border-radius: 50%;
}

.pointer {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 40px;
    height: 40px;
    background: black;
    border-radius: 50%;
    z-index: 10;
}

button {
    margin-top: 20px;
    padding: 15px 30px;
    font-size: 20px;
    font-weight: bold;
    border: none;
    background: black;
    color: white;
    cursor: pointer;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(255, 255, 255, 0.2);
}
  </styles>
    <div class="container">
        <input type="text" id="usuario" placeholder="Digite seu nome" required>
        <div class="wheel-container">
            <div class="wheel" id="wheel">
                <img src="https://upload.wikimedia.org/wikipedia/commons/9/9f/Wheel_of_Fortune_(Tarot_card).jpg" alt="Roleta da Sorte">
            </div>
            <div class="pointer"></div>
        </div>
        <button id="spinButton">SPIN</button>
        <p id="resultado"></p>
    </div>

    <script>
      document.getElementById("spinButton").addEventListener("click", function () {
    let wheel = document.getElementById("wheel");
    let usuario = document.getElementById("usuario").value;

    if (usuario.trim() === "") {
        alert("Por favor, digite seu nome antes de girar!");
        return;
    }
    
    let randomDegree = Math.floor(3600 + Math.random() * 360);
    wheel.style.transform = `rotate(${randomDegree}deg)`;

    setTimeout(() => {
        let finalAngle = randomDegree % 360;
        let premio;

        if (finalAngle >= 0 && finalAngle < 60) {
            premio = "25 moedas";
        } else if (finalAngle >= 60 && finalAngle < 120) {
            premio = "1 moeda";
        } else if (finalAngle >= 120 && finalAngle < 180) {
            premio = "10 moedas";
        } else if (finalAngle >= 180 && finalAngle < 240) {
            premio = "Mega Prêmio!";
        } else if (finalAngle >= 240 && finalAngle < 300) {
            premio = "3 moedas";
        } else {
            premio = "10 moedas";
        }

        document.getElementById("resultado").innerText = `Você ganhou: ${premio}`;

        // Salvar no banco de dados via AJAX
        fetch("salvar_resultado.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: `usuario=${encodeURIComponent(usuario)}&premio=${encodeURIComponent(premio)}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                console.log("Resultado salvo com sucesso!");
            } else {
                console.log("Erro ao salvar resultado.");
            }
        })
        .catch(error => console.error("Erro:", error));

    }, 4000);
});                                      
    </script>
</body>
</html>
