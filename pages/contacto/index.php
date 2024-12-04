<?php include ("../../temp/header.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Contactanos</h1>    
    <form action="contacs">
        <label for="Nombre">Nombre</label><input type="text" Nombre ><br>
        <label for="mail">Correo</label> <input type="email"><br>
        <label for="Asunto">Asunto</label><input type="text"><br>
        <label for="Sugerencia">Queja o sugerencia</label><br>
        <textarea name="mensaje" rows="4" cols="40">Escriba su mensaje aquí</textarea><br>
        <input type="button" value="Enviar">
    </form>    
</body>
</html>
<?php include ("../../temp/footer.php");?>