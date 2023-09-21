<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- form class->delete_form, button class->delete_button -->

<script>
    var buttons = document.querySelectorAll(".delete_button");
    buttons.forEach(function(button) {
        button.addEventListener("click", function(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Siliniyor',
                text: "Kaydı Silmek İstediğinize Emin Misiniz?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Vazgeç',
                confirmButtonText: 'Evet, sil!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'Kayıt Silindi',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    var delete_form = this.closest(".delete_form");
                    delete_form.submit();
                }
            });
        });
    });
</script>
