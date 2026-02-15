function checkCookiesEnabled() {
    if (navigator.cookieEnabled) {
        console.log('Cookies are enabled');
    } else {
        alert('Cookies aren\'t enabled')
    }
}

function getCookie(name) {
    const match = document.cookie.match(RegExp('(?:^|;\\s*)' + name + '=([^;]*)')); //
    return match ? decodeURIComponent(match[1]) : null; //
}


