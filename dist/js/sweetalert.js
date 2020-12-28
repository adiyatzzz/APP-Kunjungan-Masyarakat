$(document).ready(function () {
    // tombol hapus
    $(".tombol-hapus").click(function (e) { 
        e.preventDefault();
        const href = $(this).attr('href');
        
        Swal.fire({
            title: 'Are you sure?',
            text: "Yakin Ingin Dihapus",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya!'
        }).then((result) => {
            if (result.value) {
            document.location.href = href;
            }
        })
    });
});