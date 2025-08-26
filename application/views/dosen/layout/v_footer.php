			<div class="footer-wrap pd-20 mb-20 card-box">
				Teknik Informatika - Institut Teknologi Sumatera
			</div>
		</div>
	</div>
	<!-- js -->
	<script src="<?= base_url() ?>assets/backend/vendors/scripts/core.js"></script>
	<script src="<?= base_url() ?>assets/backend/vendors/scripts/script.min.js"></script>
	<script src="<?= base_url() ?>assets/backend/vendors/scripts/process.js"></script>
	<script src="<?= base_url() ?>assets/backend/vendors/scripts/layout-settings.js"></script>
	
	<script src="<?= base_url() ?>assets/backend/src/plugins/datatables/js/jquery.dataTables.min.js"></script>
	<script src="<?= base_url() ?>assets/backend/src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
	<script src="<?= base_url() ?>assets/backend/src/plugins/datatables/js/dataTables.responsive.min.js"></script>
	<script src="<?= base_url() ?>assets/backend/src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
	<!-- buttons for Export datatable -->
	<script src="<?= base_url() ?>assets/backend/src/plugins/datatables/js/dataTables.buttons.min.js"></script>
	<script src="<?= base_url() ?>assets/backend/src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
	<script src="<?= base_url() ?>assets/backend/src/plugins/datatables/js/buttons.print.min.js"></script>
	<script src="<?= base_url() ?>assets/backend/src/plugins/datatables/js/buttons.html5.min.js"></script>
	<script src="<?= base_url() ?>assets/backend/src/plugins/datatables/js/buttons.flash.min.js"></script>
	<script src="<?= base_url() ?>assets/backend/src/plugins/datatables/js/pdfmake.min.js"></script>
	<script src="<?= base_url() ?>assets/backend/src/plugins/datatables/js/vfs_fonts.js"></script>
	<!-- Datatable Setting js -->
	<script src="<?= base_url() ?>assets/backend/vendors/scripts/datatable-setting.js"></script>

	<script src="<?= base_url() ?>assets/backend/src/plugins/cropperjs/dist/cropper.js"></script>
	<script>
		window.addEventListener('DOMContentLoaded', function () {
			var image = document.getElementById('image');
			var cropBoxData;
			var canvasData;
			var cropper;

			$('#modal').on('shown.bs.modal', function () {
				cropper = new Cropper(image, {
					autoCropArea: 0.5,
					dragMode: 'move',
					aspectRatio: 3 / 3,
					restore: false,
					guides: false,
					center: false,
					highlight: false,
					cropBoxMovable: false,
					cropBoxResizable: false,
					toggleDragModeOnDblclick: false,
					ready: function () {
						cropper.setCropBoxData(cropBoxData).setCanvasData(canvasData);
					}
				});
			}).on('hidden.bs.modal', function () {
				cropBoxData = cropper.getCropBoxData();
				canvasData = cropper.getCanvasData();
				cropper.destroy();
			});
		});
	</script>

</body>
</html>