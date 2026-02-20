<?php
include $_SERVER['DOCUMENT_ROOT'] . '/app/views/header.html';
include($_SERVER['DOCUMENT_ROOT'] . '/app/views/navigation.html');
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
    import {goHomeIfUnauthorized} from '../../js/navigate.js';

    goHomeIfUnauthorized();

    async function fillReportTable() {
        try {
            let response = await loadMeetingReport();

            if (response == null || response == undefined || response == '') {

                return;
            }

            let items = JSON.parse(response);

            if (items.length === 0) {

                return;
            }

            const element = document.getElementById('tbody');
            let content = '';

            for (const key in items) {
                content += '<tr>' +
                    `<td>${items[key].company}</td>` +
                    `<td>${items[key].title}</td>` +
                    `<td>${items[key].scheduled}</td>` +
                    `<td>${items[key].status}</td>` +
                    `<td>${items[key].type}</td>` +
                    `<td>${items[key].user}</td>` +
                    `<td>${items[key].description}</td>` +
                    '</tr>';
            }

            element.innerHTML = content;

        } catch (e) {
            openAlertErr(e);
        }
    }

    window.register = fillReportTable;

    await fillReportTable();

</script>
