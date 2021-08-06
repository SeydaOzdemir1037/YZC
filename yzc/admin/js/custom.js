$(document).ready(function () {

    $(".sil-sweet").click(function (e) {
        var $data_url = $(this).data("url");

        swal({
            title: 'Emin misiniz?',
            text: "Bu işlemi geri alamayacaksınız!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Evet, Sil!',
            cancelButtonText: 'Hayır'
        }).then(function (result) {
            if (result.value) {
                window.location.href = $data_url
            }
        })
    })
})