# OPEN CLOSED PRINCIPLE

## Significato

Una classe dovrebbe essere aperta alle estensioni, ma chiusa alle modifiche. Bisognerebbe essere in grado, e preferire, estendere il comportamento di una classe
piuttosto che modificare la sua implementazione. Come? Evitando di modificare il codice esistente nella classe X, ma scrivere un nuovo pezzo di codice che verrà usato nella classe X. 

## Code smell?

- complessi if/else statement...

## Benefici

- la funzionalità della classe può essere estesa facilmente attraverso logica incapsulata in altre classi, senza il bisogno di cambiare l'implementazione iniziale.
- il codice è disaccoppiato.
- se X e la classe iniziale, e Y la sua estensione, Y può essere resa facilmente in mock nei test. 


# BAD

```php

class Logger {

   private string $loggingFrom;

   public function __construct(string loggingFrom) {
    
    $this->logginFrom = $loggingFrom;
   
   }
   
   public function run() {
    
    if ($loggingFrom == 'console') {
     
     // do something
        
    } elseif ($loggingFrom == 'file') {
     
     // do something else..
    
    } else {
     
     // do something else..
    
    }
   
   }
}

```

# GOOD

```php

interface ILogger {

 public function log(): void;
    
}

class ConsoleLogger implements ILogger {

   public function log(): void {
    
    //
    
   }
}

class FileLogger implements ILogger {

   public function log(): void {
    
    //
    
   }
}

```