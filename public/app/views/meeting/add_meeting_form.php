<?php
include $_SERVER['DOCUMENT_ROOT'] . '/app/views/header.html';
?>

<h2>Встреча</h2>
<form id=add_company_form" action="../../controllers/meeting.php" method="post">

    <?php
    include 'meeting.html';
    ?>

    <button type="submit" class="btn btn-primary">Добавить</button>
    <button type="button" class="btn btn-primary">Отмена</button>

</form>

<script type="module">
    import {loadCompanies, loadMeetingStatuses, loadMeetingTypes} from '../../js/meeting.js';
    import {openAlertErr} from '../../js/alerts.js';

    async function fillDropDownCompanies() {
        try {
            let response = await loadCompanies();
            let items = JSON.parse(response);
            const element = document.getElementById('company_dropdown');
            let content = '<label for="categories">Выберите компанию:</label><select name="companies" id="companies" required>';
            content += `<option value="">...</option>`;
            for (const key in items) {
                // content += `<a class="dropdown-item" id="${key}" href="#">${categories[key].category}</a>`;
                content += `<option value="${key}">${items[key].title}</option>`;
            }
            content += '</select>'

            element.innerHTML = content;

        } catch (e) {
            openAlertErr(e);
        }
    }

    window.register = fillDropDownCompanies;

    await fillDropDownCompanies();

    async function fillDropDownStatuses() {
        try {
            let response = await loadMeetingStatuses();
            let items = JSON.parse(response);
            const element = document.getElementById('status_dropdown');
            let content = '<label for="categories">Выберите статус встречи:</label><select name="status" id="status" required>';
            content += `<option value="">...</option>`;
            for (const key in items) {
                // content += `<a class="dropdown-item" id="${key}" href="#">${categories[key].category}</a>`;
                content += `<option value="${key}">${items[key].name}</option>`;
            }
            content += '</select>'

            element.innerHTML = content;

        } catch (e) {
            openAlertErr(e);
        }
    }

    window.register = fillDropDownStatuses;

    await fillDropDownStatuses();

    async function fillDropDownTypes() {
        try {
            let response = await loadMeetingTypes();
            let items = JSON.parse(response);
            const element = document.getElementById('type_dropdown');
            let content = '<label for="categories">Выберите тип встречи:</label><select name="type" id="type" required>';
            content += `<option value="">...</option>`;
            for (const key in items) {
                content += `<option value="${key}">${items[key].name}</option>`;
            }
            content += '</select>'

            element.innerHTML = content;

        } catch (e) {
            openAlertErr(e);
        }
    }

    window.register = fillDropDownTypes;

    await fillDropDownTypes();

</script>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/app/views/footer.html';
?>
