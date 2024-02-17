GCC=gcc
GPP=g++
CFLAGS=  -fshow-column -fno-diagnostics-show-caret  -Wall -O2   
CXXFLAGS=  -fshow-column -fno-diagnostics-show-caret  -Wall -O2   -std=c++14
LDFLAGS=  -s  
OBJS=Release/AR3_020720.o Release/art-risk3.o 

all: Release Release/art-risk3.bin

clean:
	rm -rf ${OBJS} Release/art-risk3.bin

Release/art-risk3.bin: ${OBJS}
	${GPP} ${OBJS} ${LDFLAGS} -o $@

Release:
	mkdir Release

Release/AR3_020720.o: AR3_020720.c AR3_020720.h
	${GCC} ${CFLAGS} -c AR3_020720.c -o $@

Release/art-risk3.o: art-risk3.c AR3_020720.h
	${GCC} ${CFLAGS} -c art-risk3.c -o $@

