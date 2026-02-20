import {isCookieExists} from './cookies.js';

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

export function getUrlParam(name) {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    return urlParams.get(name);
}
