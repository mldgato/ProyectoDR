<?= $this->extend('templates/admin_template'); ?>

<?= $this->section('content-header'); ?>

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<?php
if (isset($_SESSION['message'])) {
?>
    <script type="text/javascript">
        Swal.fire('Información', '<?php echo $_SESSION['message']; ?>', '<?php echo $_SESSION['alert-class']; ?>');
    </script>
<?php
}
?>
<?= $this->endSection(); ?>