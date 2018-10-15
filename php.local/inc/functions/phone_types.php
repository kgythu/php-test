<?php
function phone_types($type) {
    switch($type) {
        case 'mobile':
            return 'Mobil';
        case 'home':
            return 'Otthoni';
        case 'work':
            return 'Munkahelyi';
    };
    return $type;
}
?>