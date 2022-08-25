<?php declare(strict_types=1);

use App\Service\ParityChecker;
use PHPUnit\Framework\TestCase;

final class ParityCheckerTest extends TestCase
{
    public function testAcceptIntegers(): void
    {
        $checker = new ParityChecker();

        // indique à phpunit que l'on ne va pas utiliser de fonction de type assert*()
        $this->expectNotToPerformAssertions();

        // si le code testé de génère aucune exception, le teste est passé
        for ($i = 0; $i < 10; $i++) { 
            $checker->isEven($i);
        }
    }
    public function testRefusesNotIntegers(): void
    {
        $checker = new ParityChecker();

        // indique à phpunit qu'une exception de type TypeError est attendue
        // TypeError : mauvais type de donnée passé en paramètre
        $this->expectException(TypeError::class);

        // si le code testé de génère l'exception précisée, le test est passé
        $checker->isEven(null);

        $checker->isEven(true);
        
        $checker->isEven(3.14);
        
        $checker->isEven("foo bar baz");

        $checker->isEven([]);

        // test de passage d'un objet
        $checker->isEven($checker);
    }

    public function testReturnIsBoolean(): void
    {
        $checker = new ParityChecker();

        $this->assertIsBool($checker->isEven(1));
        $this->assertIsBool($checker->isEven(2));

        $this->assertIsBool($checker->isOdd(1));
        $this->assertIsBool($checker->isOdd(2));
    }

    public function testValidateEvenNumbers(): void
    {
        $checker = new ParityChecker();

        for ($i = 0; $i < 10; $i += 2) { 
            $this->assertTrue($checker->isEven($i));
        }
    }

    public function testDoesNotValidateOddNumbers(): void
    {
        $checker = new ParityChecker();

        for ($i = 1; $i < 10; $i += 2) { 
            $this->assertFalse($checker->isEven($i));
        }
    }

    public function testValidateOddNumbers(): void
    {
        $checker = new ParityChecker();

        for ($i = 1; $i < 10; $i += 2) { 
            $this->assertTrue($checker->isOdd($i));
        }
    }

    public function testDoesNotValidateEvenNumbers(): void
    {
        $checker = new ParityChecker();

        for ($i = 0; $i < 10; $i += 2) { 
            $this->assertFalse($checker->isOdd($i));
        }
    }
}