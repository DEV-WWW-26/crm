<?php
include $_SERVER['DOCUMENT_ROOT'] . '/app/views/header.html';
?>

<h2>Отчет по встречам</h2>

<?php
include 'meeting_report.html';
?>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/app/views/footer.html';
?>

<script type="module">
    import {loadMeetingReport} from '../../js/meeting.js';
    import {openAlertErr} from '../../js/alerts.js';

    async function fillReportTable() {
        try {
            let response = await loadMeetingReport();
            let items = JSON.parse(response);
            const element = document.getElementById('tbody');
            let content = '';

            for (const key in items) {
                content += '<tr>' +
                    '<td>${items[key].company}</td>' +
                    '<td>${items[key].title}</td>' +
                    '<td>${items[key].scheduled}</td>' +
                    '<td>${items[key].status}</td>' +
                    '<td>${items[key].type}</td>' +
                    '<td>${items[key].user}</td>' +
                    '<td>${items[key].description}</td>' +
                    '</tr>`;
            }

            element.innerHTML = content;

        } catch (e) {
            openAlertErr(e);
        }
    }

    window.register = fillReportTable;

    await fillReportTable();

</script>
