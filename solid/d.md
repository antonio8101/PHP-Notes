# DEPENDENCY INVERSION PRINCIPLE

## Significato

La logica di alto livello (business logic) non dovrebbe dipende dalla logica di basso livello (tipo database, I/O, ecc..).
Entrambe devono dipendere da astrazioni. Le astrazioni non devono dipendere dai dettagli, i dettagli devono dipendere dalle astrazioni.

## Code smell?

- creazioni di istanze di classi di basso livello nella logica di alto livello.
- chiamata a metodi di classe a classi di basso livello, in codice di alto livello.

## Benefici

- accresce la riusabilità di moduli di basso livello, rendendoli separati e riusabili in più contesti.
- i moduli di alto livello sono più flessibili (possono abbinarsi a diversi componenti di basso livello).
- le classi iniettate possono essere facilmente rese con i mock.


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