GCC=gcc
GPP=g++
CFLAGS=  -fshow-column -fno-diagnostics-show-caret  -Wall -O2   
CXXFLAGS=  -fshow-column -fno-diagnostics-show-caret  -Wall -O2   -std=c++14
LDFLAGS=  -s  
OBJS=Release/AR32_archivos_nuevos.o Release/art-risk3.o 

all: Release Release/art-risk3.bin

clean:
	rm -rf ${OBJS} Release/art-risk3.bin

Release/art-risk3.bin: ${OBJS}
	${GPP} ${OBJS} ${LDFLAGS} -o $@

Release:
	mkdir Release

Release/AR32_archivos_nuevos.o: AR32_archivos_nuevos.c AR32_archivos_nuevos.h
	${GCC} ${CFLAGS} -c AR32_archivos_nuevos.c -o $@

Release/art-risk3.o: art-risk3.c AR32_archivos_nuevos.h
	${GCC} ${CFLAGS} -c art-risk3.c -o $@

