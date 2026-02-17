<?php
include $_SERVER['DOCUMENT_ROOT'] . '/app/views/header.html';
?>

<form id=add_company_form" action="../../controllers/company.php" method="post">

    <?php
    include 'company.html';
    ?>

    <button type="submit" class="btn btn-primary">Добавить</button>
    <button type="button" class="btn btn-primary">Отмена</button>

</form>

<script type="module">
    import {load} from '../../js/category.js';
    import {openAlertErr} from '../../js/alerts.js';

    async function loadCategories() {
        try {
            let response = await load();
            let categories = JSON.parse(response);
            const element = document.getElementById('categories_dropdown');
            /*let content = '<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"' +
                'data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'+
                    'Категория'
                + '</button>'
                + '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="category_elements">';*/
            let content = '<label for="categories">Выберите категорию:</label><select name="categories" id="categories">';
            content += `<option value="0">...</option>`;
            for (const key in categories) {
                // content += `<a class="dropdown-item" id="${key}" href="#">${categories[key].category}</a>`;
                content += `<option value="${key}">${categories[key].category}</option>`;
            }
            content += '</select>'

            element.innerHTML = content;

        } catch (e) {
            openAlertErr(e);
        }
    }

    window.register = loadCategories;

    await loadCategories();

</script>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/app/views/footer.html';
?>

