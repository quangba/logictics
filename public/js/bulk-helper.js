let selectedIds = [];

function initBulkCheckbox(checkboxClass, checkAllId, deleteBtnId) {
    $(document).on('change', '.' + checkboxClass, function () {
        const id = $(this).val();
        if ($(this).is(':checked')) {
            if (!selectedIds.includes(id)) selectedIds.push(id);
        } else {
            selectedIds = selectedIds.filter(i => i !== id);
        }
        toggleDeleteBtn(deleteBtnId);
    });

    $(document).on('change', '#' + checkAllId, function () {
        const checked = $(this).is(':checked');
        $('.' + checkboxClass).prop('checked', checked).trigger('change');
    });
}

function restoreBulkCheckbox(checkboxClass, checkAllId) {
    $('.' + checkboxClass).each(function () {
        const id = $(this).val();
        $(this).prop('checked', selectedIds.includes(id));
    });

    const total = $('.' + checkboxClass).length;
    const checked = $('.' + checkboxClass + ':checked').length;
    $('#' + checkAllId).prop('checked', total > 0 && total === checked);
}

function toggleDeleteBtn(deleteBtnId) {
    $('#' + deleteBtnId).prop('disabled', selectedIds.length === 0);
}

function handlePagination(wrapperId, checkboxClass, checkAllId) {
    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();
        const url = $(this).attr('href');

        $.get(url, function (html) {
            $('#' + wrapperId).html(html);
            restoreBulkCheckbox(checkboxClass, checkAllId);
        });
    });
}

function handleDeleteAction(deleteBtnId, modalId, confirmBtnId, deleteUrl, wrapperId, redirectUrl, extraParams = {}) {
    $('#' + deleteBtnId).on('click', function () {
        if (selectedIds.length === 0) {
            showFlash('Bạn chưa chọn mục nào!', 'warning');
            return;
        }
        $('#' + modalId).modal('show');
    });

    $('#' + confirmBtnId).on('click', function () {
        let data = {
            _token: $('meta[name="csrf-token"]').attr('content'),
            ids: selectedIds,
            ...extraParams
        };

        // Tự thêm param search nếu có
        const params = new URLSearchParams(window.location.search);
        params.forEach((val, key) => {
            if (!data[key] && key !== 'page') data[key] = val;
        });

        $.ajax({
            url: deleteUrl,
            method: 'POST',
            data: data,
            success: function (res) {
                $('#' + wrapperId).html(res.html);
                showFlash(res.message ?? 'Đã xoá thành công!', 'success');
                selectedIds = [];
                window.history.pushState({}, '', redirectUrl);
                $('#' + modalId).modal('hide');
            },
            error: function (xhr) {
                const msg = xhr.responseJSON?.message ?? 'Đã có lỗi xảy ra.';
                showFlash(msg, 'danger');
            }
        });
    });

    $('#' + modalId).on('hidden.bs.modal', function () {
        $('#' + deleteBtnId).trigger('focus');
    });
}

function showFlash(message, type = 'success') {
    $('.panel .alert').remove();
    const html = `
        <div class="alert alert-${type} alert-dismissible fade show mt-3" role="alert">
            ${message}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>`;
    $('.panel').prepend(html);
}
