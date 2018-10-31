<?php
    try {
        $a = new Point(-21, 33);
        $b = new Point(21, 0);
        $c = new Point(30, 25);
        $triangle_vertices = array($a, $b, $c);
        $triangle = new Triangle($triangle_vertices);
        echo '<p>Kerület: ', $triangle->getPerimeter(), '</p>', "\n";
        echo '<p>Terület: ', $triangle->getArea(), '</p>', "\n";
        $triangle2 = new Triangle(array(
            new Point(0, 0),
            new Point(0, 3),
            new Point(4, 0)
        ));
        echo '<p>Kerület: ', $triangle2->getPerimeter(), '</p>', "\n";
        echo '<p>Terület: ', $triangle2->getArea(), '</p>', "\n";
    } catch(Exception $e) {
        echo '<p>' . $e->getMessage() . '</p>', "\n";
    }
?>