
const table = $('#dataTable').DataTable({
    processing: true,
    serverSide: true,
    ajax: "charAjax",
    columns: [
        {
            data: 'DT_RowIndex',
            name: 'DT_RowIndex',
            orderable: false,
            sortable: false,
            searchable: false
        },
        {
            data: 'name',
            name: 'name'
        },
        {
            data: 'rarity',
            name: 'rarity',
            searchable: false

        },
        {
            data: 'weapon',
            name: 'weapon'
        },
        {
            data: 'vision',
            name: 'vision'
        },
        {
            data: 'birthday',
            name: 'birthday'
        },
        {
            data: 'constellation',
            name: 'constellation'
        },
        {
            data: 'region',
            name: 'region'
        },
        {
            data: 'action',
            name: 'action',
            sortable: false,
            searchable: false
        }],
    order: [[1, 'dsc']],
    language: {
        oPaginate: {
            sNext: '<i class="fa fa-forward"></i>',
            sPrevious: '<i class="fa fa-backward"></i>',
            sFirst: '<i class="fa fa-step-backward"></i>',
            sLast: '<i class="fa fa-step-forward"></i>'
        }
    }
});
$(document).ready(function () {
    function formatVision(vision) {
        if (!vision.id) {
            return vision.text;
        }
        var $vision = $(
            '<span><img src="/img/vision/' + vision.text + '.png" class="mr-2" height="20" /> ' + vision.text + '</span>'
        );
        return $vision;
    };
    function formatWeap(weap) {
        if (!weap.id) {
            return weap.text;
        }
        var $weap = $(
            '<span><img src="/img/weapon/' + weap.text + '.webp" class="mr-2" height="20" /> ' + weap.text + '</span>'
        );
        return $weap;
    };
    function formatStar(star) {
        if (!star.id) {
            return star.text;
        }
        var $star = $(
            '<span>' + star.text + '<i class="fa fa-star ml-2"></i></span>'
        );
        return $star;
    };
    $('#rarity').select2({
        theme: 'bootstrap-5',
        placeholder: 'Rarity',
        dropdownParent: $('#addCharModal'),
        templateResult: formatStar

    });
    $('#weapon').select2({
        theme: 'bootstrap-5',
        placeholder: 'Weapon',
        dropdownParent: $('#addCharModal'),
        templateResult: formatWeap
    });
    $('#vision').select2({
        theme: 'bootstrap-5',
        placeholder: 'Vision',
        dropdownParent: $('#addCharModal'),
        templateResult: formatVision
    });
});
$('#addCharModal').on('shown.bs.modal', function () {
    $(this).find('[autofocus]').focus();
    $('#addCharModal').find('.form-control').removeClass('is-invalid');
    $('#addCharModal').find('.invalid-feedback').hide();
});

$(document).on('click', '.btn-add-char', function () {
    $('#addCharModalLabel').text('Add New Character')
    $('#addCharModal').find('input').val('');
    $('#addCharModal').find('select').val('');
    $('#rarity').trigger('change')
    $('#weapon').trigger('change')
    $('#vision').trigger('change')
    $('#edit').attr('id', 'save')
    $('#save').text('Save')
});
function validField() {

}
$(document).on('click', '#save', function (e) {
    e.preventDefault();
    $.ajax({
        url: 'charAjax',
        type: 'POST',
        data: {
            name: $('#name').val(),
            rarity: $('#rarity').val(),
            birthday: $('#birthday').val(),
            constellation: $('#constellation').val(),
            weapon: $('#weapon').val(),
            vision: $('#vision').val(),
            region: $('#region').val()
        },
        success: function (response) {
            if (response.status == 400) {
                $('#addCharModal').find('.invalid-feedback').show();
                if (response.errors['name'] == undefined) {
                    $('#name').removeClass('is-invalid');
                    $('#name-feedback').hide();
                } else {
                    $('#name-feedback').text(response.errors['name']);
                    $('#name').addClass('is-invalid');
                }
                if (response.errors['rarity'] == undefined) {
                    $('#rarity').removeClass('is-invalid');
                    $('#rarity-feedback').hide();
                } else {
                    $('#rarity-feedback').text(response.errors['rarity']);
                    $('#rarity').addClass('is-invalid');
                }
                if (response.errors['weapon'] == undefined) {
                    $('#weapon').removeClass('is-invalid');
                    $('#weapon-feedback').hide();
                } else {
                    $('#weapon-feedback').text(response.errors['weapon']);
                    $('#weapon').addClass('is-invalid');
                }
                if (response.errors['vision'] == undefined) {
                    $('#vision').removeClass('is-invalid');
                    $('#vision-feedback').hide();
                } else {
                    $('#vision-feedback').text(response.errors['vision']);
                    $('#vision').addClass('is-invalid');
                }
                if (response.errors['birthday'] == undefined) {
                    $('#birthday').removeClass('is-invalid');
                    $('#birthday-feedback').hide();
                } else {
                    $('#birthday-feedback').text(response.errors['birthday']);
                    $('#birthday').addClass('is-invalid');
                }
                if (response.errors['constellation'] == undefined) {
                    $('#constellation').removeClass('is-invalid');
                    $('#constellation-feedback').hide();
                } else {
                    $('#constellation-feedback').text(response.errors['constellation']);
                    $('#constellation').addClass('is-invalid');
                }
                if (response.errors['region'] == undefined) {
                    $('#region').removeClass('is-invalid');
                    $('#region-feedback').hide();
                } else {
                    $('#region-feedback').text(response.errors['region']);
                    $('#region').addClass('is-invalid');
                }
            } else {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: response.message,
                    timer: 1500,
                    showConfirmButton: false,
                });
                $('#addCharModal').find('.form-control').val('');
                $('#addCharModal').find('.form-control').removeClass('is-invalid');
                $('#addCharModal').find('.invalid-feedback').hide();
                $('#addCharModal').modal('hide');
                table.ajax.reload();
            }
        }
    });
});

