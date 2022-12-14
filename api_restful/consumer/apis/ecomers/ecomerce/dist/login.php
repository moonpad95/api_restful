<?php 

// Agregar el codigo para verificar en la BD que el usuario y pass sean validos
    if ($_SERVER["REQUEST_METHOD"]=="POST")
      {
            $us=$_POST['nombre'];
            $ps=$_POST['pass'];

            $ins = json_encode(array("user" => "$us", "pwd" => "$ps"));
            
            $curl = curl_init();

            curl_setopt_array($curl, array(
                    CURLOPT_URL => 'http://localhost/appwebOS/parcial2/api_restful2/api_restful/controllers/usuario.php?op=sesion',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                    CURLOPT_POSTFIELDS =>$ins,
                    CURLOPT_HTTPHEADER => array(
                      'Content-Type: text/plain'
                    ),
                  ));
            
            $response = curl_exec($curl);
            curl_close($curl);
            //Decodifica de formato json a un arreglo ascociativo
            $data = json_decode($response, true);

            if (count($data)>0)
            {
                echo "<script>
                         alert('.:: - B I E N V E N I D O - :: ');
                         location.href='../../../../menu.php'; //redireccionar a otro archivo 
                       </script>";
            }
            else
            {
                echo "<script>
                        alert('.:: - Verificar Usuario y Contraseña - :: ');
                        location.href='login.php';
                      </script>";
            }    
            
      }

?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Bootstrap 5 Login Form Example</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    </head>

    <body>
            <div class="" style="margin-top:200px">
                <div class="rounded d-flex justify-content-center">
                    <div class="col-md-4 col-sm-12 shadow-lg p-5 bg-light">
                        <div class="text-center">
                            <h3 class="text-primary">Iniciar sesion</h3>
                        </div>
                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                            <div class="p-4">
                                <div class="input-group mb-3">
                                    <span class="input-group-text bg-primary"><i
                                            class="bi bi-person-plus-fill text-white"></i></span>
                                    <input type="text" class="form-control" placeholder="Usuario" name="nombre" id="us">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text bg-primary"><i
                                            class="bi bi-key-fill text-white"></i></span>
                                    <input type="password" class="form-control" placeholder="Contraseña" name="pass" id="ps">
                                </div>
                                <button class="btn btn-primary text-center mt-2" type="submit">
                                    Iniciar
                                </button>
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </body>

</html>
