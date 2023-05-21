<?php
parse_str(file_get_contents("php://input"), $dato);

$numeroPedido = $dato['nroPedido'];

$data = file_get_contents('Ventas.json');
$ventas = json_decode($data, true);

$ventaEncontrada = false;
foreach ($ventas as $key => $venta) {
    if ($venta['id'] == $numeroPedido) {

        $usuarioEmail = explode('@', $venta['mail'])[0];

        $nombreImagen = $venta['tipo']  . $venta['nombre'] . $usuarioEmail. $venta['fecha'] .'.png';

        $rutaOrigen = 'ImagenesDeLaVenta/2023/' . $nombreImagen;
        $rutaDestino = 'BACKUPVENTAS/2023/' . $nombreImagen;
        rename($rutaOrigen, $rutaDestino);
        unset($ventas[$key]);

        $ventaEncontrada = true;
        break;

    }
}
file_put_contents('Ventas.json', json_encode($ventas));
if ($ventaEncontrada) {

    echo "La venta con número de pedido $numeroPedido ha sido eliminada correctamente.";
} else {

    echo "No se encontró el número de pedido $numeroPedido.";

}

?>