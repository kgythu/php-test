<?php
// Pont objektumok osztálya
class Point {
    // Tulajdonságok
    private $x = 0;
    private $y = 0;
    // Konstruktor
    public function __construct($x = 0, $y = 0) {
        $this->setX($x);
        $this->setY($y);
    }
    // Setterek
    public function setX($param = 0) {
        if(is_integer($param))
            $this->x = $param;
        else
            throw new NonIntException('Nem egész szám az x koordináta!');
    }
    public function setY($param = 0) {
        if(is_integer($param))
            $this->y = $param;
        else
            throw new NonIntException('Nem egész szám az y koordináta!');
    }
    // Getterek
    public function getX() {
        return $this->x;
    }
    public function getY() {
        return $this->y;
    }
}
class Polygon {
    // Most csak a síkidomok egy részével foglalkozunk: sokszögek
    private $vertices = array();
    // Konstruktor
    public function __construct($param) {
        $this->setVertices($param);
    }
    // Setterek
    public function setVertices($param) {
        if(is_array($param)) {
            if(count($param) > 2) {
                $this->setVerticesB($param);
            } else {
                throw new TooShortArrayException('Kevés csúcsa van a sokszögnek!');
            }
        } else {
            throw new NonArrayException('Nem tömb a pontok halmaza!');
        };
    }
    protected function setVerticesB($param) {
        foreach($param as $vertex) {
            if(!is_object($vertex) || (get_class($vertex) !== 'Point')) {
                throw new WrongTypeException('Nem megfelelő típusú csúcs!');
            };
        };
        $this->vertices = $param;
    }
    // Getter
    public function getVertices() {
        return $this->vertices;
    }
}
class Triangle extends Polygon {
    // Setter
    public function setVertices($param) {
        if(is_array($param)) {
            if(count($param) === 3) {
                $this->setVerticesB($param);
            } else {
                throw new TooShortArrayException('Nem három csúcsa van a háromszögnek!');
            }
        } else {
            throw new NonArrayException('Nem tömb a pontok halmaza!');
        };
    }
}
?>