<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f8f5f3;
        }
        form {
            background-color: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        input {
            width: 100%;
            padding: 0.5rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            width: 100%;
            padding: 0.5rem;
            background-color: #884E40;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #734035;
        }
        label {
            display: block;
            margin-bottom: 0.5rem;
        }
        a {
            color: #884E40;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        p {
            margin-bottom: 0.5rem;
        }


    </style>
</head>
<body>
    <form action="">
        <label for="">Correo Electronico</label>
        <input type="email" name="usuario" id="usuario">
        <label for="">Contraseña</label>
        <input type="password" name="contraseña" id="contraseña">
        <button type="submit">Iniciar Sesión</button>
        <p>¿No tienes cuenta? Registrate y obtendras beneficios como puntos que se pueden utilizar en tus proximas reservaciones.</p>
        <a href="../registro/index.php">Registrate</a>
        <br>
        <a href="../index.php">Volver</a>
    </form> 
</body>
</html>