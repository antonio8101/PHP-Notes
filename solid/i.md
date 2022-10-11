# INTERFACE SEGREGATION PRINCIPLE

## Significato

Un client non dovrebbe dipendere da metodi d'interfaccia che non usa...

## Code smell?

- interfacce con molti metodi, non tutti implementati dagli implementatori

## Benefici

- codice più coeso
- riduzione del coupling tra le classi che usano la singola interfaccia "larga".
- migliore separazione della logica di business, in interfacce separate.


# BAD

```php

interface IPromoCodeService {

   
   function delete(DeletePromoCodeRequest $delete_code_dto): DeletePromoCodeResponse;
   
   function verify(string $promo_code): VerifyPromoCodeResponse;
   
   function create(CreatePromoCodeRequest $create_code_dto): CreatePromoCodeResponse;
   
   function getConsultant(string $phone_number): GetConsultantResponse;
   
}

```

# GOOD

```php

 # what seems wrong ??

```