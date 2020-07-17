$(document).ready(function(){
    $(".opt_delete_account a").click(function(){
        $("#dialog-delete-account").dialog('open');
    });

    $("#dialog-delete-account").dialog({
        autoOpen: false,
        modal: true,
        buttons: [
            {
                text: bender2.langs.delete,
                click: function() {
                    window.location = bender2.base_url + '?page=user&action=delete&id=' + bender2.user.id  + '&secret=' + bender2.user.secret;
                }
            },
            {
                text: bender2.langs.cancel,
                click: function() {
                    $(this).dialog("close");
                }
            }
        ]
    });
});