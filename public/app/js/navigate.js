import {isCookieExists} from './coockies.js';

export function navigate(url) {
    window.location.href = url;
}

export function gotoHomeIfUnauthorized() {
    if (!isCookieExists('logged')) {
        navigate('http://localhost/index.php')
    }
}
