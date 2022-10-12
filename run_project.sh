#!/bin/bash
echo "Schell Script ejecutadose..."

# Crear carpeta donde se alojarán los binarios de mysql
echo "Creando carpeta para gestionar BD..."
DIRECTORIO=/mysql

if [ -d "$DIRECTORIO" ]
then
   echo "El directorio ${DIRECTORIO} existe"
else
    mkdir ./mysql/
fi

echo "Listo"

# Correr los contenedores
echo "Levantando servidores en docker"
# La bandera --build solo será una vez
docker compose up -d --build

# Realizar las migraciones necesarias (restore)
echo "Realizando migraciones..."
cat ./backup/dump.sql | docker exec -i db_service /usr/bin/mysql -uroot -pphp_root b_solutions
echo "Listo"

echo "Schell Script ejecutado"
