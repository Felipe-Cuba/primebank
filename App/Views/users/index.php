<?php

$usuarios = $viewVar['listaUsuarios'];

foreach ($usuarios as $usuario) {
    echo $usuario->getNome();
}