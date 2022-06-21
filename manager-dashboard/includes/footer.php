            </div>
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span> &copy;<?php echo date('Y') ?> BRT E-TICKETING  AND BUS ALLOCATION SYSTEM </span>
                    </div>
                </div>
            </footer>
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
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    
    <!-- Bootstrap core JavaScript-->
    <script src="../app_assets/vendor/jquery/jquery.min.js"></script>

    <script src="../app_assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../app_assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../app_assets/js/kvm.js"></script>

    <!-- Page level plugins -->
    <script src="../app_assets/vendor/datatables/jquery.dataTables.min.js"></script>
    
    <script src="../app_assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../app_assets/js/demo/datatables-demo.js"></script>

    <script type="text/javascript">
    
        $(document).ready(function() {
            $(".alert").hide();
        
            $(".alert").fadeTo(5000, 1000).slideUp(1000, function() {
                $(".alert").slideUp(1000);
            });
        });
    </script>

</body>

</html>
