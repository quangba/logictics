$(document).ready(function () {
    $('#advanced-form').hide();

    $('#basic').click(function (e) {
        e.preventDefault();
        $('#basic-form').hide();
        $('#advanced-form').show();
    });

    $('#advanced').click(function (e) {
        e.preventDefault();
        $('#basic-form').show();
        $('#advanced-form').hide();
    });

    $(document).on('click', 'table td', function (e) {
        if ($(e.target).is('input[type=checkbox], .td-checkbox , .carrier-checkbox, .td-action')) {
            e.stopPropagation();
            return;
        }

        const href = $(this).closest('tr').attr('href');
        if (href) {
            window.location = href;
        }
    });

    $('table td').each(function () {
        const hasCheckbox = $(this).find('input[type=checkbox]').length > 0;
        const hasActionButton = $(this).find('a, button').length > 0;

        if (!hasCheckbox && !hasActionButton) {
            $(this).css('cursor', 'pointer');
        }
    });
});
