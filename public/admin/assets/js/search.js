$(document).on('change', '#status', function () {
    var status = $(this).val();
    var search = $('#search').val();
    var pageurl = $('#page_url').val();
    fetchAll(pageurl, 1, search, status);
});

$('#search').on('keyup', function () {
    var search = $(this).val();
    var status = $('#status').val();
    var pageurl = $('#page_url').val();
    fetchAll(pageurl, 1, search, status);
});

$(document).on('click', '.pagination a', function (event) {
    event.preventDefault();
    var search = $('#search').val();
    var status = $('#status').val();
    var pageurl = $('#page_url').val();
    var page = $(this).attr('href').split('page=')[1];
    fetchAll(pageurl, page, search, status);
});

function fetchAll(pageurl, page, search, status) {
    $.ajax({
        url: pageurl + '?page=' + page + '&search=' + encodeURIComponent(search) + '&status=' + status,
        type: 'get',
        success: function (response) {
            $('#body').html(response);
        }
    });
}

function parseDeleteSuccess(response) {
    if (response === true || response === 1 || response === '1' || response === 'true') {
        return true;
    }
    if (typeof response === 'object' && response !== null) {
        return response.success === true;
    }
    if (typeof response === 'string') {
        try {
            var parsed = JSON.parse(response);
            return parsed && parsed.success === true;
        } catch (e) {
            return response.length > 0;
        }
    }
    return !!response;
}

function removeDeletedRow($btn) {
    var rowId = $btn.data('row-id');
    var slug = $btn.data('slug');

    if (rowId) {
        $('#' + rowId).fadeOut(200, function () {
            $(this).remove();
        });
        $('#' + rowId + '-card').fadeOut(200, function () {
            $(this).remove();
        });
        return;
    }

    if (slug) {
        $('#id-' + slug).fadeOut(200, function () {
            $(this).remove();
        });
        return;
    }

    $btn.closest('tr, .admin-card').fadeOut(200, function () {
        $(this).remove();
    });
}

// Delegated delete — works on first load and after AJAX table refresh
$(document).on('click', '.delete', function (e) {
    e.preventDefault();

    var $btn = $(this);
    var deleteUrl = $btn.data('del-url');

    Swal.fire({
        title: 'Are you sure?',
        text: 'This record will be removed.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#0079d4',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete'
    }).then(function (result) {
        if (!result.isConfirmed) {
            return;
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: deleteUrl,
            type: 'DELETE',
            success: function (response) {
                if (parseDeleteSuccess(response)) {
                    removeDeletedRow($btn);
                    Swal.fire('Deleted!', 'Record removed successfully.', 'success');
                } else {
                    Swal.fire('Error', 'Could not delete record.', 'error');
                }
            },
            error: function () {
                Swal.fire('Error', 'Could not delete record.', 'error');
            }
        });
    });
});
