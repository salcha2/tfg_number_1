#include <stdio.h>
#include <stdlib.h>

int main () {
	
	//printf ("Ejemplo\n");
	//printf ("\nResultado: %d\n", system("gcc -v >> tmp.txt"));
	//printf ("\nResultado: %d\n", system("grass74 /home/dcagigas/grassdata/art-risk/PERMANENT/ --exec v.what map=AR19_Heladas coordinates=-7.80029296875,42.5830078125 layer=1 -a "));
	
	printf ("\nResultado: %d\n", system("grass74 -v >> tmp.txt"));
	
	return 0;
}
