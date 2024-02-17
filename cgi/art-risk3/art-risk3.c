#include <stdio.h>
#include <stdlib.h>
#include "AR3_020720.h"

void hacer_mapeo (char *argv[]);
void hacer_asignacion (double valor);

double V1,V2,V3,V4,V5,V6,V7,V8,V9,V10,V11,V12,V13,V14,V15,V16,V17,V18,V19;

int main(int argc, char *argv[]) {
	double vulnerabilidad  = 0.0;
	double riesgo  = 0.0;
	double funcionalidad  = 0.0;
	
/*	
	if (argc != 20) {
		printf ("Error: El numero de argumentos debe ser 19 \n");
		return -1;
	}
*/	
	
	//hacer_asignacion (5.0);
	
	//printf ("Paso 1\n");
	hacer_mapeo (argv);
	
	//printf ("Paso 2 V1: %lf V2: %lf ... V18: %lf V19: %lf \n", V1, V2, V18, V19);
	//ArtRisk3_m1InferenceEngine (V1,V2,V3,V4,V5,V6,V7,V8,V9,V10,V11,V12,V13,V14,V15,V16,V17,V18,V19,&vulnerabilidad,&riesgo,&funcionalidad);
	AR3_020720InferenceEngine(V1,V2,V3,V4,V5,V6,V7,V8,V9,V10,V11,V12,V13,V14,V15,V16,V17,V18,V19,&vulnerabilidad,&riesgo,&funcionalidad);
	
	//printf ("Paso 3\n");
	//fprintf (stdout, "%.2lf", funcionalidad);
	//funcionalidad = V1+V2+V19;
	//printf ("Vulnerabilidad: %lf Riesgo: %lf Funcionalidad: %lf\n", vulnerabilidad, riesgo, funcionalidad);
	//fprintf (stdout, "%.2lf %.2lf %.2lf", vulnerabilidad, riesgo, funcionalidad);
	fprintf (stdout, "%.2lf\n", vulnerabilidad);
	fprintf (stdout, "%.2lf\n", riesgo);
	fprintf (stdout, "%.2lf\n", funcionalidad);
	
	return 0;
}

/* FUNCIONES */

void hacer_mapeo (char *argv[]) {
	
	V1 = atof(argv[1]);
	V2 = atof(argv[2]);
	V3 = atof(argv[3]);
	V4 = atof(argv[4]);
	V5 = atof(argv[5]);
	V6 = atof(argv[6]);
	V7 = atof(argv[7]);
	V8 = atof(argv[8]);
	V9 = atof(argv[9]);
	V10 = atof(argv[10]);
	V11 = atof(argv[11]);
	V12 = atof(argv[12]);
	V13 = atof(argv[13]);
	V14 = atof(argv[14]);
	V15 = atof(argv[15]);
	V16 = atof(argv[16]);
	V17 = atof(argv[17]);
	V18 = atof(argv[18]);
	V19 = atof(argv[19]);

}

void hacer_asignacion (double valor) {
	V1 = valor;
	V2 = valor;
	V3 = valor;
	V4 = valor;
	V5 = valor;
	V6 = valor;
	V7 = valor;
	V8 = valor;
	V9 = valor;
	V10 = valor;
	V11 = valor;
	V12 = valor;
	V13 = valor;
	V14 = valor;
	V15 = valor;
	V16 = valor;
	V17 = valor;
	V18 = valor;
	V19 = valor;
	
}

