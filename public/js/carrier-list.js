$(document).ready(function() {
    $('#advanced-form').hide();

    $('#basic').click(function(e){
        e.preventDefault();
        $('#basic-form').hide();
        $('#advanced-form').show();
    });

    $('#advanced').click(function(e){
        e.preventDefault();
        $('#basic-form').show();
        $('#advanced-form').hide();
    });

    $(document).on('click', 'table td', function (e) {
        if ($(e.target).is('input[type=checkbox], .td-checkbox , .carrier-checkbox')) {
            e.stopPropagation();
            return;
        }

        const href = $(this).closest('tr').attr('href');
        if (href) {
            window.location = href;
        }
    });
});
