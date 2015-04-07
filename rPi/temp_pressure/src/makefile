
OBJECTS= get_temp.o tp.o
HEADERS=tp.h

all: temp_pressure

temp_pressure:$(OBJECTS)
	$(CC) -o temp_pressure get_temp.o tp.o $(CFLAGS) $(LIBS) $(LDFLAGS) 

tp.o: tp.h

get_temp.o: tp.h

clean:
	rm *.o temp_pressure
