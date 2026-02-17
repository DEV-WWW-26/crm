"use strict"

export async function load() {
    try {
        console.log('Loading categories..');
        const response = await fetch('http://localhost/app/controllers/category.php', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json', // Sending data as JSON is common
            }
        });

        if (!response.ok) {

            return Promise.reject('Network response was not ok');
        }

        console.log(response.text());

        return Promise.resolve(response.text());

    } catch (error) {

        return Promise.reject(response.text());
    }
}
