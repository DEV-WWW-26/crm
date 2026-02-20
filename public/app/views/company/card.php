<?php
include $_SERVER['DOCUMENT_ROOT'] . '/app/views/header.html';
include($_SERVER['DOCUMENT_ROOT'] . '/app/views/navigation.html');
?>
<h2>Карточка компании</h2>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/app/views/company/company.html';
?>

<h2>Список встреч</h2>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/app/views/meeting/meeting_report.html';
?>

<script type="module">
    import {getCompanyById} from '../../js/company.js';
    import {openAlertErr} from '../../js/alerts.js';
    import {goHomeIfUnauthorized, getUrlParam} from '../../js/navigate.js';

    goHomeIfUnauthorized();

    async function fillCompanyForm(id) {
        try {
            let response = await getCompanyById(id);

            if (response == null || response == undefined || response == '') {

                return;
            }

            let items = JSON.parse(response);

            if (items.length === 0) {

                return;
            }

            for (const key in items) {
                const element = document.getElementById('title');
                element.innerHTML = items[key].title;
            }
        } catch (e) {
            openAlertErr(e);
        }
    }

    window.register = fillCompanyForm;

    await fillCompanyForm(getUrlParam("id"));

</script>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/app/views/footer.html';
?>

