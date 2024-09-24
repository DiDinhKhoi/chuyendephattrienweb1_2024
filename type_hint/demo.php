<?php
declare(strict_types=1);


require_once 'I.php';
require_once 'C.php';
require_once 'A.php';
require_once 'B.php';


class Demo {

    // Return A, Type A
    public function returnATypeA(): A {
        echo __FUNCTION__ . "<br>";
        return new A();
    }

    // Return B, Type A
    public function returnBTypeA(): A {
        echo __FUNCTION__ . "<br>";
        return new B();
    }
   

    // Return C, Type A
    public function returnCTypeA(): A {
        echo __FUNCTION__ . "<br>";
        return new C();
    }
 
    // Return I, Type A
    public function returnITypeA(): A {
        echo __FUNCTION__ . "<br>";
        return new I();
    }

    // Return Null, Type A
    public function returnNullTypeA(): ?A {
        echo __FUNCTION__ . "<br>";
        return null;
    }

    // Return A, Type B
    public function returnATypeB(): B {
        echo __FUNCTION__ . "<br>";
        return new A();
    }
        
    // Return B, Type B
    public function returnBTypeB(): B {
        echo __FUNCTION__ . "<br>";
        return new B();
    }
   
    // Return C, Type B
    public function returnCTypeB(): B {
        echo __FUNCTION__ . "<br>";
        return new C();
    }
    // Return I, Type B
    public function returnITypeB(): B {
        echo __FUNCTION__ . "<br>";
        return new I();
    }
    // Return null, Type B
    public function returnNullTypeB(): ?B {
        echo __FUNCTION__ . "<br>";
        return null;
    }

    // Return A, Type C
    public function returnATypeC(): C {
        echo __FUNCTION__ . "<br>";
        return new A();
    }
    // Return B, Type C
    public function returnBTypeC(): C {
        echo __FUNCTION__ . "<br>";
        return new B();
    }
    // Return C, Type C
    public function returnCTypeC(): C {
        echo __FUNCTION__ . "<br>";
        return new C();
    }
    // Return I, Type C
    public function returnITypeC(): C {
        echo __FUNCTION__ . "<br>";
        return new I();
    }
    // Return null, Type C
    public function returnNullTypeC(): ?C {
        echo __FUNCTION__ . "<br>";
        return null;
    }
    // Return A, Type I
    public function returnATypeI(): I {
        echo __FUNCTION__ . "<br>";
        return new A();
    }
    // Return B, Type I
    public function returnBTypeI(): I {
        echo __FUNCTION__ . "<br>";
        return new B();
    }
    // Return C, Type I
    public function returnCTypeI(): I {
        echo __FUNCTION__ . "<br>";
        return new C();
    }
    // Return I, Type I
    public function returnITypeI(): I {
        echo __FUNCTION__ . "<br>";
        return new I();
    }
    // Return null, Type I
    public function returnNullTypeI(): ?I {
        echo __FUNCTION__ . "<br>";
        return null;
    }
    // Return A, Type null
    public function returnATypeNull(): ?A {
        echo __FUNCTION__ . "<br>";
        return new A();
    }
    // Return B, Type null
    public function returnBTypeNull(): ?B {
        echo __FUNCTION__ . "<br>";
        return new B();
    }
    // Return C, Type null
    public function returnCTypeNull(): ?C {
        echo __FUNCTION__ . "<br>";
        return new C();
    }    
    // Return I, Type null
    public function returnITypeNull(): ?I {
        echo __FUNCTION__ . "<br>";
        return new I();
    }  
    // Return null, Type null
    public function returnNullTypeNull(): ?Null {
        echo __FUNCTION__ . "<br>";
        return null;
    }       
}

$demo = new Demo();
$results = [];
$results['returnBTypeB'] = $demo->returnBTypeB() instanceof B;

var_dump($results);
?>