$(document).on('click', '#edit', function (e) {
    e.preventDefault();
    let id = $('#id').val()
    $.ajax({
        url: 'charAjax/' + id,
        type: 'PUT',
        data: {
            id: id,
            name: $('#name').val(),
            rarity: $('#rarity').val(),
            birthday: $('#birthday').val(),
            constellation: $('#constellation').val(),
            weapon: $('#weapon').val(),
            vision: $('#vision').val(),
            region: $('#region').val()
        },
        success: function (response) {
            if (response.status == 400) {
                $('#addCharModal').find('.invalid-feedback').show();
                if (response.errors['name'] == undefined) {
                    $('#name').removeClass('is-invalid');
                    $('#name-feedback').hide();
                } else {
                    $('#name-feedback').text(response.errors['name']);
                    $('#name').addClass('is-invalid');
                }
                if (response.errors['rarity'] == undefined) {
                    $('#rarity').removeClass('is-invalid');
                    $('#rarity-feedback').hide();
                } else {
                    $('#rarity-feedback').text(response.errors['rarity']);
                    $('#rarity').addClass('is-invalid');
                }
                if (response.errors['weapon'] == undefined) {
                    $('#weapon').removeClass('is-invalid');
                    $('#weapon-feedback').hide();
                } else {
                    $('#weapon-feedback').text(response.errors['weapon']);
                    $('#weapon').addClass('is-invalid');
                }
                if (response.errors['vision'] == undefined) {
                    $('#vision').removeClass('is-invalid');
                    $('#vision-feedback').hide();
                } else {
                    $('#vision-feedback').text(response.errors['vision']);
                    $('#vision').addClass('is-invalid');
                }
                if (response.errors['birthday'] == undefined) {
                    $('#birthday').removeClass('is-invalid');
                    $('#birthday-feedback').hide();
                } else {
                    $('#birthday-feedback').text(response.errors['birthday']);
                    $('#birthday').addClass('is-invalid');
                }
                if (response.errors['constellation'] == undefined) {
                    $('#constellation').removeClass('is-invalid');
                    $('#constellation-feedback').hide();
                } else {
                    $('#constellation-feedback').text(response.errors['constellation']);
                    $('#constellation').addClass('is-invalid');
                }
                if (response.errors['region'] == undefined) {
                    $('#region').removeClass('is-invalid');
                    $('#region-feedback').hide();
                } else {
                    $('#region-feedback').text(response.errors['region']);
                    $('#region').addClass('is-invalid');
                }
            } else {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: response.message,
                    timer: 1500,
                    showConfirmButton: false,
                });
                $('#addCharModal').find('.form-control').val('');
                $('#addCharModal').find('.form-control').removeClass('is-invalid');
                $('#addCharModal').find('.invalid-feedback').hide();
                $('#addCharModal').modal('hide');
                table.ajax.reload();
            }
        }
    });
});

function editForm(url) {
    $.ajax({
        type: "GET",
        url: url,
        dataType: "json",
        success: function (response) {
            $('#id').val(response.id)
            $('#name').val(response.name)
            $('#rarity').val(response.rarity)
            $('#rarity').trigger('change')
            $('#weapon').val(response.weapon)
            $('#weapon').trigger('change')
            $('#vision').val(response.vision)
            $('#vision').trigger('change')
            $('#birthday').val(response.birthday)
            $('#constellation').val(response.constellation)
            $('#region').val(response.region)
            $('#addCharModalLabel').text('Edit Character')
            $('#save').text('Edit')
            $('#save').attr('id', 'edit')
        }
    });
}
function deleteChar(url) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "DELETE",
                url: url,
                dataType: "json",
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                        timer: 1500,
                        showConfirmButton: false,
                    });
                }
            })
        }
        table.ajax.reload();

    })
}
