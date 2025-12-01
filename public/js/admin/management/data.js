$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function hapusData(id, kategori){
    Swal.fire({
        title: "Apa kamu yakin?",
        text: "Data tidak bisa dikembalikan setelah ini!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Tetap Hapus!"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '/adminMerahAndalanku/'+kategori+'/delete/' + id,
                type: 'DELETE',
                success: function(response) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "bottom-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    });
                    Toast.fire({
                        icon: "success",
                        title: response.message || "Data berhasil dihapus"
                    });
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                },
                error: function(xhr) {
                    Swal.fire('Error!', 'Gagal menghapus data.', 'error');
                }
            });
        }
    });
}
