# Pasos para levantar proyecto

## Installation
Debes de tener instalado docker[]() y docker compose (En las nuevas versiones ya viene instalado junto a docker)
[Docker desktop Ubuntu](https://docs.docker.com/desktop/install/linux-install/)
O una alternativa no gráfica en ubuntu: [Docker engine Ubuntu](https://docs.docker.com/engine/install/ubuntu/)

## Pasos a seguir
Si se cumple con estos requisitos, descargaremos el proyecto que se encuentra en el repositorio de github:
```bash
git clone https://github.com/davymtz/bsolutions.git b_solutions
```
Una vez descargado, procederemos a ejecutar los siguientes comandos:

```bash
cd b_solutions && sh run_project.sh
```
Si por algna razón no se ejecuta la migración, hacerlo desde la terminal manualmente:
```bash
cat ./backup/dump.sql | docker exec -i db_service /usr/bin/mysql -uroot -pphp_root b_solutions
```
Para validar que los contenedores se crearon y levantaron bien, podremos verificarlo con este comando:
```bash
docker ps -a
```
En la columna **status** aparecerá _Up <time executed>_ y el tiempo del contenedor que está ejecutandose

Una vez que todo haya corrido bien, procederemos a entrar al navegador en esta ruta: [localhost](http://localhost)

Una vez revisada la prueba ejecutar este comando para poder bajar los servidores (cerrar y eliminar contenedores)
```bash
docker compose down
```