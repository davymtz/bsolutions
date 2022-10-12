#!/bin/bash

# Crear carpeta donde se alojarán los binarios de mysql
DIRECTORIO=/mysql

if [ -d "$DIRECTORIO" ]
then
   echo "El directorio ${DIRECTORIO} existe"
else
    mkdir ./mysql/
fi

# Correr los contenedores
docker compose up -d --build
