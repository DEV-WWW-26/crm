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
            /*const user = new User(document.getElementById('firstname').value, document.getElementById('lastname').value,
                document.getElementById('email').value, document.getElementById('firstname').password);*/
            let response = await load();
            let categories = JSON.parse(response);

            console.log(categories); // todo fill dropdown

            const element = document.getElementById('category_elements');
            let content = '';
            for (const key in categories) {
                content += `<a class="dropdown-item" id="${key}" href="#">${categories[key].category}</a>`;
            }

            console.log(content);
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

