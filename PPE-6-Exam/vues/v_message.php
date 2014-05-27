<!-- <div class="message">
<ul><li>
<?php
      //echo $message;
?>
</li>
</ul>
</div>
-->

<?php
header("Refresh: 3; url=index.php?uc=dash&action=list");
?>
<div id="validation">

    <br><br>
    <?php
    echo "Validation en cours";
    ?>
    <br><br>
    <script>
        $(function() {
            var progressbar = $( "#progressbar" ),
                progressLabel = $( ".progress-label" );
            progressbar.progressbar({
                value: false,
                change: function() {
                    progressLabel.text( progressbar.progressbar( "value" ) + "%" );
                },
                complete: function() {
                    progressLabel.text( "Chargement des bugs!" );
                }
            });
            function progress() {
                var val = progressbar.progressbar( "value" ) || 0;
                progressbar.progressbar( "value", val + 1 );
                if ( val < 99 ) {
                    setTimeout( progress, 100 );
                }
            }
            setTimeout( progress, 3000 );
        });
    </script>

    <div id="progressbar">
        <div class="progress-label">Validation en cours...</div>

    </center>
    </div>
</div>


</body>