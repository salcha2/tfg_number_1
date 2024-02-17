#!/bin/bash
# Longitud $1 y Latitud $2 
# coordinates=-7.80029296875,42.5830078125

grass74 ~/grassdata/art-risk/PERMANENT/ --exec v.what map=AR19_Heladas coordinates=$1,$2 layer=1 -a | grep value* | cut -d " " -f 3 

