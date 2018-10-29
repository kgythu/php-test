<?php
    try {
        $a = new Point(-21, 33);
        $b = new Point(21, 0);
        $c = new Point(30, 25);
        $triangle_vertices = array($a, $b, $c);
        $triangle = new Triangle($triangle_vertices);
        echo $triangle->getVertices()[1]->getX();
    } catch(Exception $e) {
        echo '<p>' . $e->getMessage() . '</p>';
    }
?>