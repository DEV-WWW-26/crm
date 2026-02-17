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
    import {loadCompanies as load} from '../../js/meeting.js';
    import {openAlertErr} from '../../js/alerts.js';

    async function loadCompanies() {
        try {
            let response = await load();
            let companies = JSON.parse(response);
            const element = document.getElementById('company_dropdown');
            let content = '<label for="categories">Выберите компанию:</label><select name="companies" id="companies" required>';
            content += `<option value="">...</option>`;
            for (const key in companies) {
                // content += `<a class="dropdown-item" id="${key}" href="#">${categories[key].category}</a>`;
                content += `<option value="${key}">${companies[key].title}</option>`;
            }
            content += '</select>'

            element.innerHTML = content;

        } catch (e) {
            openAlertErr(e);
        }
    }

    window.register = loadCompanies;

    await loadCompanies();

</script>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/app/views/footer.html';
?>
