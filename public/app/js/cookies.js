function checkCookiesEnabled() {
    if (navigator.cookieEnabled) {
        console.log('Cookies are enabled');
    } else {
        alert('Cookies aren\'t enabled')
    }
}

export function getCookie(name) {
    const match = document.cookie.match(RegExp('(?:^|;\\s*)' + name + '=([^;]*)')); //
    return match ? decodeURIComponent(match[1]) : null; //
}

export function isCookieExists(name) {
    const match = document.cookie.match(RegExp('(?:^|;\\s*)' + name + '=([^;]*)')); //
    const res = !!match;
    console.log('Cookie ' + name + ' is exists "' + res + '"');

    return res;
}