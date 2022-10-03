# LISKOV SUBSTITUTION PRINCIPLE

## Significato

Una nuova classe derivata, che estende la classe base, non dovrebbe cambiare il comportamento della classe base. 
Non dovrebbe cioè cambiare il comportamento dei metodi ereditati.
Per esempio se una classe Y deriva da una classe X, ogni classe che lavora normalmente referenziando la classe X, 
dovrebbe essere in grado di lavorare anche con la classe Y.
(Le classi derivate dovrebbero poter sostituire la classe base).


## Code smell?

- modifica di comportamenti ereditati nelle sottoclassi.
- tirare eccezione nei metodi overridden...

## Benefici

- evita risultati scorretti, o inattesi...
- chiara e più netta distinzione tra ereditare da interfacce (che lasciano aperta l'implementazione..), e estensione di funzionalità..

# BAD

```php

class Rectangle {

	private float $width, $height;

	public function __construct( float $width, float $height ) {

		$this->width  = $width;
	
		$this->height = $height;

	}

	public function setWidth( $width ): void {
		
		$this->width = $width;
	
	}

	public function setHeight( $height ): void {
	
		$this->height = $height;
	
	}
}

class Square extends Rectangle {
    
    public function setWidth( $width ): void {
	
	    parent::setWidth( $width );
    
        $this->width = $width;
    
    }

	public function setHeight( $height ): void {
	
		parent::setWidth( $height );
	
		$this->height = $height;
	
	}
}


```