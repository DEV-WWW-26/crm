<?php
include $_SERVER['DOCUMENT_ROOT'] . '/app/views/header.html';
include($_SERVER['DOCUMENT_ROOT'] . '/app/views/navigation.html');
?>
<h2>Карточка компании</h2>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/app/views/company/company.html';

echo '<div class="mb-3">
        <label class="form-label">Категория</label>
        <input type="text" class="form-control" name="category" id="category" disabled>
    </div>';
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

            const company = items.shift();

            document.getElementById('categories_dropdown').remove();

            document.getElementById('title').value = company.title;
            document.getElementById('title').disabled = true;
            document.getElementById('city').value = company.city;
            document.getElementById('city').disabled = true;
            document.getElementById('street').value = company.street;
            document.getElementById('street').disabled = true;
            document.getElementById('building').value = company.building;
            document.getElementById('building').disabled = true;
            document.getElementById('phone').value = company.phone;
            document.getElementById('phone').disabled = true;
            document.getElementById('email').value = company.email;
            document.getElementById('email').disabled = true;
            document.getElementById('category').value = company.category;

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

