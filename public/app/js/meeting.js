"use strict"

export async function loadCompanies() {
    try {
        const response = await fetch('http://localhost/app/controllers/load_company.php', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json', // Sending data as JSON is common
            }
        });

        if (!response.ok) {

            return Promise.reject('Network response was not ok');
        }

        return Promise.resolve(response.text());

    } catch (error) {
        console.log(error);

        return Promise.reject(error);
    }
}
