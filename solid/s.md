# SINGLE RESPONSIBILITY PRINCIPLE

## Significato

Una classe dovrebbe avere solo una responsabilità. Questo significa che il codice della classe dovrebbe essere molto "coeso" e specifico, e dovrebbe implementare logiche molto legate tra di loro.
Una sola classe che implementa più feature è una violazione di questo principio.

## Code smell?

- più di un pezzo di codice contestualmente separato dal resto in una singola classe.
- large setup in test (setup della classe nei Test lungo e difficoltoso).

## Benefici

- classi "separate" per ogni use-case, che possono essere riusate maggiormente.
- classi "separate" per ogni use-case possono essere testate meglio singolarmente.


# BAD

```php

class PlaceOrder {

   private Product $product;

   public function __construct(Product $product) {
    
    $this->product = $product;
   
   }
   
   public function run() {
    
    # Logic related to verification of stock availability
    # Logic related to payment process
    # Logic related to shipment process
    
   }
}

```

# GOOD

```php

class PlaceOrder {

   private Product $product;

   public function __construct(Product $product) {
    
    $this->product = $product;
   
   }
   
   public function run() {
    
    new StockAvailability($this->product).run();
    new ProductPayment($this->product).run();
    new ProductShipment($this->product).run();
    
   }
}

```