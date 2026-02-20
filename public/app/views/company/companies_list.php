<?php
include $_SERVER['DOCUMENT_ROOT'] . '/app/views/header.html';
include($_SERVER['DOCUMENT_ROOT'] . '/app/views/navigation.html');
?>

<h2>Список компаний</h2>

<?php
include 'companies_table.html';
?>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/app/views/footer.html';
?>

<script type="module">
    import {loadCompanies} from '../../js/company.js';
    import {openAlertErr} from '../../js/alerts.js';
    import {goHomeIfUnauthorized, getUrlParam} from '../../js/navigate.js';

    goHomeIfUnauthorized();

    async function fillCompaniesTable() {
        try {
            let response = await loadCompanies();

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
                    `<td>${items[key].title}</td>` +
                    `<td><a href="http://localhost/app/views/company/card.php?id=${items[key].id}">Карточка</a></td>` +
                    '</tr>';
            }

            element.innerHTML = content;

        } catch (e) {
            openAlertErr(e);
        }
    }

    window.register = fillCompaniesTable;

    await fillCompaniesTable();

</script>
