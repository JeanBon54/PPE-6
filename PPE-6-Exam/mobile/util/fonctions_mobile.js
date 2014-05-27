/**
 * Created with JetBrains PhpStorm.
 * User: Eric
 * Date: 21/02/14
 * Time: 18:08
 * To change this template use File | Settings | File Templates.
 */
$(document).ready(function(){
    $('#liste_tickets tr').bind('click', function(e) {
        // Prevents the default action to be triggered.

        e.preventDefault();
        // on va chercher avec un appel Ajax/Json les données sur le ticket choisi
        var identifiant = $(this).find("td").eq(3).html();

        $("#id_ticket").html(identifiant);

        $.ajax({
            type: "POST",
            url: "../util/c_requetes.php",
            dataType: "json",
            data: "action=infos_ticket&data="+identifiant,
            beforeSend : function(){
                var $this = $( this ),
                    theme = $this.jqmData( "theme" ) || $.mobile.loader.prototype.options.theme,
                    msgText = $this.jqmData( "msgtext" ) || $.mobile.loader.prototype.options.text,
                    textVisible = $this.jqmData( "textvisible" ) || $.mobile.loader.prototype.options.textVisible,
                    textonly = !!$this.jqmData( "textonly" );
                html = $this.jqmData( "html" ) || "";
                $.mobile.loading( "show", {
                    text: msgText,
                    textVisible: textVisible,
                    theme: theme,
                    textonly: textonly,
                    html: html
                });
            },
            success: function(data){
                $("tr[name=une_ligne]").remove();
                $('#idBug_statut').val(data['id']);
                $('#idBug_affecter').val(data['id']);
                $("#date_ticket").html(data['created']);
                $("#priorite_ticket").html(data['delai']);
                $("#descri_ticket").html(data['description']);
                $("#capture").html("<img src='../upload/"+data['capture']+"' style='width:250px'>");

                // on active le clic sur le lien invisible pour déclencher le dialog
                $('#lnkDialog').click();
                // Autre façon de changer la page à la volée
                //$.mobile.changePage('#ticket_dialog', { transition: 'pop', role: 'dialog' });
            }
        });
    });
});