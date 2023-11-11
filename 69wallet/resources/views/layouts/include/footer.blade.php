<!-- Footer -->

<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin ingin keluar ?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <a class="btn btn-primary" href="{{ route('logout') }}">Keluar</a>
            </div>

        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>

<!-- Page level plugins -->
<script src="{{ asset('assets/vendor/chart.js/Chart.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('assets/js/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('assets/js/demo/chart-pie-demo.js') }}"></script>
<script>
    // Menonaktifkan tombol "Beli" secara default saat halaman dimuat
    $('.buyBtn').prop('disabled', true);

    // Validasi nomor HP saat input
    $('#phone').on('input', function() {
        var phoneNumber = $(this).val().trim();
        var isValid = /^(\+62|08)[0-9]{9,}$/.test(phoneNumber);
        $('.buyBtn').prop('disabled', !isValid);
        $('#phone-error').text(isValid ? '' : 'Masukkan nomor HP yang valid (awalan 08 atau +62)');
    });

    // Handler saat tombol "Beli" di klik
    $('.buyBtn').click(function(event) {
        if ($(this).prop('disabled')) {
            event.preventDefault(); // Mencegah perilaku default dari tautan saat dinonaktifkan
            $('#phone-error').text('Mohon isi nomor HP yang valid sebelum melakukan pembelian.');
            return false; // Menghentikan aksi default
        }
    });

</script>
</body>

</html>
