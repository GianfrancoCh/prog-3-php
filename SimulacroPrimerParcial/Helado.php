<?php

class Helado{
    
    public $sabor;
    public $precio;
    public $tipo;
    public $vaso;
    public $stock;
    private static $contadorId = 1;
    public function __construct($sabor, $precio, $tipo, $vaso, $stock) { 

    
        $this->sabor = $sabor;
        $this->precio = $precio;
        $this->tipo = $tipo;
        $this->vaso = $vaso;
        $this->stock= $stock;
    }


    public static function guardarHeladoJSON($helado){

        $helados = [];
        if (file_exists("heladeria.json")) {
            $contenido = file_get_contents("heladeria.json");
            $helados = json_decode($contenido, true);
        }

        if(self::verificarHeladoJSON($helado)){
            echo "Actualizado";
        }else{
            $helados[] = array(
                "id" => $helado->id,
                "sabor" => $helado->sabor,
                "precio" => $helado->precio,
                "tipo" => $helado->tipo,
                "vaso" => $helado->vaso,
                "stock" => $helado->stock
            );
        }

        $json = json_encode($helados);
        file_put_contents("heladeria.json", $json);
        echo "<p>Se guardó el helado en JSON</p>";

    }

    public static function verificarHeladoJSON($heladoVerificar){

        if (file_exists("heladeria.json")) {
            $contenido = file_get_contents("heladeria.json");
            $helados = json_decode($contenido, true);
            foreach ($helados as $helado) {
                if($helado['sabor'] == $heladoVerificar->sabor && $helado['tipo'] == $heladoVerificar->tipo){
                    $helado['precio'] = $heladoVerificar->precio;
                    $helado['stock'] += $heladoVerificar->stock;
                    return true;
                }
            }
        } else {
            echo "<p>No se encontró el archivo de helados</p>";
        }
       
    }

}

