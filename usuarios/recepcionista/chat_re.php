<?php
$host = $_SERVER['HTTP_HOST'];
$url = "../chat/chat_recepcionista.php";
?>
<script>
    window.onload = function() {
        window.location.href = "<?php echo $url; ?>";
    }
</script>

