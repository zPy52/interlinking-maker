<!DOCTYPE html>
<html>
<head>
	<title>Hacedor de Interlinking</title>
    <style type="text/css">
		
        body {
            font-family: 'Helvetica';
        }

        a, pre {
            padding-left: 0.5rem;
        }

        table {
            border-collapse: separate;
            border-spacing: 2rem 0px;
            table-layout: fixed;
            width: 20rem;
            margin-left: -1rem;
            margin-top: 0.5rem;
        }

        th {
            text-align: left;
            padding: 0.5rem;
            border: 1px solid rgba(16,76,167,0.25);
            background: rgba(90,156,255,0.25);
        }

        td {
            text-align: justify;
            word-wrap: break-word;
            padding: 0.5rem;
        }

	</style>
</head>
<body>

<?php 

if (!$_POST) {
    header('Location: ./');
}

echo '<a href="./">⇱ Volver al formulario</a><br/>';

// COMIENZO: Separador de palabras y busquedas.

$palabras_clave = [];

$keyword = array(htmlspecialchars($_POST['form_text']), '');

$keyword[0] = trim($keyword[0], ';');

$first_separe = explode(',', $keyword[0]);


for ($i = 1; $i <= count($first_separe); $i++) {
    $keyword[1] .= trim($first_separe[$i - 1]) . ';';
}

$keyword[1] = trim($keyword[1], ';');

$second_separe = explode(';', $keyword[1]);

for ($i = 1; $i <= count($second_separe); $i++) {
    $second_separe[$i - 1] = trim($second_separe[$i - 1]);
}

// FIN: Separador de palabras y busquedas.

if (count($second_separe) % 2 == 0) {
    
    echo '<pre>Para copiar y pegar la información en un archivo Excel deberá seleccionar los datos deseados de abajo-derecha hacia arriba-izquierda.' .
     '<br/>' . 'De lo contrario, el formato que aparecerá en la hoja de cálculo no será el mismo que tiene en la web.</pre>';

    for ($i = 1; $i <= count($second_separe); $i = $i + 2) {
        $palabras_clave[$second_separe[$i - 1]] = $second_separe[$i];
    }

    asort($palabras_clave);

    echo '<table><tr><th style="width:15rem;">Palabras clave</th><th style="width:6rem;">Búsquedas</th><th style="width:2rem;" colspan="' . count($palabras_clave) . '">Enlazado interno</th></tr>';

    $auxiliar_de_palabras_clave = 1;


    foreach ($palabras_clave as $x => $valor_de_x) {

        echo '<tr><td>' . $x . '</td><td>' . $valor_de_x . '</td>';

        for ($i = 1; $i <= $auxiliar_de_palabras_clave; $i++) {
                
            $binario = mt_rand(0, 1);
    
            echo '<td>' . $binario . '</td>';

        }

        echo '</tr>';

        $auxiliar_de_palabras_clave++;

}

echo '</table>';

} else {
    echo 'Ha ocurrido un error. Cada palabra clave debe tener un número de búsquedas a la derecha.';
}


?>

</body>
</html>
