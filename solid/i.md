# INTERFACE SEGREGATION PRINCIPLE

## Significato

Un client non dovrebbe dipendere da metodi d'interfaccia che non usa...

## Code smell?

- interfacce con molti metodi, non tutti implementati dagli implementatori

## Benefici

- codice più coeso
- riduzione del coupling tra le classi che usano la singola interfaccia "larga".
- migliore separazione della logica di business, in interfacce separate.