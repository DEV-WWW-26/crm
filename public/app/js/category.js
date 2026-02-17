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

        return Promise.resolve(response.text());

    } catch (error) {
        console.log(error);

        return Promise.reject(error);
    }
}
