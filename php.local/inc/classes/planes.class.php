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

		protected $vertices = array();     // csúcspontok
		protected $perimeter = 0;          // kerület
		protected $area = 1;               // terület
		// Konstruktor
		public function __construct($param) {
				$this->setVertices($param);
		}
		// Methods
		protected function countArea() {
			// Mindig az adott konkrét síkidomnál
		}
		protected function countPerimeter() {
			$this->perimeter = 0;
			for($i = 0; $i < count($this->vertices); $i++) {
				if($i === 0) $j = count($this->vertices) - 1;
				else $j = $i - 1;
				$this->perimeter += $this->measureLine($this->vertices[$i], $this->vertices[$j]);
			};
		}
		public function measureLine($a, $b) {
				if(!is_object($a) || (get_class($a) !== 'Point') || !is_object($b) || (get_class($b) !== 'Point')) {
						throw new WrongTypeException('Nem megfelelő típusú csúcs! ('
							. (is_object($a) ? get_class($a) : 'nem objektum')
							. ', '
							. (is_object($b) ? get_class($b) : 'nem objektum')
							. ')');
				};
				return sqrt(
						($a->getX() - $b->getX()) ** 2
						+
						($a->getY() - $b->getY()) ** 2
				);
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
				$this->countPerimeter();
				$this->countArea();
			}
		// Getter
		public function getPerimeter() {
			return $this->perimeter;
		}
		public function getArea() {
			return $this->area;
		}
		public function getVertices() {
				return $this->vertices;
		}
}
class Triangle extends Polygon {
	// Methods
	protected function countArea() {
		// Képlet:
		// a × b × sin gamma / 2
		$this->area *= $this->measureLine($this->vertices[0], $this->vertices[1]);
		$this->area *= $this->measureLine($this->vertices[1], $this->vertices[2]);
		$this->area *= sin($this->getGamma());
		$this->area /= 2;
	}
	public function getGamma() {
		return atan(@abs(($this->vertices[0]->getY() - $this->vertices[1]->getY()) / ($this->vertices[0]->getX() - $this->vertices[1]->getX()))) +
			atan(@abs(($this->vertices[1]->getY() - $this->vertices[2]->getY()) / ($this->vertices[1]->getX() - $this->vertices[2]->getX())));
	}
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