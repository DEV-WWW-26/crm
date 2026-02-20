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

export async function loadMeetingStatuses() {
    try {
        const response = await fetch('http://localhost/app/controllers/load_meeting_status.php', {
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

export async function loadMeetingTypes() {
    try {
        const response = await fetch('http://localhost/app/controllers/load_meeting_type.php', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json', // Sending data as JSON is common
            }
        });

        if (!response.ok) {

            return Promise.reject('Network response was not ok. ');
        }

        return Promise.resolve(response.text());

    } catch (error) {
        console.log(error);

        return Promise.reject(error);
    }
}

export async function loadMeetingReport() {
    try {
        const response = await fetch('http://localhost/app/controllers/load_meeting_report.php', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json', // Sending data as JSON is common
            }
        });

        if (!response.ok) {

            return Promise.reject('Network response was not ok. ');
        }

        return Promise.resolve(response.text());

    } catch (error) {
        console.log(error);

        return Promise.reject(error);
    }
}
