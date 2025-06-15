<?php
session_start();
$mensaje="";

if(isset($_POST['accion'])){
    switch($_POST['accion']){

        case 'Agregar':
            if(!isset($_SESSION['usuario'])) {
                echo "<script>alert('Error. Inicie sesión para añadir al carrito.')</script>";
                $mensaje="";

            }else{
                if(isset($_POST['txtIDServ'])) {
                    $IDServ=openssl_decrypt($_POST['txtIDServ'], COD, KEY);
                    $NombServ=openssl_decrypt($_POST['txtNombreServ'], COD, KEY);
                    $CalidServ=openssl_decrypt($_POST['txtCalidadServ'], COD, KEY);
                    $PrecioServ=openssl_decrypt($_POST['txtPrecioServ'], COD, KEY);

                    if(!is_numeric($IDServ)){
                    $mensaje.="Error. ID incorrecto. ".$IDServ."<br/>";
                    }
                    
                    if(!is_string($NombServ)){
                    $mensaje.="Error. Servicio incorrecto. ".$NombServ."<br/>";
                    }
                    
                    if(!is_string($CalidServ)){
                    $mensaje.="Error. Calidad incorrecto. ".$CalidServ."<br/>";
                    }
                    
                    if(!is_numeric($PrecioServ)){
                    $mensaje.="Error. Precio incorrecto. ".$PrecioServ."<br/>";
                    }
                    
                    if(!isset($_SESSION['CARRITO'])){
                        $servicio=array(
                        'IDServ'=>$IDServ,
                        'NombServ'=>$NombServ,
                        'CalidServ'=>$CalidServ,
                        'PrecioServ'=>$PrecioServ
                        );
                        $_SESSION['CARRITO'][0]=$servicio;
                        $mensaje="Producto agregado al carrito";
                    }else{

                        $IDServicios=array_column($_SESSION['CARRITO'], "IDServ");
                        if(in_array($IDServ, $IDServicios)){
                            echo "<script>alert('Este servicio ya ha sido seleccionado')</script>";
                            $mensaje="";
                        }else{
                        $numeroServicios=count($_SESSION['CARRITO']);
                        $servicio=array(
                        'IDServ'=>$IDServ,
                        'NombServ'=>$NombServ,
                        'CalidServ'=>$CalidServ,
                        'PrecioServ'=>$PrecioServ
                        );
                        $_SESSION['CARRITO'][$numeroServicios]=$servicio;
                        $mensaje="Producto agregado al carrito";
                        }
                    }
                }elseif(isset($_POST['txtIDPack'])){
                    $IDPack=openssl_decrypt($_POST['txtIDPack'],COD,KEY);
                    $NombPack=openssl_decrypt($_POST['txtNombrePack'],COD,KEY);
                    $TipoPack=openssl_decrypt($_POST['txtTipoPack'],COD,KEY);
                    $PrecioPack=openssl_decrypt($_POST['txtPrecioPack'],COD,KEY);

                    if(!is_numeric($IDPack)){
                    $mensaje.="Error. ID incorrecto. ".$IDPack."<br/>";
                    }

                    if(!is_string($NombPack)){
                    $mensaje.="Error. Nombre incorrecto. ".$NombPack."<br/>";
                    }

                    if(!is_string($TipoPack)){
                    $mensaje.="Error. Tipo incorrecto. ".$TipoPack."<br/>";
                    }

                    if(!is_numeric($PrecioPack)){
                    $mensaje.="Error. Precio incorrecto. ".$PrecioPack."<br/>";
                    }

                    if(!isset($_SESSION['CARRITO'])){
                        $paquete=array(
                        'IDPack'=>$IDPack,
                        'NombPack'=>$NombPack,
                        'TipoPack'=>$TipoPack,
                        'PrecioPack'=>$PrecioPack
                        );
                        $_SESSION['CARRITO'][0]=$paquete;
                        $mensaje="Paquete agregado al carrito";
                    }else{

                        $IDPaquetes=array_column($_SESSION['CARRITO'], "IDPack");
                        if(in_array($IDPack, $IDPaquetes)){
                            echo "<script>alert('Este paquete ya ha sido seleccionado')</script>";
                            $mensaje = "";
                        }else{
                        $numeroPaquetes=count($_SESSION['CARRITO']);
                        $paquete=array(
                        'IDPack'=>$IDPack,
                        'NombPack'=>$NombPack,
                        'TipoPack'=>$TipoPack,
                        'PrecioPack'=>$PrecioPack
                        );
                        $_SESSION['CARRITO'][$numeroPaquetes]=$paquete;
                        $mensaje="Paquete agregado al carrito";
                        }
                    }
                }
            }
        //$mensaje=print_r($_SESSION,true);
        break;

        case 'Eliminar';
            if(is_numeric(openssl_decrypt($_POST['txtIDServ'],COD,KEY))){
                $IDServ=openssl_decrypt($_POST['txtIDServ'],COD,KEY);
                $mensaje="Ok. ID correcto".$IDServ;

                foreach($_SESSION['CARRITO'] as $indice=>$servicio){
                    if ($servicio['IDServ']==$IDServ){
                        unset($_SESSION['CARRITO'][$indice]);
                        echo "<script>alert('Elemento borrado');</script>";
                    }
                }
            }else{
                $mensaje.="Error. ID incorrecto. ".$IDServ."<br/>";
            }
        break;
    }
}

?>