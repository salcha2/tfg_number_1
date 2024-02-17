#!/bin/bash
# Longitud $1 y Latitud $2 
# coordinates=-7.80029296875,42.5830078125

#longitud=$1
#latitud=$2
longitud=-7.80029296875
latitud=42.5830078125

myresult () {
	#res=$(grass74 ~/grassdata/art-risk/PERMANENT/ --exec v.what map=AR19_Heladas coordinates=$1,$2 layer=1 -a | grep value* | cut -d " " -f 3)
	#res=$(grass74 ~/grassdata/art-risk/PERMANENT/ --exec v.what map=AR19_Heladas coordinates=-7.80029296875,42.5830078125 layer=1 -a | grep value* | cut -d " " -f 3)
	#res=$(grass74 /home/dcagigas/grassdata/art-risk/PERMANENT/ --exec v.what map=AR19_Heladas coordinates=-7.80029296875,42.5830078125 -a | grep value* | cut -d " " -f 3)
	#res=eval "/bin/ls" # FUNCIONA
	#res=eval "/bin/ls -hal" # NO FUNCIONA
	res=$(ls)
	#res=eval "/usr/bin/grass -v"
    	return res;
}

#resul=$(myresult $longitud $latitud)
#echo $(myresult $longitud $latitud)

#commandline=$(ls -hal) # FUNCIONA
#commandline=$(grass74 /home/dcagigas/grassdata/art-risk/PERMANENT/ --exec v.what map=AR19_Heladas coordinates=-7.80029296875,42.5830078125 -a | grep value* | cut -d " " -f 3)
#commandline=$(grass74 -h)
commandline=$(env)
echo $commandline
#resul=$(myresult)
#echo $resul
echo 9


