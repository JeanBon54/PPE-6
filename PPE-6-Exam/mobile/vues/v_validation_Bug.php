
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <link rel="stylesheet" href="/resources/demos/style.css">
    <style>
        .ui-progressbar {
            position: relative;
        }
        .progress-label {
            position: absolute;
            left: 50%;
            top: 4px;
            font-weight: bold;
            text-shadow: 1px 1px 0 #fff;
        }
    </style>

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
</head>
<body>
<div id="progressbar"><div class="progress-label">Validation en cours...</div></div>
</center>
</div>


</body>
</html>





