import {isCookieExists} from './coockies.js';

export function navigate(url) {
    window.location.href = url;
}

export function goHomeIfUnauthorized() {
    if (!isCookieExists('logged')) {
        navigate('http://localhost/index.php');
    }
}

export function goHome() {
    navigate('http://localhost/index.php');
}
