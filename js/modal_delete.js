function handleDeleteButtons() {
    document.querySelectorAll('.delete-btn').forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            const url = button.getAttribute('data-url');
            console.log("Attempting to delete at URL: ", url); 
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
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"
                    }).then(() => {
                        window.location.href = url;
                    });
                }
            });
        });
    });
}

function handleCancelButtons() {
    document.querySelectorAll('.cancel-btn').forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            const url = button.getAttribute('data-url');
            console.log("Attempting to cancel at URL: ", url);
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Anda tidak akan dapat mengembalikan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batalkan',
                confirmButtonText: 'Ya, Batalkan Keluhan!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 'success') {
                                Swal.fire({
                                    title: "Keluhan Dibatalkan!",
                                    text: response.message,
                                    icon: "success"
                                }).then(() => {
                                    location.reload(); 
                                });
                            } else {
                                Swal.fire({
                                    title: 'Gagal!',
                                    text: response.message,
                                    icon: 'error'
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                title: 'Terjadi Kesalahan!',
                                text: 'Terjadi kesalahan: ' + error,
                                icon: 'error'
                            });
                        }
                    });
                }
            });
        });
    });
}

function handleCancelButtonsByClass() {
    $(document).on('click', '.cancel-button', function(event) {
        event.preventDefault(); 

        if (!$(this).hasClass('disabled')) {
            var url = $(this).data('url');

            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Anda tidak akan dapat mengembalikan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batalkan',
                confirmButtonText: 'Ya, Batalkan Keluhan!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 'success') {
                                Swal.fire({
                                    title: "Keluhan Dibatalkan!",
                                    text: response.message,
                                    icon: "success"
                                }).then(() => {
                                    location.reload(); 
                                });
                            } else {
                                Swal.fire({
                                    title: 'Gagal!',
                                    text: response.message,
                                    icon: 'error'
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                title: 'Terjadi Kesalahan!',
                                text: 'Terjadi kesalahan: ' + error,
                                icon: 'error'
                            });
                        }
                    });
                }
            });
        }
    });
}

document.addEventListener('DOMContentLoaded', function() {
    handleDeleteButtons();
    handleCancelButtons();
    handleCancelButtonsByClass(); 
});