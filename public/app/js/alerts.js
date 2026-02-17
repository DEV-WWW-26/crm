"use strict"

export function openAlertErr(msg) {
    const alertElement = document.getElementById('alert');
    alertElement.innerHTML = `<div models="alert alert-danger" role="alert">${msg}</div>`;
}

export function openAlertOk(msg) {
    const alertElement = document.getElementById('alert');
    alertElement.innerHTML = `<div models="alert alert-success" role="alert">${msg}</div>`;
}
