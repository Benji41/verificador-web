<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Esquina</title>


	<style>
    * {
      font-family: Nunito;
    }
		
		h1{
			font-size: 40px;
      color: rgb(105, 105, 105);
      text-align: center;
		}
		
		
		#noencontrada{
			max-width: 50%;
			height: auto;
		}
		body{
      background-color: rgb(60, 179, 113);
    }


    p{
    display:inline;
    }
    </style>







    <script type="text/javascript">
        setTimeout(function() {
            window.location.href = "index.html";
        }, 4000);
    </script>

    <script type="text/javascript">

      if (window.addEventListener) {
      var codigo = "";
      window.addEventListener("keydown", function (e) {
          codigo += String.fromCharCode(e.keyCode);
          if (e.keyCode == 13) {
              window.location = "mostrar_producto.php?codigo=" + codigo;
              codigo = "";
          }
      }, true);
}
</script>
</head>







<body>

  <h1>

    <?php
        include ("./inc/settings.php");
                
        try {
            $conn = new PDO("mysql:host=".$host.";dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM productos WHERE producto_codigo = ".$_GET["codigo"]);
            $stmt->execute();
          
            // set the resulting array to associative
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
           
            $renglones=$stmt->rowCount();
            
            if ($renglones==1) {
               echo "<p style='color: green; font-size: 60px;display:block'>¡Busqueda exitosa!</p>";
              echo "Producto:".
              '<p style="color: rgb(255, 215, 0);">'.$result['producto_nombre'].
              '</p>'."<br>";
              echo "Precio:".
              '<p style="color: rgb(255, 215, 0);">'.$result['producto_precio'].
              '</p>'."<br>";
              echo "Unidades disponibles:".
              '<p style="color: rgb(255, 215, 0);">'.$result['producto_stock'].
              '</p>'."<br>";
              echo "Descripción:".
              '<p style="color: rgb(255, 215, 0);">'.$result['producto_desc'].
              '</p>'."<br>";
              echo "<img src='".$result["producto_imagen"]."'  >";
			  
            }
            else{
              echo "<p style='color: red; font-size: 60px;display:block'>¡Busqueda Fallida!</p>";
              echo "<center> <img id='noencontrada' src='img/error.png' alt='' width='20%' height='20%'> </center>";
              echo "Lo sentimos, el producto que buscaba no fue identificado.\nPor favor acuda a servicio al cliente para mas información.";
            }
            
            
          } catch(PDOException $e) {
            echo "<p style='color: yellow; font-size: 60px;display:block'>¡Dispositivo en mantenimiento!</p>";
            echo "<center> <img  src='img/alerta.png' alt='' width='20%' height='20%'> </center>";
            echo "Lo sentimos, intente utilizar el dispositivo mas tarde.\nPor favor acuda a servicio al cliente para mas información.";
          }
    ?>
  </h1>
</body>
</html>